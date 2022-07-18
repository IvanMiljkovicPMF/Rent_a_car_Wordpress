<?php 
if( ! defined( 'ABSPATH' ) ) exit;
global $wpdb; ?>
<div class="sync-result-lists search-result-container sync_container_for_price">

	<div class="center-wrapper">
		

		<?php

			$reserved = array();
			$no_found = 0;

			$args = array(
						   'orderby' => 'post_date',
						   'order' => 'DESC',
						   'post_type' => 'easync_hotel_room',
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

	            $table = $wpdb->prefix . "sync_hotel_entries";
                $entries = $wpdb->get_results( "SELECT * FROM $table WHERE room_id = $temp_id ORDER BY id DESC" );
	            if ( ! $entries ) {
	                $wpdb->print_error(); 
	            }else {
	                foreach ($entries as $key => $item) { 

	                	$reserved['archive_arrival']   = $item->arrival_date;
	                	$reserved['archive_departure'] = $item->departure_date;
	                	$reserved['reserved_rooms'] = $item->room_number;
	                	
						$range = new DatePeriod(
						     new DateTime($date_arrive),
						     new DateInterval('P1D'),
						     new DateTime($date_departure)
						);
						$start_date              = $reserved['archive_arrival'];
						$end_date                = $reserved['archive_departure'];
						$start_ts                = strtotime($start_date);
						$end_ts                  = strtotime($end_date);
						foreach ($range as $key => $value) {
							$new_checkin_date        = $value->format('m/d/y');	
							$new_checkin_date_ts     = strtotime($new_checkin_date);
							if((($new_checkin_date_ts >= $start_ts) && ($new_checkin_date_ts <= $end_ts))) {
								//$number_conflect++;
								$number_conflect += $reserved['reserved_rooms'];
								break;
							}
						}

	                } 
	            }

				$meta = get_post_meta( get_the_ID(), 'easync_hotel', true ); 

				if($number_conflect>=$meta['number_room'] || $number_room > ($meta['number_room']-$number_conflect)) 
	            	$available = 'no';
				

				if((!empty($meta['avail']) && $meta['avail'] =='Yes') && (!empty($meta['avail']) && $meta['capacity'] == $number_guest) && ($available=='yes')) {
					$no_found = 1;
					?>
					<div class="result-item">
						<div class="result-image">
							<a data-fancybox="<?php echo 'gallery_'.esc_html(get_the_ID()); ?>" href="<?php echo esc_url(the_post_thumbnail_url('full')) ?>"><img src="<?php echo the_post_thumbnail_url('full') ?>"></a>
							<?php
								$meta = get_post_meta( get_the_ID(), 'sync_room_images_group', true );  
								if ( $meta ) {
	          						foreach ( $meta as $field ) {
	          							?><a style="visibility: hidden;" data-fancybox="<?php echo 'gallery_'.get_the_ID(); ?>" href="<?php echo wp_get_attachment_url( $field['room_images'] ) ?>"><img style="visibility: hidden;" src="<?php echo wp_get_attachment_url( $field['room_images'] ) ?>"></a><?php
									}
	          					}
							?>
							<span class="sync-tag"><i class="fas fa-tag"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="sync_currency_symbol"><?php echo esc_html(easyncCurrency()).' '; ?></span>
								<span class="sync_price_money_format">
								<?php 
								$meta = get_post_meta( get_the_ID(), 'easync_hotel', true ); 
								echo easyncPrice($meta['price']);
								?>	
								</span>
							</span>
							<div class="sync_avail_room">
								<span>Available <?php echo esc_html(($meta['number_room']-$number_conflect));?></span>
							</div>
						</div>
						<div class="result-item-details">
							<h2><?php echo esc_html(the_title());?></h2>
							<p><?php echo easyncStringLimitWords(get_the_content(),24);?></p>
							<?php 
							$meta = get_post_meta( get_the_ID(), 'easync_hotel', true ); 
							?><input type="hidden" class="specify-special-request" value="<?php echo esc_html($meta['writemsg']);?>"><?php
							$temp_data = '';
							$meta = get_post_meta( get_the_ID(), 'sync_customdata_group', true );  
							if ( $meta ) {
          						foreach ( $meta as $field ) {
          							$temp_data .= $field['TitleItem'].',';
								}
          					}
          					?><input type="hidden" class="amenities" value="<?php echo (($temp_data!='') ? esc_html($temp_data) : '')?>"><?php
          					$temp_data = '';
          					$meta = get_post_meta( get_the_ID(), 'sync_specialrequest_group', true );  
							if ( $meta ) {
          						foreach ( $meta as $field ) {
          							$temp_data .= $field['specialrequest'].',';
								}
          					}
							?>
							<input type="hidden" class="facilities-special-request" value="<?php echo (($temp_data!='') ? esc_html($temp_data) : '')?>"> 
							<input type="hidden" class="room-id" value="<?php echo esc_html(get_the_ID());?>">
						</div>
						<div class="go-book" id="go-book">
							<button type="submit" data-toggle="modal" data-targett="#customer_info" data-backdrop="static" data-keyboard="false" class="book-save">Book now</button>
						</div>
					</div>
					<?php
				}
			endwhile;

			if($no_found == 0) {
		    	?><div class="sync_hotel_no_result">
					<p>No Result Found</p>
				</div><?php
		    }

			?>
			<div class="navigation">
			<div class="alignleft next"><?php previous_posts_link('Top Entries &raquo;') ?></div>
			<div class="alignright previous"><?php next_posts_link('&laquo; Old Entries') ?></div>
			</div>
			<?php
			wp_reset_query();
		?>

	</div>

</div>