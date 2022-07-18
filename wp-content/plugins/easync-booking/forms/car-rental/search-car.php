
<?php 
if( ! defined( 'ABSPATH' ) ) exit;
if(!is_admin()) {
global $wpdb, $post, $errors_config_car;
if(!empty($errors_config_car) && is_user_logged_in()==true) {
	?><h3>Please configure the following on Easync Booking settings:</h3><span>Goto your backend and find "EaSync Booking" on the sidebar and click "Settings" then click the "General" and click "Car Rental"</span><ul><?php
	foreach ($errors_config_car as $error) {
		?>
		<li><?php echo $error; ?></li>
		<?php
	}
	exit;
	?></ul><?php
}elseif(!empty($errors_config_car) && is_user_logged_in()==false){
	?><h3>This module is currently under maintenance, check back soon!</h3><?php
	exit;
}
$_SESSION['sync_form'] = 'car';
$_SESSION['sync_page_redirect'] = $post->post_name;

$table_name = $wpdb->prefix . "sync_options";
$entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_car_default_time'));
?>
<div class="sync_form_wrapper car-rental-wrapper ">
	<div class="sync_container pick-date">
		<div class="sync_options_currency">
			<!-- <select class="sync_options_currency_onchange" name="sync_options_currency_name">
			<?php //echo sync_options_currency();?>
			</select> -->
		</div>
		<div class="sync_title">
			<h1>Rental Services</h1>
			<?php
			if (!empty($_SESSION['message'])) {
			    echo '<p class="message"> '.esc_html($_SESSION['message']).'</p>';
			    unset($_SESSION['message']);
			}
			?>
		</div>
		<div class="sync_components">
			<form id="search_car_rental" action="" method="post">
				<div class="sync_components-container">
					<div class="sync-holder-field">
						<div class="holder holder-calendar">
							<label>Pickup Date <span class="sync_asterisk">*</span></label>
							<input readonly id="datepicker_car_rental_pick" required value="<?php echo isset($_POST['date_pick']) ? esc_html($_POST['date_pick']) : '' ?>" data-toggle="car-datepicker" name="date_pick"><i class="far fa-calendar-alt fa-1x calendar"></i>
						</div>
						<div data-toggle="car-datepicker"></div>
						<div class="holder">
							<label>Pickup Time <span class="sync_asterisk" style="visibility: hidden;">*</span></label>
							<!-- <label style="visibility: hidden;">Select Time</label> -->
							<?php
							if ( ! $entries ) {
								?>
								<input id="rental_pick_time" type="text" placeholder="Select Time" value="<?php echo isset($_POST['pick_time']) ? esc_html($_POST['pick_time']) : '' ?>" name="pick_time">
								<?php
							}else{
								?>
								<input id="rental_pick_time" type="text" placeholder="Select Time" value="<?php echo isset($_POST['pick_time']) ? esc_html($_POST['pick_time']) : explode("-", $entries[0]->option_value, 2)[0] ?>" name="pick_time">
								<?php
							}
							?>
							<i class="fas fa-clock fa-1x"></i>
						</div>
						<div class="holder holder-calendar">
							<label>Return Date <span class="sync_asterisk">*</span></label>
							<input id="datepicker_car_rental_return" required value="<?php echo isset($_POST['date_return']) ? esc_html($_POST['date_return']) : '' ?>" data-toggle="car-min-datepicker" name="date_return"><i class="far fa-calendar-alt fa-1x calendar"></i>
						</div>
						<div data-toggle="car-min-datepicker"></div>
						<div class="holder">
							<label>Return Time<span class="sync_asterisk" style="visibility: hidden;">*</span></label>
							<!-- <label style="visibility: hidden;">Select Time</label> -->
							<?php
							if ( ! $entries ) {
								?>
								<input id="rental_return_time" type="text" placeholder="Select Time" class="tooltip-error1" title="(Return time) must be less than of (Pick up time)" value="<?php echo isset($_POST['return_time']) ? esc_html($_POST['return_time']) : '' ?>" name="return_time">
								<?php
							}else{
								?>
								<input id="rental_return_time" type="text" placeholder="Select Time" class="tooltip-error1" title="(Return time) must be less than of (Pick up time)" value="<?php echo isset($_POST['return_time']) ? esc_html($_POST['return_time']) : explode("-", $entries[0]->option_value, 2)[1]?>" name="return_time">
								<?php
							}
							?>
							<i class="fas fa-clock fa-1x"></i>
						</div>
						<div class="holder">
							<label>Pickup Location<span class="sync_asterisk" style="visibility: hidden;">*</span></label>
							<select class="rental_pick_location js-states form-control" name="pick_location">
							  <?php
			                        $table_name = $wpdb->prefix . "sync_options";
			                        $entries = $wpdb->get_results( "SELECT * FROM $table_name WHERE option_name = 'sync_car_pickup' ORDER BY id DESC" );
			                        if ( ! $entries ) {
			                            $wpdb->print_error(); 
			                        }else {
			                            foreach ( $entries as $key => $value) {
			                            	
			                            	if(isset($_POST['pick_location']) && $_POST['pick_location']==$value->option_value) {
			                            		?><option selected value="<?php echo esc_html($value->option_value);?>"><?php echo esc_html(ucfirst($value->option_value));?></option><?php
			                            	}else{
			                            		?><option value="<?php echo esc_html($value->option_value);?>"><?php echo esc_html(ucfirst($value->option_value));?></option><?php
			                            	}

			                                ?>
												
			                                <?php
			                            }
			                        }
				                ?>
							</select>
						</div>
						<div class="holder">
							<label>Vehicle Type<span class="sync_asterisk" style="visibility: hidden;">*</span></label>
							<select class="rental_vehicle_type js-states form-control" name="vehicle_type">
								<option value="all">All</option>
								<?php
									$args = array(
												   'orderby' => 'post_date',
												   'order' => 'DESC',
												   'post_type' => 'easync_car_rental',
												   'post_status' => 'publish',
									               'posts_per_page' => -1,
									               'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
									               );

									query_posts($args);
									$the_query = new WP_Query( $args );
									$meta_unique =  array();
									while ($the_query->have_posts()) : $the_query->the_post();
										$temp_id = get_the_ID();
							            $querystr = "
							                SELECT *
							                FROM $wpdb->postmeta 
							                WHERE meta_key LIKE 'easync_car' AND post_id = $temp_id
							                ORDER BY meta_id DESC
							            ";
							            
							            $meta_override = $wpdb->get_results( $querystr, OBJECT );
							            
							            if ( ! $meta_override ) {
							                $wpdb->print_error(); 
							            }else {
							            	foreach ($meta_override as $key => $value) {
							            		$meta = get_post_meta( get_the_ID(), $value->meta_key, true );
							            		array_push($meta_unique, $meta['type']);
							            	}
							            }
							        endwhile;
							        wp_reset_query();
							        $meta_unique = array_unique($meta_unique); 
							        foreach ($meta_unique as $key => $value) {

						        		if(isset($_POST['vehicle_type']) && $_POST['vehicle_type']==$value) {
		                            		?><option selected value="<?php echo esc_html($value);?>"><?php echo esc_html(ucfirst($value));?></option><?php
		                            	}else{
		                            		?><option value="<?php echo esc_html($value); ?>"><?php echo esc_html(ucfirst($value));?></option><?php
		                            	}

							       	 ?>
							       	 <?php
							        }
								?>	
							</select>
						</div>
					</div>
					<div class="holder holder-check-availability">
						<input type="hidden" name="with_or_out_driver" class="with_or_out_driver" value="<?php echo isset($_POST['with_or_out_driver']) ? esc_html($_POST['with_or_out_driver']) : 'self-driven' ?>">
						<input type="submit" value="Check Availability" name="check_car" class="find-car">
						<div class="holder options">
							<label style="visibility: hidden;">Self-Driven</label>
							<div class="car-driver">
								<input type="checkbox" name="self_driven" value="self-driven" class="rent-driver self-driver">
								<?php
									if(isset($_POST['with_or_out_driver'])) {
										if($_POST['with_or_out_driver']=='with driver') {
											?><label class="active">Self-driven</label><?php
										}else{
											?><label class="active">Self-driven</label><?php
										}
									}else{
										?><label class="active">Self-driven</label><?php
									}
								?>
							</div>
						</div>
						<!-- <div class="holder options">
							<label style="visibility: hidden;">With Driver</label>
							<div class="car-driver">
								<input type="checkbox" name="driver" value="with driver" class="rent-driver with-driver">
								<?php
									if(isset($_POST['with_or_out_driver'])) {
										if($_POST['with_or_out_driver']=='with driver') {
											?><label class="active">With driver</label><?php
										}else{
											?><label class="">With driver</label><?php
										}
									}else{
										?><label class="">With driver</label><?php
									}
								?>
							</div>
						</div> -->
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<?php    
	$converPickTime = date('h:i a', strtotime($_POST['pick_time']));
	if(substr( $converPickTime, 0, 1 ) == 0) {
		$converPickTime  = substr( $converPickTime, 1 );
	}
	$converReturnTime = date('h:i a', strtotime($_POST['return_time']));
	if(substr( $converReturnTime, 0, 1 ) == 0) {
		$converReturnTime  = substr( $converReturnTime, 1 );
	}
	if(!empty(sanitize_text_field($_POST['date_pick'])) && !empty(sanitize_text_field($converPickTime)) && !empty(sanitize_text_field($_POST['date_return'])) && !empty(sanitize_text_field($converReturnTime)) && !empty(sanitize_text_field($_POST['pick_location'])) && !empty(sanitize_text_field($_POST['vehicle_type']))) {

		$pick_time   = sanitize_text_field($converPickTime);
		$pick_time_h = explode(":", $pick_time, 2);
		$pick_am_pm  = substr($pick_time, -2);
	//	var_dump($pick_am_pm);

		$return_time   = sanitize_text_field($converReturnTime);
		$return_time_h = explode(":", $return_time, 2);
		$return_am_pm  = substr($return_time , -2);
	//	var_dump($pick_am_pm);

		if(($pick_time_h[0] <= $return_time_h[0]) && ($pick_am_pm == $return_am_pm) ) {
			echo "
		            <script type=\"text/javascript\" async>

		           		$('.tooltip-error1').tooltipster({
											   animation: 'fade',
											   delay: 200,
											   theme: 'tooltipster-punk',
											   trigger: 'click'
											});
						$('#rental_return_time').click();					
		            </script>
		        ";
		}else{

			$date_pick          = sanitize_text_field($_POST['date_pick']); 
		    $pick_time          = sanitize_text_field($converPickTime);
		    $date_return        = sanitize_text_field($_POST['date_return']);
		    $return_time        = sanitize_text_field($converReturnTime);
		    $pick_location      = sanitize_text_field($_POST['pick_location']);
		    $vehicle_type       = sanitize_text_field($_POST['vehicle_type']);
		    $self_driven        = sanitize_text_field($_POST['self_driven']);
		    $with_or_out_driver = 'with driver'; //sanitize_text_field($_POST['with_or_out_driver']);

		    $date_start = new DateTime($date_pick);
	    	$date_end   = new DateTime($date_return);

			$number_days = $date_end->diff($date_start)->format("%a");

			include('search-car-list.php');		
			include('personal-info.php');
			include('payment.php');	
			include('thank-you.php');

		}
	} 
}
?>

<script>

 var d = document.getElementsByClassName("result-item");
 if(d.length > 1){
	console.log('EXIST');
 }else{
	document.write('<div class="sync_car_no_result" id="noResultsFound">');
	document.write('<p>No Result Found</p>');
	document.write('</div>');
 }
</script>
