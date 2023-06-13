<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Amelia App Setting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <style>
  #menuListWrapper{
	align-items: center;
    display: flex;
}
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #fff;
      color: #3d4c66;
      font-family: "Poppins", sans-serif;
      padding: 20px;
    }

    .page_container {
      max-width: 685px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 20px;
    }

    .logo_container {
      width: 100%;
      display: flex;
      justify-content: center;
      margin-bottom: -20px;
    }

    .note_container {
      width: 100%;
      background: #f0f8ff;
      border-radius: 6px;
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .note_container h3 {
      font-weight: 600;
      font-size: 15px;
    }

    .menu_container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .menu_container h1 {
      font-weight: 600;
      font-size: 18px;
    }

    .menu_container h1 + div {
      width: 100%;
      height: 1px;
      background-color: #b0bec9;
    }

    /* The switch - the box around the slider */
    .toggle_switch-container {
      width: 51px;
      height: 31px;
      position: relative;
    }

    /* Hide default HTML checkbox */
    .checkbox {
      opacity: 0;
      width: 0;
      height: 0;
      position: absolute;
    }

    .switch {
      width: 100%;
      height: 100%;
      display: block;
      background: rgba(61, 76, 102, 0.4);
      border-radius: 16px;
      cursor: pointer;
      transition: all 0.2s ease-out;
    }

    /* The slider */
    .slider {
      width: 27px;
      height: 27px;
      position: absolute;
      left: calc(50% - 27px / 2 - 10px);
      top: calc(50% - 27px / 2);
      border-radius: 50%;
      background: #ffffff;
      box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.15),
        0px 3px 1px rgba(0, 0, 0, 0.06);
      transition: all 0.2s ease-out;
      cursor: pointer;
    }

    .checkbox:checked + .switch {
      background-color: #2797e8;
    }

    .checkbox:checked + .switch .slider {
      left: calc(50% - 27px / 2 + 10px);
      top: calc(50% - 27px / 2);
    }

    .controls-group {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      max-width: 50%;
      text-transform: capitalize;
	      padding: 10px 0px 10px 0px;
    }

    .controls-group .controls-label {
      font-weight: 600;
      font-size: 15px;
    }

    /* -------------------new ---------------------- */

    .menu-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .btn-refresh {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 2px;
      padding: 10px;
      border-radius: 8px;
      background-color: transparent;
      color: inherit;
      font-size: 16px;
      border: 1px solid #3d4c66;
      cursor: pointer;
    }

    .btn-refresh svg {
      width: 24px;
      height: 24px;
      fill: #3d4c66;
    }

    .menu_container .menu-header + div {
      width: 100%;
      height: 1px;
      background-color: #b0bec9;
    }
	.button_submit.mt_sm{
		background-color: #2796e7 !important;
		float: right;
		align-self: flex-end;
		background-color: #9b5c8f;
		border: none;
		font-size: inherit;
		font-weight: 500;
		font-family: inherit;
		color: #fff;
		border-radius: 0.5rem;
		padding: 1.5rem 3rem;
		cursor: pointer;
		transition: all 0.3s;
		display: flex;
		align-items: center;
		gap: 1rem;
		margin-top: 3rem;
	}
  </style>
  <body>
  <?php
  
  if (isset($_COOKIE['show_amelia_only'])) {
		var_dump($_COOKIE['show_amelia_only']);
	}
  if(isset($_POST['verifyform'])){
	$dashboard='';
	$calendar='';
	$appointments='';
	$events='';
	$employees='';
	$services='';
	$locations='';
	$customers='';
	$finance='';
	$notifications='';
	$customize='';
	$custom_fields='';
	$settings='';
	$menu_name='';
	if(isset($_POST['dashboard'])){
		$dashboard = $_POST['dashboard'];
		
	}
	if(isset($_POST['calendar'])){
		$calendar = $_POST['calendar'];
	}
	if(isset($_POST['appointments'])){
		$appointments = $_POST['appointments'];
	}
	if(isset($_POST['events'])){
		$events = $_POST['events'];
	}
	if(isset($_POST['employees'])){
		$employees = $_POST['employees'];
	}
	if(isset($_POST['services'])){
		$services = $_POST['services'];
	}
	if(isset($_POST['locations'])){
		$locations = $_POST['locations'];
	}
	if(isset($_POST['customers'])){
		$customers = $_POST['customers'];
	}
	if(isset($_POST['finance'])){
		$finance = $_POST['finance'];
	}
	if(isset($_POST['notifications'])){
		$notifications = $_POST['notifications'];
	}
	if(isset($_POST['customize'])){
		$customize = $_POST['customize'];
	}if(isset($_POST['custom_fields'])){
		$custom_fields = $_POST['custom_fields'];
	}if(isset($_POST['settings'])){
		$settings = $_POST['settings'];
	}
	update_option('amelia_dashboard_save', $dashboard);
	update_option('amelia_calendar_save', $calendar);
	update_option('amelia_appointments_save', $appointments);
	update_option('amelia_events_save', $events);
	update_option('amelia_employees_save', $employees);
	update_option('amelia_services_save', $services);
	update_option('amelia_locations_save', $locations);
	update_option('amelia_customers_save', $customers);
	update_option('amelia_finance_save', $finance);
	update_option('amelia_notifications_save', $notifications);
	update_option('amelia_customize_save', $customize);
	update_option('amelia_custom_fields_save', $custom_fields);
	update_option('amelia_settings_save', $settings);
  }
  $adashboard = get_option( 'amelia_dashboard_save' );
  $acalendar = get_option( 'amelia_calendar_save' );
  $aappointments = get_option( 'amelia_appointments_save' );
  $aevents = get_option( 'amelia_events_save' );
  $aemployees = get_option( 'amelia_employees_save' );
  $aservices = get_option( 'amelia_services_save' );
  $acustomers = get_option( 'amelia_customers_save' );
  $afinance = get_option( 'amelia_finance_save' );
  $anotifications = get_option( 'amelia_notifications_save' );
  $acustomize = get_option( 'amelia_customize_save' );
  $acustom_fields = get_option( 'amelia_custom_fields_save' );
  $asettings = get_option( 'amelia_settings_save' );
  $alocations = get_option( 'amelia_locations_save' );
  
  ?>
    <div class="page_container">
      <!-- Logo Container -->
      <div class="logo_container">
        
        <img src="<?php echo plugins_url('/oliver-pos/public/resource/img/amelia_logo.svg'); ?>" alt="" />
      </div>
      <!-- End Logo Container -->
      <!-- Note Container -->
      <div class="note_container">
        <h3>Important Note</h3>
        <p>
          For this plugin to work you need to have Amelia plugin installed and
          working on the same site as Oliver Bridge is installed.
        </p>
      </div>
      <!-- End Note Container -->
      <!-- Menu Container -->
      <div class="menu_container">
        <!-- *********************************************new -->
        <div class="menu-header">
          <h1>Menu Access</h1>
          <button class="btn-refresh">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path
                d="M18.5374 19.5674C16.7844 21.0831 14.4993 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 14.1361 21.3302 16.1158 20.1892 17.7406L17 12H20C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C14.1502 20 16.1022 19.1517 17.5398 17.7716L18.5374 19.5674Z"
              ></path>
            </svg>
          </button>
        </div>
        <div></div>
        <p>
          Please select which menu items you would like to show inside of your
          POS.
        </p>
        <!-- Controls -->
        <form class="form" method="post" action="">
        <!-- Controls -->
        <div class="controls-group">
          <label for="dashboard" class="controls-label">Dashboard</label>
          <div class="toggle_switch-container">
            <input type="checkbox" class="checkbox" id="dashboard" name="dashboard" value="yes" <?php if(!empty($adashboard)) { echo 'checked';} ?>/>
            <label class="switch" for="dashboard">
              <span class="slider"></span>
            </label>
          </div>
        </div>

        <!-- Controls -->
        <div class="controls-group">
          <label for="calendar" class="controls-label">Calendar</label>
          <div class="toggle_switch-container">
            <input type="checkbox" class="checkbox" id="calendar" name="calendar" value="yes" <?php if(!empty($acalendar)) { echo 'checked'; }?>/>
            <label class="switch" for="calendar">
              <span class="slider"></span>
            </label>
          </div>
        </div>
      

      <!-- Controls -->
      <div class="controls-group">
        <label for="appointments" class="controls-label">appointments</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="appointments" name="appointments" value="yes" <?php if(!empty($aappointments)) { echo 'checked';} ?>/>
          <label class="switch" for="appointments">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="events" class="controls-label">events</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="events" name="events" value="yes" <?php if(!empty($aevents)) { echo 'checked'; } ?>/>
          <label class="switch" for="events">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="employees" class="controls-label">employees</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="employees" name="employees" value="yes" <?php if(!empty($aemployees)) { echo 'checked'; } ?>/>
          <label class="switch" for="employees">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="services" class="controls-label">services</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="services" name="services" value="yes" <?php if(!empty($aservices)) { echo 'checked'; } ?>/>
          <label class="switch" for="services">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="locations" class="controls-label">locations</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="locations" name="locations" value="yes" <?php if(!empty($alocations)) { echo 'checked'; } ?>/>
          <label class="switch" for="locations">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="customers" class="controls-label">customers</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="customers" name="customers" value="yes" <?php if(!empty($acustomers)) { echo 'checked'; } ?>/>
          <label class="switch" for="customers">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="finance" class="controls-label">finance</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="finance" name="finance" value="yes" <?php if(!empty($afinance)) { echo 'checked';}?>/>
          <label class="switch" for="finance">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="notifications" class="controls-label">notifications</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="notifications" name="notifications" value="yes" <?php if(!empty($anotifications)){ echo 'checked';}?> />
          <label class="switch" for="notifications">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="customize" class="controls-label">customize</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="customize" name="customize" value="yes" <?php if(!empty($acustomize)){ echo 'checked';}?>/>
          <label class="switch" for="customize">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="custom_fields" class="controls-label">custom fields</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="custom_fields" name="custom_fields" value="yes" <?php if(!empty($acustom_fields)) {echo 'checked';}?> />
          <label class="switch" for="custom_fields">
            <span class="slider"></span>
          </label>
        </div>
      </div>

      <!-- Controls -->
      <div class="controls-group">
        <label for="settings" class="controls-label">settings</label>
        <div class="toggle_switch-container">
          <input type="checkbox" class="checkbox" id="settings" name="settings" value="yes" <?php if(!empty($asettings)) { echo 'checked'; } ?>/>
          <label class="switch" for="settings">
            <span class="slider"></span>
          </label>
        </div>
      </div>
	  </div>
	  <!--old html-->
	 
            <button type="submit" class="button_submit mt_sm" name="verifyform">
              <span>Save</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="24"
                height="24"
              >
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10
                10-4.477 10-10 10zm-.997-6l7.07-7.071-1.414-1.414-5.656
                5.657-2.829-2.829-1.414 1.414L11.003 16z"
                  fill="#fff"
                />
              </svg>
            </button>
		</form>
      <!-- End Menu Container -->
    </div>
  </body>
</html>
