<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $sync_car_privacy, $sync_car_terms;
?>
<div class="modall sync-transform fade sync-modal-personal-info" id="car_customer_info" tabindex="-1" role="dialog" aria-labelledby="customer-infoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-bodyy">

			<div class="customer-info car-customer-info">
					<div class="row-1 first-row">
						<div class="sync_components">
							<div class="car-profile">
								<img src="" alt="car">
								<div class="car-name">
									<h2>Dodge Challenger</h2>
									<span class="type">Type: sedan</span>
									</br>
									<span class="model">2018 model</span>
								</div>
							</div>
							<div class="car-cost">
								<div class="date">
									<span>Rental Dates</span>
									<p><span><?php echo esc_html($date_pick) ;?></span> - <span><?php echo esc_html($date_return);?></span></p>
									<input type="hidden" class="rent-car-day" value="<?php echo esc_html($number_days);?>">
								</div>
								<div class="pickup">
									<span>Pickup Location</span>
									<p><?php echo esc_html(ucfirst($pick_location));?></p>
								</div>
								<div class="pricing-details">
									<span>Pricing Details</span>
									<p><span class="sync_price_money_format">123</span></p>
								</div>
							</div>
						</div>
					</div>	

					<div class="row-1 second-row">
						<form id="car_continue_payment" action="" method="post" enctype="multipart/form-data">
							<?php wp_nonce_field('easync_car_to_pay', 'easync_car_nonce'); ?>
							<input type="hidden" name="car_pick_date" value="<?php echo esc_html($date_pick);?>">
							<input type="hidden" name="car_pick_time" value="<?php echo esc_html($pick_time);?>">
							<input type="hidden" name="car_pick_location" value="<?php echo esc_html($pick_location);?>">
							<input type="hidden" name="car_return_date" value="<?php echo esc_html($date_return);?>">
							<input type="hidden" name="car_return_time" value="<?php echo esc_html($return_time);?>">
							<input type="hidden" name="car_number_day" value="<?php echo esc_html($number_days);?>">
							<input type="hidden" name="with_or_out_driver" value="<?php echo esc_html($with_or_out_driver);?>">
							<div class="sync_components personal-holder personal-holder-car">
								<h1>Your Information</h1>

								<div class="personal-info firstname">
									<label>First Name</label><span class="sync_asterisk">*</span></br>
									<input type="text" name="firstname" placeholder="e.g. John" >
								</div>

								<div class="personal-info lastname">
									<label>Last Name</label><span class="sync_asterisk">*</span></br>
									<input type="text" name="lastname"  placeholder="e.g. Smith">
								</div>

								<div class="personal-info phone">
									<label>Reachable Mobile Number</label><span class="sync_asterisk">*</span></br>
									<input type="number" name="phone"  placeholder="e.g. 0997123457"><span class="reachable"></span>
								</div>
								<div class="personal-info email-address">
									<label>Email Address</label><span class="sync_asterisk">*</span></br>
									<input type="email" name="email"  placeholder="e.g. email@example.com">
								</div>
							</div>
							<div class="sync_components sync_with_driver_container">
								<h1>Driver's Information</h1>

								<div class="personal-info driver-name">
									<label>Name</label><span class="sync_asterisk">*</span></br>
									<input type="text" name="driver_name" placeholder="Doe, John" >
								</div>

								<div class="personal-info driver-phone">
									<label>Reachable Mobile Number</label><span class="sync_asterisk">*</span></br>
									<input type="number" name="driver_phone"  placeholder="e.g. 0997123457"><span class="reachable"></span>
								</div>
								<div class="personal-info image">
									Take a photo of your driver's license front and back.
									<div id="filediv1"><input name="file1" type="file" id="file1" class="sync_file" /></div>
									<div id="filediv2"><input name="file2" type="file" id="file2" class="sync_file" /></div>
								</div>
							</div>
							<div class="sync_components cancellation">
								<h1>Cancellation Policy</h1>
								<div class="cancel-msg"><p>This reservation is non-refundable.</p></div>
							</div>
							<div class="sync_components personal-holder-car ">
								<h1>Pricing</h1>
								<div class="book-summary-subtotal">
									<p><strong style="font-weight: normal; color: #999b99;">Dodge Challenger</strong> (<?php echo esc_html($number_days); echo (($number_days>1)? ' days': ' day')?>)
										<span> 123</span>
									</p>
									
								</div>
								<div class="book-summary-total">
									<p>Total<span> 1,780.00</span></p>	
								</div>
								<div class="book-summary-payment">
									<p>By clicking this button, you acknowledge that you have read and agreed to the <a target="_blank" href="<?php echo esc_url($sync_car_terms); ?>">Terms and Conditions</a> and <a target="_blank" href="<?php echo esc_url($sync_car_privacy); ?>"> Privacy Policy</a></p>
									<div class="payment">
										<input type="hidden" name="sync_currency_code" value="<?php echo esc_html(easyncCurrency()); ?>">
										<button type="submit" class="car-continue-payment" >Continue to Payment</button>
									</div>
								</div>
							</div>
				    	</form>
				    </div>
			</div>


      </div>
    </div>
  </div>
</div>

