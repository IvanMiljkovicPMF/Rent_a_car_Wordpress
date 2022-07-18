<?php  
if( ! defined( 'ABSPATH' ) ) exit;
global $wpdb, $sync_hotel_enable, $sync_car_enable, $sync_restau_enable, $sync_currency;?>
<h3>Settings</h3>
<main class="sync_backend_entries">
  
  <input id="tab1" type="radio" class="sync_tab" name="tabs" checked>
  <label for="tab1"><i class="fa fa-cog"></i> General</label>

  <?php if(is_super_admin()) { ?>
  <input id="tab2" type="radio" class="sync_tab" name="tabs">
  <label for="tab2"><i class="fa fa-wrench"></i> Advance</label>
  <?php } ?>  
  <section id="content1">

    <div class="sync_common_settings">
        <div class="sync_settings_enable hotel">
          <label>Hotel Booking</label><div>
            <?php
                if ($sync_hotel_enable==false) {
                  ?>
                  <input type="checkbox" id="sync_hotel_switch" value="on" name="sync_hotel_switch"/>
                  <?php
                }else{
                ?>
                <input type="checkbox" id="sync_hotel_switch" value="on" checked name="sync_hotel_switch"/>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="sync_settings_enable car">
           <label>Car Rental</label><div>
            <?php
                if ($sync_car_enable==false) {
                  ?>
                 <input type="checkbox" id="sync_car_switch" value="on" name="sync_car_switch"/>
                <?php
                }else{  
                ?>
                 <input type="checkbox" id="sync_car_switch" value="on" checked name="sync_car_switch"/>
                <?php
              }
            ?>
          </div>
        </div>
        <div class="sync_settings_enable restau">
           <label>Restaurant Reservation</label><div>
            
            <?php
                if ($sync_restau_enable==false) {
                  ?>
                  <input type="checkbox" id="sync_restau_switch" value="on" name="sync_restau_switch"/>
                  <?php
                }else{
                ?>
                <input type="checkbox" id="sync_restau_switch" value="on" checked name="sync_restau_switch"/>
                <?php
              }
            ?>
          </div>
        </div></br>
    </div>
    
    <div id="accordion">
      <?php if ($sync_hotel_enable==true) { ?>
      <div class="card">
        <div class="card-header sync-card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-targett="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-bed"></i> 
              Hotel Booking
            </button>
          </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
              
            <div id="accordion-hotel">

              <div class="sync_hotel_thank_you_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingOne-hotel-1">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseOne-hotel-1" aria-expanded="false" aria-controls="collapseOne-hotel-1"><i class="fa fa-chevron-right"></i>
                        Thank you page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne-hotel-1" class="collapse" aria-labelledby="headingOne-hotel-1" data-parent="#accordion-hotel">
                    <div class="card-body">
                      <h6>Select thank you page</h6>
                      <div class="container">
                        <form id="sync_hotel_thank_u" class="sync_hotel_thank_u" method="POST" >
                          <?php wp_nonce_field('easync_hotel_thank_you', 'easync_hotel_thank_you_nonce'); ?>
                          <select name="sync_hotel_thank_you">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_hotel_page_thank_u'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_hotel_privacy_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingOne-hotel-2">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseOne-hotel-2" aria-expanded="false" aria-controls="collapseOne-hotel-2"><i class="fa fa-chevron-right"></i>
                        Privacy policy page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne-hotel-2" class="collapse" aria-labelledby="headingOne-hotel-2" data-parent="#accordion-hotel">
                    <div class="card-body">
                      <h6>Select privacy policy page</h6>
                      <div class="container">
                        <form id="sync_hotel_privacy" class="sync_hotel_privacy" method="POST" >
                          <?php wp_nonce_field('easync_hotel_privacy', 'easync_hotel_privacy_nonce'); ?>
                          <select name="sync_hotel_privacy">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_hotel_page_privacy'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                       </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_hotel_terms_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingOne-hotel-3">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseOne-hotel-3" aria-expanded="false" aria-controls="collapseOne-hotel-3"><i class="fa fa-chevron-right"></i>
                        Terms and conditions page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne-hotel-3" class="collapse" aria-labelledby="headingOne-hotel-3" data-parent="#accordion-hotel">
                    <div class="card-body">
                      <h6>Select terms and conditions page</h6>
                      <div class="container">
                        <form id="sync_hotel_terms" class="sync_hotel_terms" method="POST" >
                          <?php wp_nonce_field('easync_hotel_terms', 'easync_hotel_terms_nonce'); ?>
                          <select name="sync_hotel_terms">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_hotel_page_terms'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>  
              </div>


              <div class="sync_hotel_terms_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-hotel-3.5">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-hotel-3.5" aria-expanded="false" aria-controls="collapseThree-hotel-3.5"><i class="fa fa-chevron-right"></i>
                      Email notification
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-hotel-3.5" class="collapse" aria-labelledby="headingThree-hotel-3.5" data-parent="#accordion-hotel">
                    <div class="card-body">
                      <div class="container">
                        <form id="sync_hotel_email_head_notify" class="sync_hotel_terms" method="POST" >
                           <?php wp_nonce_field('easync_hotel_email_head_notify', 'easync_hotel_email_head_notify_nonce'); ?>
                           <h6>Header text</h6>
                           <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_hotel_email_head_notify' ) );
                              if ( ! $entries ) {
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-header-text" rows="4" cols="60"></textarea></br><?php
                              }else{
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-header-text" rows="4" cols="60"><?php echo $entries[0]->option_value; ?></textarea></br><?php
                              }
                           ?>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                        </br>
                        <form id="sync_hotel_email_foot_notify" class="sync_hotel_terms" method="POST" >
                           <?php wp_nonce_field('easync_hotel_email_foot_notify', 'easync_hotel_email_foot_notify_nonce'); ?>
                           <h6>Footer text</h6>
                           <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_hotel_email_foot_notify' ) );
                              if ( ! $entries ) {
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-footer-text" rows="4" cols="60"></textarea></br><?php
                              }else{
                                  ?> <textarea placeholder="If empty, default message will appear in email." name="email-footer-text" rows="4" cols="60"><?php echo $entries[0]->option_value; ?></textarea></br><?php
                              }
                           ?>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


            </div>

            

          </div>
        </div>
      </div>
      <?php } 
      if ($sync_car_enable==true) { ?>
      <div class="card">
        <div class="card-header sync-card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-car"></i> 
              Car Rental
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            
              <div id="accordion-car">

                <div class="setting-car-pickup-location">
                  <div class="card">
                    <div class="card-header sync-card-header" id="headingTwo-car-1">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo-car-1" aria-expanded="false" aria-controls="collapseTwo-car-1"><i class="fa fa-chevron-right"></i>
                          Pickup location
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo-car-1" class="collapse" aria-labelledby="headingTwo-car-1" data-parent="#accordion-car">
                      <div class="card-body">
                        <h6>Pickup location</h6>
                        <div class="container">
                          <div class="list-group">
                            <?php
                                $table_name = $wpdb->prefix . "sync_options";
                                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_pickup'));
                                if ( ! $entries ) {
                                    $wpdb->print_error(); 
                                }else {
                                    foreach ( $entries as $key => $value) {
                                        ?>
                                        <a href="#" class="list-group-item select-pickup-location" data-id="<?php echo $value->id;?>" data-value="<?php echo $value->option_value;?>"><?php echo $value->option_value;?></a>
                                        <?php
                                    }
                                }
                            ?>
                          </div>
                        </div>
                        <form id="sync_car_pickup" class="sync_car_pickup" method="POST" >
                            <?php wp_nonce_field('easync_car_pickup', 'easync_car_pickup_nonce'); ?>
                              <div class="item-row">
                                <input type="text" name="location_name" class="location_name" value=""/>
                                <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                              </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


              <div class="setting-car-types">
                <div class="card">
                    <div class="card-header sync-card-header" id="headingTwo-car-2">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo-car-2" aria-expanded="false" aria-controls="collapseTwo-car-2"><i class="fa fa-chevron-right"></i>
                         Car types
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo-car-2" class="collapse" aria-labelledby="headingTwo-car-2" data-parent="#accordion-car">
                      <div class="card-body">
                        <h6>Car types</h6>
                        <div class="container">
                          <div class="list-group">
                            <?php
                                $table_name = $wpdb->prefix . "sync_options";
                                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_types'));
                                if ( ! $entries ) {
                                    $wpdb->print_error(); 
                                }else {
                                    foreach ( $entries as $key => $value) {
                                        ?>
                                        <a href="#" class="list-group-item select-car-type" data-id="<?php echo $value->id;?>" data-value="<?php echo $value->option_value;?>"><?php echo $value->option_value;?></a>
                                        <?php
                                    }
                                }
                            ?>
                          </div>
                        </div>
                        <form id="sync_car_types" class="sync_car_types" method="POST" >
                          <?php wp_nonce_field('easync_car_types', 'easync_car_types_nonce'); ?>
                              <div class="item-row">
                                <input type="text" name="type_name" class="type_name" value=""/>
                                <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                              </div>
                        </form>
                      </div>
                    </div>
                </div>
              </div>


              <div class="setting-car-model">
                <div class="card">
                    <div class="card-header sync-card-header" id="headingTwo-car-3">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo-car-3" aria-expanded="false" aria-controls="collapseTwo-car-3"><i class="fa fa-chevron-right"></i>
                        Car model
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo-car-3" class="collapse" aria-labelledby="headingTwo-car-3" data-parent="#accordion-car">
                      <div class="card-body">
                        <h6>Car model</h6>
                        <div class="container">
                          <div class="list-group">
                            <?php
                                $table_name = $wpdb->prefix . "sync_options";
                                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC", 'sync_car_model'));
                                if ( ! $entries ) {
                                    $wpdb->print_error(); 
                                }else {
                                    foreach ( $entries as $key => $value) {
                                        ?>
                                        <a href="#" class="list-group-item select-car-model" data-id="<?php echo $value->id;?>" data-value="<?php echo $value->option_value;?>"><?php echo $value->option_value;?></a>
                                        <?php
                                    }
                                }
                            ?>
                          </div>
                        </div>
                        <form id="sync_car_model" class="sync_car_model" method="POST" >
                           <?php wp_nonce_field('easync_car_model', 'easync_car_model_nonce'); ?>
                              <div class="item-row">
                                <input type="text" name="model_name" class="model_name" value=""/>
                                <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                              </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_car_thank_you_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingTwo-car-4">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo-car-4" aria-expanded="false" aria-controls="collapseTwo-car-4"><i class="fa fa-chevron-right"></i>
                      Thank you page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo-car-4" class="collapse" aria-labelledby="headingTwo-car-4" data-parent="#accordion-car">
                    <div class="card-body">
                      <h6>Select thank you page</h6>
                      <div class="container">
                        <form id="sync_car_thank_u" class="sync_car_thank_u" method="POST" >
                          <?php wp_nonce_field('easync_car_thank_u', 'easync_car_thank_u_nonce'); ?>
                          <select name="sync_car_thank_you">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_car_page_thank_u'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_car_privacy_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingTwo-car-5">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo-car-5" aria-expanded="false" aria-controls="collapseTwo-car-5"><i class="fa fa-chevron-right"></i>
                      Privacy policy page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo-car-5" class="collapse" aria-labelledby="headingTwo-car-5" data-parent="#accordion-car">
                    <div class="card-body">
                      <h6>Select privacy policy page</h6>
                      <div class="container">
                        <form id="sync_car_privacy" class="sync_car_privacy" method="POST" >
                            <?php wp_nonce_field('easync_car_privacy', 'easync_car_privacy_nonce'); ?>
                          <select name="sync_car_privacy">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_car_page_privacy'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_car_terms_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingTwo-car-6">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo-car-6" aria-expanded="false" aria-controls="collapseTwo-car-6"><i class="fa fa-chevron-right"></i>
                      Terms and conditions page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo-car-6" class="collapse" aria-labelledby="headingTwo-car-6" data-parent="#accordion-car">
                    <div class="card-body">
                      <h6>Select terms and conditions page</h6>
                      <div class="container">
                        <form id="sync_car_terms" class="sync_car_terms" method="POST" >
                          <?php wp_nonce_field('easync_car_terms', 'easync_car_terms_nonce'); ?>
                          <select name="sync_car_terms">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_car_page_terms'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_car_terms_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-car-6.5">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-car-6.5" aria-expanded="false" aria-controls="collapseThree-car-6.5"><i class="fa fa-chevron-right"></i>
                      Email notification
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-car-6.5" class="collapse" aria-labelledby="headingThree-car-6.5" data-parent="#accordion-car">
                    <div class="card-body">
                      <div class="container">
                        <form id="sync_car_email_head_notify" class="sync_car_terms" method="POST" >
                          <?php wp_nonce_field('easync_car_email_head_notify', 'easync_car_email_head_notify_nonce'); ?>
                           <h6>Header text</h6>
                           <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_car_email_head_notify' ) );
                              if ( ! $entries ) {
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-header-text" rows="4" cols="60"></textarea></br><?php
                              }else{
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-header-text" rows="4" cols="60"><?php echo $entries[0]->option_value; ?></textarea></br><?php
                              }
                           ?>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                        </br>
                        <form id="sync_car_email_foot_notify" class="sync_restau_terms" method="POST" >
                          <?php wp_nonce_field('easync_car_email_foot_notify', 'easync_car_email_foot_notify_nonce'); ?>
                           <h6>Footer text</h6>
                           <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_car_email_foot_notify' ) );
                              if ( ! $entries ) {
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-footer-text" rows="4" cols="60"></textarea></br><?php
                              }else{
                                  ?> <textarea placeholder="If empty, default message will appear in email." name="email-footer-text" rows="4" cols="60"><?php echo $entries[0]->option_value; ?></textarea></br><?php
                              }
                           ?>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_default_car_pickup_return">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingTwo-car-7">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseTwo-car-7" aria-expanded="false" aria-controls="collapseTwo-car-7"><i class="fa fa-chevron-right"></i>
                      Default time
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo-car-7" class="collapse" aria-labelledby="headingTwo-car-7" data-parent="#accordion-car">
                    <div class="card-body">
                      <label>Default time</label>
                      <div class="container">
                        <form id="sync_default_car_time" class="sync_car_pickup" method="POST" >
                          <?php wp_nonce_field('easync_car_default_time', 'easync_car_default_time_nonce'); ?>
                        <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_car_default_time'));
                              if ( ! $entries ) {
                                  ?>
                                    <label>Pickup </label>
                                    <input type="text" id="sync_default_pickup" name="sync_default_pickup">
                                    <label>Return </label>
                                    <input type="text" id="sync_default_return" name="sync_default_return">
                                    <?php
                              }else {
                                    ?>
                                    <label>Pickup </label>
                                    <input type="text" id="sync_default_pickup" name="sync_default_pickup" value="<?php echo explode("-", $entries[0]->option_value, 2)[0]; ?>">
                                    <label>Return </label>
                                    <input type="text" id="sync_default_return" name="sync_default_return" value="<?php echo explode("-", $entries[0]->option_value, 2)[1]; ?>" >
                                    <?php
                              }
                          ?>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            </div>
           
          </div>
        </div>
      </div>
      <?php } 
      if ($sync_restau_enable==true) { ?>
      <div class="card">
        <div class="card-header sync-card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-utensils"></i> 
              Restaurant Reservation
            </button>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">


            <div id="accordion-restau">

              <div class="setting-branch-location">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-restau-1">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-restau-1" aria-expanded="false" aria-controls="collapseThree-restau-1"><i class="fa fa-chevron-right"></i>
                      Branch locations
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-restau-1" class="collapse" aria-labelledby="headingThree-restau-1" data-parent="#accordion-restau">
                    <div class="card-body">
                      <h6>Branch locations</h6>
                      <div class="container">
                        <div class="list-group">
                          <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_branch_locations' ) );
                              if ( ! $entries ) {
                                  $wpdb->print_error(); 
                              }else {
                                  foreach ( $entries as $key => $value) {
                                      ?>
                                      <a href="#" class="list-group-item select-branch-location" data-id="<?php echo $value->id;?>" data-value="<?php echo $value->option_value;?>" ><?php echo $value->option_value;?></a>
                                      <?php
                                  }
                              }
                          ?>
                        </div>
                      </div>
                      <form id="sync_branch" class="sync_branch" method="POST" >
                        <?php wp_nonce_field('easync_restau_branch', 'easync_restau_branch_nonce'); ?>
                            <div class="item-row">
                              <input type="text" name="branch_name" class="branch_name" value=""/>
                              <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                            </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


              <div class="sync_restau_thank_you_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-restau-2">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-restau-2" aria-expanded="false" aria-controls="collapseThree-restau-2"><i class="fa fa-chevron-right"></i>
                      Thank you page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-restau-2" class="collapse" aria-labelledby="headingThree-restau-2" data-parent="#accordion-restau">
                    <div class="card-body">
                      <h6>Select thank you page</h6>
                      <div class="container">
                        <form id="sync_restau_thank_u" class="sync_restau_thank_u" method="POST" >
                          <?php wp_nonce_field('easync_restau_thank_u', 'easync_restau_thank_u_nonce'); ?>
                          <select name="sync_restau_thank_you">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_restau_page_thank_u'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div> 
                    </div>
                  </div>
                </div> 
              </div>


              <div class="sync_restau_privacy_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-restau-3">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-restau-3" aria-expanded="false" aria-controls="collapseThree-restau-3"><i class="fa fa-chevron-right"></i>
                      Privacy policy page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-restau-3" class="collapse" aria-labelledby="headingThree-restau-3" data-parent="#accordion-restau">
                    <div class="card-body">
                      <h6>Select privacy policy page</h6>
                      <div class="container">
                        <form id="sync_restau_privacy" class="sync_restau_privacy" method="POST" >
                          <?php wp_nonce_field('easync_restau_privacy', 'easync_restau_privacy_nonce'); ?>
                          <select name="sync_restau_privacy">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_restau_page_privacy'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div> 
                    </div>
                  </div> 
                </div>
              </div>


              <div class="sync_restau_terms_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-restau-4">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-restau-4" aria-expanded="false" aria-controls="collapseThree-restau-4"><i class="fa fa-chevron-right"></i>
                      Terms and conditions page
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-restau-4" class="collapse" aria-labelledby="headingThree-restau-4" data-parent="#accordion-restau">
                    <div class="card-body">
                      <h6>Select terms and conditions page</h6>
                      <div class="container">
                        <form id="sync_restau_terms" class="sync_restau_terms" method="POST" >
                          <?php wp_nonce_field('easync_restau_terms', 'easync_restau_terms_nonce'); ?>
                          <select name="sync_restau_terms">
                            <option value="default">Default</option>
                            <?php
                            $pages = get_pages(); 
                            $table_name = $wpdb->prefix . "sync_options";
                            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_restau_page_terms'));
                            foreach ($pages as $page_data) {
                              $title = $page_data->post_title;
                              $selected = '';
                              if($entries && $entries[0]->option_value == get_permalink($page_data))
                                  $selected = 'selected';
                                  ?> <option <?php echo $selected; ?> value="<?php echo get_permalink($page_data); ?>"><?php echo $title; ?></option><?php
                              }
                            ?>
                          </select>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>



              <div class="sync_restau_terms_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-restau-4.5">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-restau-4.5" aria-expanded="false" aria-controls="collapseThree-restau-4.5"><i class="fa fa-chevron-right"></i>
                      Menu banner
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-restau-4.5" class="collapse" aria-labelledby="headingThree-restau-4.5" data-parent="#accordion-restau">
                    <div class="card-body">
                      <h6>Menu banner</h6>
                      <div class="container">
                        <form id="sync_restau_banner_image" class="sync_restau_banner_image" method="GET">
                          <?php wp_nonce_field('easync_restau_banner_image', 'easync_restau_banner_image_nonce'); ?>
                          <?php
                          $image_id = '';
                          $table_name = $wpdb->prefix . "sync_options";
                          $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_restau_banner_image' ) );
                         if ( ! $entries ) {
                            $wpdb->print_error(); 
                          }else {
                            $image_id = $entries[0]->option_value;
                          }

                          if( intval( $image_id ) > 0 ) {
                              // Change with the image size you want to use
                              $image = wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => 'myprefix-preview-image' ) );
                          } else {
                              // Some default image
                            $default_banner = plugin_dir_url(dirname( __FILE__ )) . '../images/food-banner.jpg';
                              $image = '<img id="myprefix-preview-image" src="'.$default_banne.'" />';
                          }
                          ?>
                           <?php echo $image; ?>
                           <input type="hidden" name="myprefix_image_id" id="myprefix_image_id" value="<?php echo esc_attr( $image_id ); ?>" class="regular-text" />
                           <input type='button' class="button-primary" value="<?php esc_attr_e( 'Select an image', 'mytextdomain' ); ?>" id="myprefix_media_manager"/>
                           <?php
                           $submit_banner = 'hidden="hidden"';
                           if(intval( $image_id ) > 0) {
                               $submit_banner = '';
                           }
                           ?>
                           <input type="submit" <?php echo $submit_banner ;?> value="Save" name="save" class="save-btn btn btn-success"/>
                         </form>
                        
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


               <div class="sync_restau_terms_page">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-restau-4.6">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-restau-4.6" aria-expanded="false" aria-controls="collapseThree-restau-4.6"><i class="fa fa-chevron-right"></i>
                      Email notification
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-restau-4.6" class="collapse" aria-labelledby="headingThree-restau-4.6" data-parent="#accordion-restau">
                    <div class="card-body">
                      <div class="container">
                        <form id="sync_restau_email_head_notify" class="sync_restau_terms" method="POST" >
                          <?php wp_nonce_field('easync_restau_email_head_notify', 'easync_restau_email_head_notify_nonce'); ?>
                           <h6>Header text</h6>
                           <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_restau_email_head_notify' ) );
                              if ( ! $entries ) {
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-header-text" rows="4" cols="60"></textarea></br><?php
                              }else{
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-header-text" rows="4" cols="60"><?php echo $entries[0]->option_value; ?></textarea></br><?php
                              }
                           ?>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                        </br>
                        <form id="sync_restau_email_foot_notify" class="sync_restau_terms" method="POST" >
                          <?php wp_nonce_field('easync_restau_email_foot_notify', 'easync_restau_email_foot_notify_nonce'); ?>
                           <h6>Footer text</h6>
                           <?php
                              $table_name = $wpdb->prefix . "sync_options";
                              $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_restau_email_foot_notify' ) );
                              if ( ! $entries ) {
                                  ?> <textarea  placeholder="If empty, default message will appear in email." name="email-footer-text" rows="4" cols="60"></textarea></br><?php
                              }else{
                                  ?> <textarea placeholder="If empty, default message will appear in email." name="email-footer-text" rows="4" cols="60"><?php echo $entries[0]->option_value; ?></textarea></br><?php
                              }
                           ?>
                          <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                        </form>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>


              <div class="setting-timeslot">
                <div class="card">
                  <div class="card-header sync-card-header" id="headingThree-restau-5">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-targett="#collapseThree-restau-5" aria-expanded="false" aria-controls="collapseThree-restau-5"><i class="fa fa-chevron-right"></i>
                      Time slot
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree-restau-5" class="collapse" aria-labelledby="headingThree-restau-5" data-parent="#accordion-restau">
                    <div class="card-body">
                      <h6>Time slot</h6>
                      <div class="container">
                        <?php
                              $table_name = $wpdb->prefix . "sync_options";
                          ?>
                          <?php
                            for ($i=1; $i <6 ; $i++) { 
                              ?>
                              <div class="<?php echo 'setting-timeslot-slot'.$i;?> item-row">
                                <form id="<?php echo 'sync_timeslot'.$i;?>" method="GET">
                                  <?php wp_nonce_field('easync_restau_timeslot_'.$i, 'easync_restau_timeslot_'.$i.'_nonce'); ?>
                                    <div class="<?php echo 'setting-timeslot-slot'.$i;?> item-row">
                                        <label>Slot <?php echo $i;?></label>
                                        <?php
                                        $option_name = 'sync_timeslot'.$i;
                                          $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ", $option_name));
                                          if ( $entries ) {
                                              ?>
                                              <input id="<?php echo 'timeslot'.$i;?>" type="text" placeholder="From" value="<?php echo explode("-", $entries[0]->option_value, 2)[0];?>" name="<?php echo 'timeslot'.$i;?>"><span class="fa fa-sort-down fa-1x"></span>
                                              <?php
                                          }else {
                                              ?>
                                              <input id="<?php echo 'timeslot'.$i;?>" type="text" placeholder="From" value="" name="<?php echo 'timeslot'.$i;?>"><span class="fa fa-sort-down fa-1x"></span>
                                              <?php
                                          }

                                          if ( $entries ) {
                                              ?>
                                              <input id="<?php echo 'timeslot1_'.$i;?>" type="text" placeholder="To" value="<?php echo explode("-", $entries[0]->option_value, 2)[1];?>" name="<?php echo 'timeslot1_'.$i;?>"><span class="fa fa-sort-down fa-1x"></span>
                                              <?php
                                          }else {
                                              ?>
                                              <input id="<?php echo 'timeslot1_'.$i;?>" type="text" placeholder="To" value="11:30am" name="<?php echo 'timeslot1_'.$i;?>"><span class="fa fa-sort-down fa-1x"></span>
                                              <?php
                                          }
                                        ?>
                                    </div>
                                    <div class="item-row">
                                        <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
                                    </div>
                                </form> 
                              </div>

                              <?php
                            }
                          ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            </div>


          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>
  <?php if(is_super_admin()) { ?>  
  <section id="content2">
    <div class="sync_advance_paypal_container">
      <form id="sync_paypal_config" method="POST" action="">
        <h6>Paypal settings</h6>
        <div class="sync_paypal">
          <?php
            $table_name = $wpdb->prefix . "sync_options";
            $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_paypal_setting'));
          ?>
          <div class="setting">
            <label>Sandbox: </label>
            <input type="text" name="sync_paypal_sandbox" value="<?php echo (!$entries) ? '' : explode("<>", $entries[0]->option_value, 2)[0]; ?>">
          </div>
          <div class="setting">
            <label>Production: </label>
            <input type="text" name="sync_paypal_production" value="<?php echo (!$entries) ? '' : explode("<>", $entries[0]->option_value, 3)[1]; ?>">
          </div>
          <div class="setting">
            <label>Use: </label>
            <select name="sync_paypal_use">
            <?php echo (!$entries) ? '<option>Select method</option>' : ''; ?>
            <option value="sandbox" <?php echo (explode("<>", $entries[0]->option_value, 4)[2] == 'sandbox') ? 'selected':''; ?>>Sandbox</option>
            <option value="production" <?php echo (explode("<>", $entries[0]->option_value, 4)[2] == 'production') ? 'selected':''; ?> >Production</option>
          </select>
          </div>
          <?php
          // $table_name = $wpdb->prefix . "sync_options";
          // $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_paypal_setting'));
          // if ( ! $entries ) {
            ?>
            <!-- <label>url</label>
            <input type="text" name="sync_paypalurl" value="">
            <label>email</label>
            <input type="text" name="sync_paypalemail" value=""> -->
            <?php
          // }else{
            ?>
           <!-- <label>url</label>
             <input type="text" name="sync_paypalurl" value="<?php echo explode("<>", $entries[0]->option_value, 2)[0]; ?>">
            <label>email</label>
            <input type="text" name="sync_paypalemail" value="<?php echo explode("<>", $entries[0]->option_value, 2)[1]; ?>"> -->
            <?php
          // }
          ?>
          <input type="submit" name="save" class="save-btn btn btn-success" value="Save"/>
        </div>
      </form>
    </div>
    <div class="sync_product_currency_code">
        <h6>Product currency code</h6>
        <div class="container">
          <form id="sync_product_currency" class="sync_product_currency" method="POST" >
            <select name="sync_currency_name">
          <?php
                $table_name = $wpdb->prefix . "sync_options";
                $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s", 'sync_product_currency_code'));
                foreach ($sync_currency  as $key => $value) {
                  if ( $entries && $entries[0]->option_value==$key) {
                    ?>
                    <option selected value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                  }else{
                    ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                  }
                }
            ?>
             </select>
            <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>
          </form>
        </div>
    </div>
    <div class="setting-currency-location">
        <!-- <h6>Supported currency</h6> -->
        <!-- <div class="container"> -->
          <!-- <div class="list-group"> -->
            <?php
                // $entries = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE option_name = %s ORDER BY id DESC",'sync_currency' ) );
                // if ( ! $entries ) {
                //     $wpdb->print_error(); 
                // }else {
                //     foreach ( $entries as $key => $value) {
                        ?>
                        <!-- <a href="#" class="list-group-item select-currency-location" data-id="<?php //echo $value->id;?>" data-select="<?php //echo $entries[$key]->option_value;?>"><?php //echo $entries[$key]->option_value; ?></a> -->
                        <?php
                //     }
                // }
            ?>
          <!-- </div> -->
        <!-- </div> -->
        <!-- <form id="sync_currency" class="sync_currency" method="POST" > -->
              <!-- <div class="item-row"> -->
                <!-- <select name="sync_currency_name"> -->
                  <?php 
                    // foreach ($sync_currency  as $key => $value) {
                      ?>
                      <!-- <option value="<?php //echo $key; ?>"><?php //echo $value; ?></option> -->
                      <?php
                    // }
                  ?>
                  
                <!-- </select> -->
                <!-- <input type="submit" value="Save" name="save" class="save-btn btn btn-success"/> -->
              <!-- </div> -->
        <!-- </form> -->
    <!-- </div> -->
    <div id="currency-widget"></div>
  </section>
   <?php } ?>        
</main>

<div class="modall fade" id="sync_switch_toggle" tabindex="-1" role="dialog" aria-labelledby="sync_switch_toggleLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
     <p>Switching</p>   
  </div>
  <div class="modal-body">     
      <p class="sync-sure">Are you sure?</p>
  </div>
  <div class="modal-footer">
    <form id="" action="">
      <input type="hidden" name="sync_switch" value="">
      <button type="button" class="btn btn-default sync-cancel-switch" data-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-primary btn-ok" >Change</button>
    </form>
  </div>
</div>
</div>
</div>
