<?php 
if( ! defined( 'ABSPATH' ) ) exit;
if(!is_admin()) {
global $post, $errors_config_hotel;
if(!empty($errors_config_hotel) && is_user_logged_in()==true) {
	?><h3>Please configure the following on Easync Booking settings:</h3><span>Goto your backend and find "EaSync Booking" on the sidebar and click "Settings" then click the "General" and click "Hotel Booking"</span><ul><?php
	foreach ($errors_config_hotel as $error) {
		?>
		<li><?php echo $error; ?></li>
		<?php
	}
	exit;
	?></ul><?php
}elseif(!empty($errors_config_hotel) && is_user_logged_in()==false){
	?><h3>This module is currently under maintenance, check back soon!</h3><?php
	exit;
}
		
$_SESSION['sync_form'] = 'hotel';
$_SESSION['sync_page_redirect'] = $post->post_name;
?>
<div class="sync_form_wrapper sync_hotel_wrapper">
	<div class="sync_container pick-date">
		<div class="sync_options_currency">
			<!-- <select class="sync_options_currency_onchange" name="sync_options_currency_name">
			<?php //echo sync_options_currency();?>
			</select> -->
		</div>
		<div class="sync_title">
			<h1>Hotel Accommodation</h1>
			<?php
			if (!empty($_SESSION['message'])) {
			    echo '<p class="message"> '.esc_html($_SESSION['message']).'</p>';
			    unset($_SESSION['message']);
			}
			?>
		</div>
		<div class="sync_components">
			<form id="search_hotel_room" action="" method="post">
				<div class="holder holder-calendar">
					<label>Check-in Date</label>
					<input required readonly id="datepicker_hotel" data-toggle="datepicker" value="<?php echo isset($_POST['date_arrive']) ? esc_html($_POST['date_arrive']) : '' ?>" name="date_arrive"><i class="far fa-calendar-alt fa-1x calendar"></i>
				</div>
				<div style="display: none;" class="holder" data-toggle="datepicker"></div>
				<div class="holder holder-night quantity">
					<label>Duration</label>
					<input id="spend_night_hotel" type="number" min="1" max="30" step="1" value="<?php echo isset($_POST['night_number']) ? esc_html($_POST['night_number']) : '1' ?>" name="night_number"><span class="night night-text">night(s)</span>
				</div>
				<div class="holder holder-check-out no-border">
					<label>Check-out Date</label>
					<label class="date_departure"><?php echo isset($_POST['date_departure']) ? esc_html($_POST['date_departure']) : '' ?></label>
					<label id="date_departure_num"><?php echo isset($_POST['night_number']) ? '<i class="fas fa-moon fa-1x"></i> '.esc_html($_POST['night_number']).' night only' : '' ?></label>
					<input type="hidden" value="<?php echo isset($_POST['date_departure']) ? esc_html($_POST['date_departure']) : '' ?>" name="date_departure" id="date_departure">
				</div>
				<div class="holder holder-guest-number quantity">
					<label>Guest(s)</label>
					<input type="number" value="<?php echo isset($_POST['number_guest']) ? $_POST['number_guest'] : '2' ?>" step="1" min="1" max="30" name="number_guest" maxlength="4">
				</div>
				<div class="holder holder-rooms-number quantity">
					<label>Room(s)</label>
					<input type="number" value="<?php echo isset($_POST['number_room']) ? $_POST['number_room'] : '1' ?>" step="1" min="1" max="30" name="number_room" maxlength="2">
				</div>
				<div class="holder holder-check-room">
					<input type="button" value="Check Room" name="check_room" class="find-room" id="find-room">
				</div>
			</form>
		</div>
	</div>
</div>



<?php    


	if( (!empty(sanitize_text_field($_GET['sync_options_currency_name']))) || (!empty(sanitize_text_field($_POST['date_arrive'])) && !empty(sanitize_text_field($_POST['night_number'])) && !empty(sanitize_text_field($_POST['number_guest'])) && !empty(sanitize_text_field($_POST['number_room'])))) {

		$_SESSION['sync_default_curreny'] = sanitize_text_field($_GET['sync_options_currency_name']);
		$date_arrive    = sanitize_text_field($_POST['date_arrive']);
		$date_departure = sanitize_text_field($_POST['date_departure']);
		$night_number   = intval($_POST['night_number']);
		$number_guest   = intval($_POST['number_guest']);
		$number_room    = intval($_POST['number_room']);
		
		$_SESSION['sync_date_arrive'] = $date_arrive;
		$_SESSION['sync_number_guest'] = $number_guest;
		$_SESSION['sync_number_room'] = $number_room;

		include('search-list.php');		
		include('personal-info.php');
		include('payment.php');
		include('thank-you.php');

	}

	// if(!empty($_GET['sync_options_currency_onchange']) && !empty($_GET['sync_options_currency_name'])) {

	// 	$_SESSION['sync_default_curreny'] = $_GET['sync_options_currency_name'];
	// 	$date_arrive    = $_POST['date_arrive'];
	// 	$date_departure = $_POST['date_departure'];
	// 	$night_number   = $_POST['night_number'];
	// 	$number_guest   = $_POST['number_guest'];
	// 	$number_room    = $_POST['number_room'];
		
	// 	$_SESSION['sync_date_arrive'] = $date_arrive;
	// 	$_SESSION['sync_number_guest'] = $number_guest;
	// 	$_SESSION['sync_number_room'] = $number_room;

	// 	include('search-list.php');		
	// 	include('personal-info.php');
	// 	include('payment.php');
	// 	include('thank-you.php');

	// } 

} ?>


