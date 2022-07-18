<?php  
if( ! defined( 'ABSPATH' ) ) exit;
global $paypalURL, $paypalID, $paypal_sandbox, $paypal_production, $paypal_method, $sync_default_rate; 
?>

<div class="modall sync-transform fade sync-modal-personal-info" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="customer-infoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-targett="#customer_info">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-bodyy">
		    <div class="errorMessage">
				<h1 style="padding: 5px 35px;color: #f6674a;">Something went wrong!</h1>
				<p>Some fields are empty. Cannot save entry to database.</p>
				<p>Please try again.</p>
			</div>
	   	</div>
      </div>
    </div>
  </div>
</div>

<div class="modall sync-transform fade sync-modal-personal-info" id="restau_customer_payment" tabindex="-1" role="dialog" aria-labelledby="customer-infoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-targett="#restau_menu_info">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-bodyy">
      	<form id="sync_payment_restau_trig" action="<?php echo esc_url($paypalURL); ?>" method="post">
	        <!-- Identify your business so that you can collect the payments. -->
	        
	        <input type="hidden" name="business" value="<?php echo esc_html($paypalID); ?>">
	        
	        <!-- Specify a Buy Now button. -->
	        <!-- <input type="hidden" name="cmd" value="_xclick"> -->
	        <input type="hidden" name="cmd" value="_cart">
	         <input type="hidden" name="upload" value="1">
	        
	        <!-- Specify details about the item that buyers will purchase. -->
	        <div class="sync_payment_display">
		       <!--  <input type="hidden" name="item_name" value="deluxe"> -->
<!-- 		        <input type="hidden" name="item_number" value="2"> -->
		        <!-- <input type="hidden" name="amount" value="0.01"> -->
				<input type="hidden" name="currency_code" value="<?php echo esc_html($sync_default_rate); ?>">
		    </div>
	        
	        <!-- Specify URLs -->
	        <input type='hidden' name='cancel_return' value='<?php echo esc_html(home_url('/').'easync-cancel.php');?>'>
			<input type='hidden' name='return' value='<?php echo esc_html(home_url('/').'easync-success-and-save.php');?>'>
	    </form>
      	<form id="restau_pay_now" action="" method="post">  	
      	<?php wp_nonce_field('easync_payment', 'easync_payment_nonce'); ?>	
			<div class="payment-info">
				<div class="row-1 billing-address">
					<div class="sync_components">
						<h1>Billing Address</h1>
						<div class="billing-address-info">
							<div class="address_1">
								<input type="text" placeholder="Address line 1" name="address_1">
							</div>
							<div class="address_2">
								<input type="text" placeholder="Address line 2" name="address_2">
							</div>
							<div class="province">
								<input type="text" name="province" placeholder="Province">
							</div>
							<div class="city">
								<input type="text" placeholder="City" name="city">
							</div>
							<div class="postal-code">
								<input type="text" placeholder="Postal Code" name="postal_code">
							</div>
						</div>
						<!-- <div class="supported-gateway">
							<button type="submit" class="restau-pay-now">Pay Now</button>
						</div> -->
						<div class="supported-gateway">

							<button type="submit" class="car-pay-now">Pay Now</button>
							<div id="paypal-button-container"></div>

						    <script>
						        // Render the PayPal button
						        jQuery(function($) {
						        	function isValid() {
						        		var address_1   = $('.billing-address-info .address_1 input').val();
						        		var address_2   = $('.billing-address-info .address_2 input').val();
						        		var province    = $('.billing-address-info .province input').val();
						        		var city        = $('.billing-address-info .city input').val();
						        		var postal_code = $('.billing-address-info .postal-code input').val();

						        		if(address_1!="" && address_2!="" && province!="" && city!="" && postal_code!="") {
						        			return true;
						        		}else{
						        			return false;
						        		}
								    }

								    function toggleButton(actions) {
								        return isValid() ? actions.enable() : actions.disable();
								    }

								    paypal.Button.render({

								        // Set your environment

								        env: '<?php echo $paypal_method; ?>', // sandbox | production

								        // Specify the style of the button

								        style: {
								            label: 'checkout',
								            size:  'medium',    // small | medium | large | responsive
								            shape: 'pill',     // pill | rect
								            color: 'gold'      // gold | blue | silver | black
								        },

								        // PayPal Client IDs - replace with your own
								        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
										//AVhoakubV7rbHucF7x2n7lIWSvHXuAFB5GthAU1TRoCxuig3H02L6lIlcv5X59-xR9nt-hSfOyHSF3Ro
								        client: {
								            sandbox: '<?php echo $paypal_sandbox; ?>',
								            production: '<?php echo $paypal_production; ?>'
								        },

								        validate: function(actions) {
								            toggleButton(actions);
											$(document).on('input', '.billing-address-info .address_1 input, .billing-address-info .address_2 input, .billing-address-info .province input, .billing-address-info .city input, .billing-address-info .postal-code input', function(){
											    toggleButton(actions);
											});
								            // onChangeCheckbox(function() {
								            //     toggleButton(actions);
								            // });
								        },

								        onClick: function() {
								            $('#restau_pay_now').submit();
								        },


								        payment: function(data, actions) {
								        	
								        	var total       = 0;
								        	var currency    = '<?php echo $sync_default_rate; ?>';
								        	var order_list = {};
								        	$.each(  temporary_entry[2], function( key, value ) {
								        	 	total = (total + (parseFloat(temporary_entry[2][key]+'')) * parseInt(temporary_entry[1][key]));
								        	});
								        	console.log(order_list);

								        	order_list = {
								                payment: {
								                    transactions: [
									                    {
									                        amount: { total: total, currency: currency},
									                        item_list: {
										                        items: [	
										                        ]
									                        }
									                    }
									                ]
								                },
								                experience: {
									                input_fields: {
									                    no_shipping: 1
									                }
									            }
								            };

								            $.each(  temporary_entry[0], function( key, value ) {
								            	order_list.payment.transactions[0].item_list.items.push({
								        	 		name        : temporary_entry[0][key],
								        	 		quantity    : temporary_entry[1][key],
								        	 		price       : temporary_entry[2][key]+'',
								        	 		currency    : currency
								        	 	});
								            });


								        	$('#car_pay_now').trigger('click');
								            return actions.payment.create(order_list);
								        },

								        onAuthorize: function(data, actions) {
								        	var location = '';
								        	$.ajax({
									            type        : 'POST',
									            url         : easync_admin_ajax_directory.ajaxurl,
									            data        : 'action=easync_success_and_save',
									            dataType    : 'json', 
									            encode      : true
									        }).done(function(data) {
									        	console.log("data", data);
									        	if(data.error){
									        		$('#restau_customer_payment').modal('hide');
									        		$('#errorModal').modal('show');
									        	}else{
									        		location = data.redirect;									        		
									        	}
									        });
								        
								            return actions.payment.execute().then(function() {
								                window.location.href = location;
								            });
								        }

								    }, '#paypal-button-container');
								});
						    </script>
						</div>
					</div>
				</div>
			</div>
		</form>
     </div>
    </div>
  </div>
</div>
