<?php
if( ! defined( 'ABSPATH' ) ) exit;
 global $wpdb, $sync_restau_privacy, $sync_restau_terms; ?>
<div class="modall sync-transform fade sync-modal-personal-info" id="restau_menu_info" tabindex="-1" role="dialog" aria-labelledby="customer-infoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-bodyy">

			<div class="customer-info sync_container_for_price">
				<?php 
				$banner = plugin_dir_url(dirname( __FILE__ )) . '../images/food-banner.jpg';
				$table_name = $wpdb->prefix . "sync_options";
              	$entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_restau_banner_image' ) );
             	 if ( ! $entries ) {
                  $wpdb->print_error(); 
              	}else {
              		$banner = wp_get_attachment_url( $entries[0]->option_value );
              	}
				 ?>
					<div class="row-1 first-row sync-food-banner" style="background-image: url('<?php echo esc_url($banner); ?>');">
						<div class="sync_components ">
							<!-- <img height="700" src="<?php //echo plugin_dir_url(dirname( __FILE__ )) . '../images/food-banner.jpg'; ?>"> -->
						</div>
					</div>	
					<div class="row-1 second-row">
						<form id="restau_continue_payment" action="" method="post">
							<?php wp_nonce_field('easync_restau_to_pay', 'easync_restau_nonce'); ?>
							<div class="sync_components easync-menu-list">
								<div class="sync_options_currency">
									<!-- <select class="sync_options_currency_onchange" name="sync_options_currency_name">
									<?php //echo sync_options_currency();?>
									</select> -->
								</div>
								<div class="container sync-container"><h1>Menu</h1></div>
									<div id="tab" class="container sync-container">	
										<ul  class="nav nav-pills">
											<?php
												$count = 0;
												$args = array(
												    'orderby'    => 'date', 
												    'order'      => 'DSC'
												);
												$category = 'easync_food_category';
												$terms = get_terms($category, $args);
												//$page_link_id = the_field('link_to_page', false, false);
												foreach($terms as $key=> $term) {
													$count++;
													$hover = 'sfHover';
													$active_show = 'active show';
													if ($count!=1) {
														$hover = '';
														$active_show = '';
													}
													?>
													<li class="<?php echo $hover;?>">
										        		<a  href="<?php echo '#'.$count.'a'?>" data-toggle="tab" class="<?php echo $active_show; ?>"><?php echo esc_html($term->name);?></a>
													</li>
													<?php
												}
											?>
										</ul>

										<div class="tab-content clearfix">


											<?php
												$count2 = 0;
												//get_the_title($page_link_id);
												foreach($terms as $key=> $term) {
													$count2++;
													$active = 'active';
													if($count2!=1) $active = '';
													if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
													   $the_query = new WP_Query( array(
														    'post_type'      => 'easync_restau',
														    'orderby'        => 'post_date',
														    'order'          => 'DESC',
														    'post_status'    => 'publish',
															'posts_per_page' => -1,
														    'tax_query'      => array(
														        array (
														            'taxonomy' => $category,
														            'field' => 'slug',
														            'terms' => $term->slug ,
														        )
														    ),
														) );
													   
													   	?>
													   <div class="<?php echo 'tab-pane '.$active;?>" id="<?php echo $count2.'a';?>">
													    	<div class="list">
													    		<?php
													    		 while ( $the_query->have_posts() ) : $the_query->the_post();
													    		 	$meta = get_post_meta( get_the_ID(), 'sync_restau', true );
															   	 	if($meta['avail']==true) {
																		?>
																		<div class="special-request">
																    		<div class="list-row first-row">
																    			<input type="checkbox" name="check_dish[]" value="<?php echo esc_html(get_the_ID());?>" class="special-request-field qty-check">
																				<label class=""></label>
																    		</div>
																    		<div class="list-row second-row">
																    			<img style="cursor: pointer;" alt="<?php echo easyncStringLimitWords(get_the_title(),12);?>" src="<?php echo the_post_thumbnail_url('full') ?>">
																    		</div>
																    		<div class="list-row third-row">
																    			<h2><?php echo easyncStringLimitWords(get_the_title(),12);?></h2>
																    			<p><?php echo easyncStringLimitWords(get_the_content(),25);?></p>
																    		</div>
																    		<div class="list-row fourth-row">
																    			<p class="quantity">
																    				<span>Qty </span><input id="sync-item-qty" disabled type="number" name="qty[]" min="1" value="1">
																    			</p>
    																			<p>
    																				<span class="sync_currency_symbol"><?php echo esc_html(easyncCurrency()).' '; ?></span>
    																				<span class="sync_price_money_format">
    																				<?php echo number_format(easyncPrice($meta['price']),2); ?>
    																				</span>
    																			</p>
																    			<p>
																    			Sub. 
																    				<span class="sync_price_money_format">
																    					<?php 
																						echo number_format(easyncPrice($meta['price']),2);
																						?>
																    				</span>
																    			</p>
																    		</div>
																		</div>
																		<?php
																	}
															   	 endwhile;
															   	 wp_reset_query();
													    		?>
													    	</div>
													    </div>
													 <?php  
													}
												}

												?>

										</div>
								   </div>
								<div class="book-summary-total">
									<p>Total <span class="sync_price_money_format"> 0</span><span class="sync_currency_symbol"><?php echo esc_html(easyncCurrency()).' '; ?></span></p>	
								</div>
								<div class="book-summary-payment">
									<div class="book-summary-footer">
										<p>By clicking this button, you acknowledge that you have read and agreed to the <a target="_blank" href="<?php echo esc_url($sync_restau_terms); ?>">Terms and Conditions</a> and <a target="_blank" href="<?php echo esc_url($sync_restau_privacy); ?>"> Privacy Policy</a></p>
										<div class="payment">
											<input type="hidden" name="sync_currency_code" value="<?php echo esc_html(easyncCurrency()); ?>">
											<button type="submit" class="restau-continue-payment" >Continue to Payment</button>
										</div>
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



