
<?php
if( ! defined( 'ABSPATH' ) ) exit;
global $sync_hotel_privacy, $sync_hotel_terms;
?>
<div class="modall sync-transform fade sync-modal-personal-info" id="customer_info" tabindex="-1" role="dialog" aria-labelledby="customer-infoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-bodyy">

			<div class="customer-info">
					<div class="row-1 first-row">
						<div class="sync_components">
							<h1>Booking Details</h1>
							<div class="room-profile">
								<img src="" alt="room">
								<h2>Deluxe Queen</h2>
								<div class="amenities"></div>
							</div>
							<div class="room-cost">
								<div class="date">
									<span>Dates</span>
									<p><span><?php echo esc_html($date_arrive);?></span> - <span><?php echo esc_html($date_departure);?></span></p>
									<span><i class="fas fa-moon fa-1x"></i><span> <?php echo esc_html($night_number);?> </span>night(s) only</span>
								</div>
								<div class="guest">
									<span>Guest(s)</span>
									<p><span><?php echo esc_html($number_guest);?></span> Guest(s)</p>
								</div>
								<div class="rooms">
									<span>Room(s)</span>
									<p><span><?php echo esc_html($number_room);?></span> Room(s)</p>
								</div>
								<div class="pricing-details">
									<span>Pricing Details</span>
									<p>
										<!-- <span class="sync_currency_symbol"><?php echo easyncCurrency().' ';?></span> -->
										<span class="sync_price_money_format">123</span>
									</p>
								</div>
							</div>
						</div>
					</div>	

					<div class="row-1 second-row">
						<form id="continue_payment" action="" method="post">
							<?php wp_nonce_field('easync_hotel_to_pay', 'easync_hotel_nonce'); ?>
							<input type="hidden" name="hotel_arrival_date" value="<?php echo esc_html($date_arrive);?>">
							<input type="hidden" name="hotel_departure_date" value="<?php echo esc_html($date_departure);?>">
							<input type="hidden" name="hotel_night_number" value="<?php echo esc_html($night_number);?>">
							<input type="hidden" name="hotel_guest_number" value="<?php echo esc_html($number_guest);?>">
							<input type="hidden" name="hotel_number_room" value="<?php echo esc_html($number_room);?>">
							<div class="sync_components personal-holder personal-holder-hotel">
								<h1>Your Information</h1>

								<div class="personal-info firstname">
									<label>First Name *</label></br>
									<input type="text" name="firstname" placeholder="e.g. John" >
								</div>

								<div class="personal-info lastname">
									<label>Last Name *</label></br>
									<input type="text" name="lastname"  placeholder="e.g. Smith">
								</div>

								<div class="personal-info phone">
									<label>Reachable Mobile Number *</label></br>
									<input type="number" name="phone"  placeholder="e.g. 997123457">
								</div>
								<div class="personal-info email-address">
									<label>Email Address *</label></br>
									<input type="email" name="email"  placeholder="e.g. email@example.com">
								</div>

								<div class="special-request">
									<h4>Special request (optional)</h4>
									<div class="special-request-holder">
									</div>
								</div>

								<!--   style="display: none;" -->
								<!-- <div>
									<input id="specialRequest" type="text" name="specialRequest">
								</div> -->

								<!-- -->

								<div class="special-request-others">
									<label style="display: none">Please write in English or in hotel's local language</label></br>
									
								</div>
							</div>
							<div class="sync_components cancellation">
								<h1>Cancellation Policy</h1>
								<div class="cancel-msg"><p>This reservation is non-refundable.</p></div>
							</div>
							<div class="sync_components footer-holder-hotel">
								<h1>Pricing</h1>
								<div class="book-summary-subtotal">
									<p><strong style="font-weight: normal; color: #999b99;">Deluxe Queen Room</strong> (<?php echo esc_html($night_number);?> night(s) x<?php echo esc_html($night_number);?> room(s))
										<span> 123</span>
									</p>
								</div>
								<div class="book-summary-total">
									<p>Total<span> 1,780.00</span></p>	
								</div>
								<div class="book-summary-payment">
									<p>By clicking this button, you acknowledge that you have read and agreed to the <a target="_blank" href="<?php echo esc_url($sync_hotel_terms); ?>">Terms and Conditions</a> and <a target="_blank" href="<?php echo esc_url($sync_hotel_privacy); ?>"> Privacy Policy</a></p>
									<div class="payment">
										<input type="hidden" name="sync_currency_code" value="<?php echo esc_html(easyncCurrency()); ?>">
										<button type="submit" class="continue-payment" >Continue to Payment</button>
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


<script type="text/javascript">

</script>