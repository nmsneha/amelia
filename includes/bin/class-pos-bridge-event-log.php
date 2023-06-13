<?php 
namespace binary;
/**
 * all the database related operatons of events(triggers) are prformed here
 */
class Pos_Bridge_Event_Log
{

	/**
     * Insert trigger (syncing) response in the table with url
     * @since 2.1.2.2
	 * @param string $type event type (product,order,tax etc)
	 * @param string $url trigger URL
	 * @param int $code trigger response code i.e. 200,500
	 * @param boolean $sync on success true otherwise false
     * @return boolean Return true.
     */
	public static function pos_bridge_sync_logger($name, $url, $code = 200, $sync = false){
		if ( ! $sync ) {
			global $wpdb;

			// data array
			$data = array(
	          'trigger_name' => $name,
	          'trigger_url'  => $url,
	          'sync_code' 	 => $code,
	          'is_sync' 	 => $sync,
	          'sync_time' 	 => date('Y-m-d h:i:s')
	  		);

	  		// insert into table
			$wpdb->insert($wpdb->prefix . 'oliver_pos_bridge_sync_log', $data); 

			return true;
		}
	}


	/**
     * Get all the records from sync log and resync the records which are not synced
     * @since 2.1.2.2
     * @return int Return count of resync records.
     */
	public static function sync_remaining_records()
	{
		global $wpdb;
		$table_name = $wpdb->prefix.'oliver_pos_bridge_sync_log';
		$count = 0;

		// check if table exist
		$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
		
		// Fire Query
		if ( $wpdb->get_var( $query ) == $table_name ) {
			$records = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "oliver_pos_bridge_sync_log WHERE is_sync = 0" );

			if (! empty($records)) {
				self::update_sync_remaining_records( $records );
			}
	
			$count = count( $records );
		}

		return $count;
	}

	/**
     * Resync the remaining records
     * @since 2.1.2.2
	 * @param array $records records for resync
     * @return void Return void.
     */
	private function update_sync_remaining_records( $records )
	{
		$udid = ASP_DOT_NET_UDID;
		if ( is_array($records) ) {
			foreach ($records as $key => $record) {
				$url = esc_url_raw( $record->trigger_url );

				$wp_remote_get = wp_remote_get( $url, array(
			    	'headers' => array(
						'Authorization' => 'Basic ' . base64_encode( get_option( 'oliver_pos_subscription_email' ).":".get_option( 'oliver_pos_subscription_token' ) ),
					 ),
			    ));

			    //For manage trigger sync
			    $response__body = json_decode( wp_remote_retrieve_body( $wp_remote_get ) ); // get response data
			    $response_code = wp_remote_retrieve_response_code( $wp_remote_get ); // get response code
			    $sync = isset($response__body->IsSuccess) ? (bool) $response__body->IsSuccess : true;

			    //invoke logger
			    self::update_pos_bridge_sync_logger( $record->id, $response_code, $sync );
			}
		}
	}

	/**
     * delete record from table if syncing done
     * @since 2.1.2.2
	 * @param int $id trigger Id
	 * @param int $code trigger response code i.e. 200,500
	 * @param boolean $sync on success true otherwise false
     * @return boolean Return true.
     */
	public static function update_pos_bridge_sync_logger($id, $code = 200, $sync = false){
		global $wpdb;

  		// delete from table
		if ( $sync ) {
			$wpdb->delete($wpdb->prefix . 'oliver_pos_bridge_sync_log', array('id' => $id)); 
		}

		return true;
	}

}