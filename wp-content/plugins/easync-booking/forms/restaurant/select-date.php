<?php
if( ! defined( 'ABSPATH' ) ) exit;
if(!is_admin()) {
global $wpdb, $post, $errors_config_restau;
if(!empty($errors_config_restau) && is_user_logged_in()==true) {
	?><h3>Please configure the following on Easync Booking settings:</h3><span>Goto your backend and find "EaSync Booking" on the sidebar and click "Settings" then click the "General" and click "Restaurant Reservation"</span><ul><?php
	foreach ($errors_config_restau as $error) {
		?>
		<li><?php echo $error; ?></li>
		<?php
	}
	exit;
	?></ul><?php
}elseif(!empty($errors_config_restau) && is_user_logged_in()==false){
	?><h3>This module is currently under maintenance, check back soon!</h3><?php
	exit;
}	
$_SESSION['sync_form'] = 'restau';
$_SESSION['sync_page_redirect'] = $post->post_name;
$table_name = $wpdb->prefix . "sync_options";
$timezone_offset_minutes = 330;
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
date_default_timezone_set($timezone_name);
date_default_timezone_get();
?>
<div class="sync_form_wrapper restau_wrapper">
	<div class="sync_container pick-date">
		<div class="sync_title">
			<h1>Restaurant Reservation</h1>
			<?php
			if (!empty($_SESSION['message'])) {
			    echo '<p class="message"> '.esc_html($_SESSION['message']).'</p>';
			    unset($_SESSION['message']);
			}
			?>
		</div>
		<div class="sync_components">
			<form id="reserved_table" action="" method="post">
				<div class="column first">
					<div class="first-column calendar">
						<p class="label"><span>Select Date</span></p>
				          <div class="input-group">
				            <input type="hidden" class="docs-date" name="picked_date" placeholder="" value="<?php echo esc_html(date("m/d/Y")); ?>">
				          </div>
				          <div class="docs-datepicker-container"></div>
					</div>
					<div class="first-column timeslot">
						<p><span>Pick your preferred time slot</span></p>
						<div class="timeslot-box">
							<?php
								$icon_array = array('sunrise.png', 'sun.png', 'sun.png', 'night.png', 'night.png');
                                 for ($i=1; $i < 6; $i++) { 
                                	$option_name = 'sync_timeslot'.$i;
                                	$entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ", $option_name));
                                	$from = explode("-", $entries[0]->option_value, 2)[0];
                                	$to   = explode("-", $entries[0]->option_value, 2)[1];
                                	if ( $entries ) {
	                                	?>
	                                	<div class="<?php echo 'timeslot-item slot-'.$i;?>">
											<p><img src="<?php echo plugin_dir_url(dirname( __FILE__ )) . '../images/'.$icon_array[$i-1]; ?>"></p>
		                                	<p><?php echo esc_html($from);?></p>
		                                	<p>--to--</p>
		                                	<p><?php echo esc_html($to);?></p>
		                                	<input type="hidden" value="<?php echo esc_html($from).'-'.esc_html($to);?>">
										</div>
	                                	<?php
	                                }
                                }
								?>	
						</div>
						<input type="hidden" name="timeslot" class="preferred-timeslot">
					</div>
				</div>
				<div class="column second">
					<div class="second-column date-today">
						<span>TODAY</span>
						<h2><?php echo esc_html(date('l', strtotime(date('d-m-Y'))));?></h2>
						<span><?php echo esc_html(date('M d, Y', strtotime(date('d-m-Y'))));?></span>
					</div>
					<div class="second-column form">
						<p class="label"><span>Your Information</span></p>
						<p class="sync_restau_holder_name">
							<input type="text" name="name" placeholder="Name"><i class="icon-in-field fas fa-pencil-alt fa-1x"></i>
						</p>
						<p class="sync_restau_holder_email">
							<input type="email" name="email" placeholder="Email Address"><i class="icon-in-field fas fa-envelope fa-1x"></i>
						</p>
						<p class="sync_restau_holder_phone">
							<input type="number" name="phone_no" placeholder="Phone Number"><i class="icon-in-field fas fa-phone fa-1x"></i>
						</p>
						<p class="label"><span>Branch Location</span></p>
						<p class="sync_restau_holder_branch">
							<select name="branch" class="branch_location js-states form-control">
								<?php
			                        $entries = $wpdb->get_results( "SELECT * FROM $table_name WHERE option_name = 'sync_branch_locations' ORDER BY id DESC" );
			                        if ( ! $entries ) {
			                            $wpdb->print_error(); 
			                        }else {
			                            foreach ( $entries as $key => $value) {
			                                ?>
												<option value="<?php echo esc_html($value->option_value);?>"><?php echo esc_html(ucfirst($value->option_value));?></option>
			                                <?php
			                            }
			                        }
			                    ?>
							</select>
						</p>
						<div class="table_guest">
							<div class="sync-guest quantity">
								<p class="label"><span>Guest(s)</span></p>
								<p><input type="number" name="guest_no" min="1" value="1" max="30" readonly></p>
							</div>
							<div class="sync-table quantity">
								<p class="label"><span>Table(s)</span></p>
								<p><input type="number" name="table_no" min="1" value="1" max="30" readonly></p>
							</div>
						</div>
						
						
					</div>
					<div class="third-column submit-button" >
						<!-- <input type="button" data-dismiss="modal" data-target="#restau_menu_info" data-toggle="modal" name="submit" value="Reserve a table"> -->
						<button type="submit" class="reserve-table" >Reserve a table</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
include('food-menu.php');
include('payment.php'); 
include('thank-you.php'); 
}
?>


