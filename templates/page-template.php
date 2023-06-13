<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Load Amelia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <style>
      *,
      *::before,
      *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      body {
        font-weight: "Poppins", sans-serif;
        font-size: 16px;
        display: flex;
        color: #243249;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }

      .loader-container > .initial-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 12px;
        animation: fade-in 1s cubic-bezier(0.23, 1, 0.32, 1);
      }

      .loader-container > .initial-content > .countdown {
        font-size: 2rem;
        font-weight: 600;
        margin-top: 1rem;
      }
	.message{
	display: none;
	}
      #load_amelia {
        
        font-size: inherit;
        border: none;
        background-color: #2797e8;
        color: white;
        border-radius: 8px;
        padding: 16px 32px;
        cursor: pointer;
        animation: fade-in 1s cubic-bezier(0.23, 1, 0.32, 1);
      }

      #load_amelia:hover {
        background-color: #1e6ab3;
      }

      #load_amelia:focus {
        outline: none;
      }

      #load_amelia:active {
        transform: scale(0.98);
      }

      @keyframes fade-in {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }
    </style>
  </head>
  <body>
    <div class="loader-container">
      <div class="initial-content">

        <img src="<?php echo plugins_url('/oliver-pos/public/resource/img/Amelia_logo.svg'); ?>" alt="Amelia logo" />
        <h3>Loading Amelia...</h3>
        <p>Please wait while we are processing</p>
        <div class="countdown">3</div>
      </div>
	  <form method="post" action="https://wordpress-195737-2866416.cloudwaysapps.com/amelia-submit-form" class="message">
	   <input type="hidden" name="external_token" id="external_token" value="">
	   <button type="submit" value="Please click to load Amelia" id="load_amelia">Please click to load Amelia</button>
	  </form>
      
    </div>
	<?php 
	
	$menu_data=array();
	$menus = get_option('oliver_pos_amelia_menu');
	if(!empty($menus)){
		foreach($menus as $menu){
			$menu_data[] = array(
				'menu_name'=> $menu[0],
				'page_url'=> home_url().'/wp-admin/admin.php?page='.$menu[2],
			);
		}
	}
	/*
	$amelia_data = array(
			'dashboard' => get_option('amelia_dashboard_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-dashboard' : '',
			'calendar' => get_option('amelia_calendar_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-calendar' : '',
			'appointments' => get_option('amelia_appointments_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-appointments' : '',
			'events' => get_option('amelia_events_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-events' : '',
			'employees' => get_option('amelia_employees_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-employees' : '',
			'services' => get_option('amelia_services_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-services' : '',
			'customers' => get_option('amelia_customers_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-customers' : '',
			'finance' => get_option('amelia_finance_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-finance' : '',
			'notifications' => get_option('amelia_notifications_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-notifications' : '',
			'customize' => get_option('amelia_customize_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-customize' : '',
			'custom_fields' => get_option('amelia_custom_fields_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-cf' : '',
			'settings' => get_option('amelia_settings_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-settings' : '',
			'locations' => get_option('amelia_locations_save') ? home_url().'/wp-admin/admin.php?page=wpamelia-locations' : '',
		);*/
		//$amelia_data = json_encode($amelia_data);
	?>
    <script>
	jQuery(document).ready(function(){
	jQuery('#load_amelia').click(function(){
		jQuery(".countdown").css("display", "none");
		jQuery(".initial-content").css("display", "block");
		jQuery('#load_amelia').css("display", "none");
	});
	
	
	var amelia_data = <?php echo json_encode($menu_data); ?>;
	/*jsonMsg = {
									
			"command": "amelia_menu",
			"method": "post",
			"version": "1.0",
			
			"data": {
				"amelia_menu": amelia_data,		 	
			}
		}*/
		var msgData = ''
        setTimeout(() => {
            var readyExtensionData = {
                command: 'appreadywithtoken',
                version:"3.0",
                method: 'get'
            }

            window.parent.postMessage(JSON.stringify(readyExtensionData), '*');
			
        }, 1000);
		
		
		
		window.addEventListener('message', function (e) {
            msgData = JSON.parse(e.data);
            console.log("Message from Oliver POS:", msgData)
			if(msgData.command=="appreadywithtoken"){
                if(msgData.data.token){
                    console.log("token received",msgData.data.token)
					jQuery('#external_token').val(msgData.data.token);
                        var jsonMsg = {
                                    "command": "amelia_menu",
                                    "method": "post",
                                    "version": "3.0",                                    
                                    "data": amelia_data,
                                }
								//console.log();
                    window.parent.postMessage(JSON.stringify(jsonMsg), '*');
                }
             }
        });
		
		
		//console.log('jsonMsg');
		//console.log(jsonMsg);
		//window.parent.postMessage(jsonMsg, '*');
		
		
		/*window.addEventListener('message', function (e) {
			console.log('jitendra');
            let msgData = JSON.parse(e.data);
			jQuery('#external_token').val('namskar');
            console.log("token:", msgData.token);
            //console.log("Response2:", msgData);
        }, false);*/
		
		
		
      const countdown = document.querySelector(".countdown");
      const message = document.querySelector(".message");
      const initialContent = document.querySelector(".initial-content");

      let count = 3;

      const timer = setInterval(() => {
        count--;
        countdown.textContent = count;

        if (count === -1) {
          clearInterval(timer);
          message.style.display = "block";
          initialContent.style.display = "none";
		  setTimeout(function() {
			console.log('here')
				jQuery('#load_amelia').trigger('click');
				message.style.display = "none";
				initialContent.style.display = "block";
				$(".countdown").css("display", "none");
				
			}, 1000);
        }
      }, 1000);
	  
	  
	  });
    </script>
  </body>
</html>