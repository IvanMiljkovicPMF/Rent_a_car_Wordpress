<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb; ?>
<div class="sync-result-lists search-result-container sync_container_for_price car-search-result-container">

	<div class="center-wrapper">
		

		<?php

			$reserved = array();
			$no_found = 0;

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

			while ($the_query->have_posts()) : $the_query->the_post();
				$number_conflect = 0;
				$temp_id = get_the_ID();
				$available = 'yes';

				
	            $table = $wpdb->prefix . "sync_rent_car_entries";
                $entries = $wpdb->get_results( "SELECT * FROM $table WHERE car_id = $temp_id ORDER BY id DESC" );
	            if ( ! $entries ) {
	                $wpdb->print_error(); 
	            }else {
	                foreach ($entries as $key => $item) { 
	                	$reserved['archive_pick']   = $item->pick_date;
	                	$reserved['archive_return'] = $item->return_date;
	                	
						$range = new DatePeriod(
						     new DateTime($date_pick),
						     new DateInterval('P1D'),
						     new DateTime($date_return)
						);
						$start_date              = $reserved['archive_pick'];
						$end_date                = $reserved['archive_return'];
						$start_ts                = strtotime($start_date);
						$end_ts                  = strtotime($end_date);
						foreach ($range as $key => $value) {
							$new_pick_date        = $value->format('m/d/y');	
							$new_pick_date_ts     = strtotime($new_pick_date);
							if((($new_pick_date_ts >= $start_ts) && ($new_pick_date_ts <= $end_ts))) {
								$number_conflect++;
								break;
							}
						}
	                } 
	            }

				$meta = get_post_meta( get_the_ID(), 'easync_car', true ); 

				if($number_conflect>=$meta['number_car']) 
	            	$available = 'no';
				

				if((!empty($meta['avail']) && $meta['avail'] =='Yes') && ($vehicle_type==$meta['type'] || $vehicle_type=='all') && ($available=='yes')) {
					$no_found = 1;
					?>
					<div class="result-item">
						<div class="result-image">
							<img src="<?php echo the_post_thumbnail_url('full') ?>">
							<span class="sync-tag"><i class="fas fa-tag"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="sync_currency_symbol"><?php echo esc_html(easyncCurrency()).' '; ?></span>
								<span class="sync_price_money_format">
								<?php
								echo esc_html(easyncPrice($meta['price'])); 
								?>	
								</span>/ Day
							</span>
							<div class="sync_car_overlay">
							    <ul>
							    	<?php
			          					$meta_ft = get_post_meta( get_the_ID(), 'easync_car_features_group', true );  
										if ( $meta_ft ) {
			          						foreach ( $meta_ft as $field ) {
			          							?><li><p><i class="sync_color_green fas fa-check-circle fa-2x"></i><span><?php echo ' '.esc_html($field['car_features']); ?></span></p></li><?php
											}
			          					}
							    	?>
								</ul>
							</div>
							<div class="item-overlay top"></div>
						</div>
						<div class="result-item-details car-details">
							<h2><?php echo esc_html(the_title());?></h2>
							<p class="type">Type: <span><?php echo esc_html($meta['type']);?></span></p>
							<p class="model"><span><?php echo esc_html(ucfirst($meta['model']));?></span></p>
							<input type="hidden" class="car-id" value="<?php echo esc_html(get_the_ID());?>">
							<div class="go-book" id="go-book">
								<button type="submit" data-toggle="modal" data-targett="#car_customer_info" data-backdrop="static" data-keyboard="false" class="book-car" id="book-car" >Book Now</button>
							</div>
						</div>
					</div>
					<?php
				}else{
					
				}
			endwhile;
		   
		    if($no_found == 0) {
		    	?><div class="sync_car_no_result">
					<p>No Result Found</p>
				</div><?php
		    }

			?>
			<input type="hidden" class="with-or-without" value="<?php echo esc_html($with_or_out_driver);?>">
			<div class="navigation">
			<div class="alignleft next"><?php previous_posts_link('Top Entries &raquo;') ?></div>
			<div class="alignright previous"><?php next_posts_link('&laquo; Old Entries') ?></div>
			</div>
			<?php
			wp_reset_query();
		?>

	</div>

</div>