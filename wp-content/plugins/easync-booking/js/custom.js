
var temporary_data = [];
var check_total = 0;
var check_subtotal = 0;
var error_trap1 = 0;
var with_driver = '';

var temporary_entry = [];

jQuery(function($) {

    //common//
    $.noConflict();
    //$('.sync_price_money_format').text(Number($('.sync_price_money_format').text().replace(/[^0-9\.-]+/g,""))).simpleMoneyFormat();

    // $('.sync_price_money_format').blur(function(){
    //     var tmp = $(this).val();
    //     var tmp3 = Number(tmp).toLocaleString("en-US", {style:"currency", currency:"PHP", minimumFractionDigits: 2});
    //     $(this).html(tmp3);
    // });


    $('.modall').on('shown.bs.modal', function (e) {
        if($('body').hasClass('wp-admin')==false) {
            $('body').removeClass('modal-open');
            $('html').css('overflow-y', 'hidden');
            $('html').addClass('modal-open');
        }
        
    })

    $('.modall').on('hidden.bs.modal', function (e) {
        if($('body').hasClass('wp-admin')==false) {
            $("body").removeClass('modal-open');
            $("body").css("overflow-y", "hidden");
            $("html").css("overflow-y", "scroll");
            $('html').removeClass('modal-open');
        }
    })

    $('.sync-modal-personal-info').appendTo(document.body);

    $('.sync_price_money_format').blur();

    if($('.sync_form_wrapper').width() < 1090) {
        $('.sync_form_wrapper').addClass('div-size-1090');
    }

    if($('.sync_form_wrapper').width() < 1085) {
        $('.sync_form_wrapper').addClass('div-size-1085');
    }

    if($('.sync_form_wrapper').width() < 1070) {
        $('.sync_form_wrapper').addClass('div-size-1070');
    }

    if($('.sync_form_wrapper').width() < 1016) {
        $('.sync_form_wrapper').addClass('div-size-1016');
    }
    
    if($('.sync_form_wrapper').width() < 1015) {
        $('.sync_form_wrapper').addClass('div-size-1015');
    }

    if($('.sync_form_wrapper').width() < 985) {
        $('.sync_form_wrapper').addClass('div-size-985');
    }

    if($('.sync_form_wrapper').width() < 894) {
        $('.sync_form_wrapper').addClass('div-size-894');
    }

    if($('.sync_form_wrapper').width() < 865) {
        $('.sync_form_wrapper').addClass('div-size-865');
    }

    if($('.sync_form_wrapper').width() < 752) {
        $('.sync_form_wrapper').addClass('div-size-752');
    }

    if($('.sync_form_wrapper').width() < 740) {
        $('.sync_form_wrapper').addClass('div-size-740');
    }

    if($('.sync_form_wrapper').width() < 670) {
        $('.sync_form_wrapper').addClass('div-size-670');
    }

    if($('.sync_form_wrapper').width() < 510) {
        $('.sync_form_wrapper').addClass('div-size-510');
    }

    if($('.sync_form_wrapper').width() < 480) {
        $('.sync_form_wrapper').addClass('div-size-480');
    }

    if($('.sync_form_wrapper').width() < 353) {
        $('.sync_form_wrapper').addClass('div-size-353');
    }

    if($('.sync_form_wrapper').width() < 340) {
        $('.sync_form_wrapper').addClass('div-size-340');
    }


    $(window).on('resize', function(){
            if($('.sync_form_wrapper').width() > 340) {
             $('.sync_form_wrapper').removeClass('div-size-340');
            }
            if($('.sync_form_wrapper').width() > 353) {
             $('.sync_form_wrapper').removeClass('div-size-353');
            }
            if($('.sync_form_wrapper').width() > 480) {
             $('.sync_form_wrapper').removeClass('div-size-480');
            }
            if($('.sync_form_wrapper').width() > 510) {
                $('.sync_form_wrapper').removeClass('div-size-510');
            }
            if($('.sync_form_wrapper').width() > 670) {
                $('.sync_form_wrapper').removeClass('div-size-670');
            }
            if($('.sync_form_wrapper').width() < 1090) {
                $('.sync_form_wrapper').removeClass('div-size-1090');
            }
            if($('.sync_form_wrapper').width() > 1085) {
                $('.sync_form_wrapper').removeClass('div-size-1085');
            }
            if($('.sync_form_wrapper').width() > 1070) {
                $('.sync_form_wrapper').removeClass('div-size-1070');
            }
            if($('.sync_form_wrapper').width() > 1016) {
                $('.sync_form_wrapper').removeClass('div-size-1016');
            }
            if($('.sync_form_wrapper').width() > 1015) {
                $('.sync_form_wrapper').removeClass('div-size-1015');
            }
            if($('.sync_form_wrapper').width() > 985) {
                $('.sync_form_wrapper').removeClass('div-size-985');
            }
            if($('.sync_form_wrapper').width() > 894) {
                $('.sync_form_wrapper').removeClass('div-size-894');
            }
            if($('.sync_form_wrapper').width() > 865) {
                $('.sync_form_wrapper').removeClass('div-size-865');
            }
            if($('.sync_form_wrapper').width() > 752) {
                $('.sync_form_wrapper').removeClass('div-size-752');
            }
            if($('.sync_form_wrapper').width() > 740) {
                $('.sync_form_wrapper').removeClass('div-size-740');
            }
    });



    $("#datepicker_car_rental_return").on('keydown paste', function(e){
        e.preventDefault();
    });

    $('.sync_options_currency_onchange').change(function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        var prices = [];
         $('.sync_container_for_price .sync_price_money_format').each(function(){
           prices.push(Number($(this).text().replace(/[^0-9\.]+/g, "")));
        })
         prices.push(toCurrency(check_total));

        var formData = {
            'type'                : 'currency_symbol',
            'sync_currency_to'    : $(this).val(),
            'sync_currency_from'  : $('.payment input[name="sync_currency_code"]').val(),
            'sync_prices'         : prices,
            'action'              : 'easync_reserved_event',
        };
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/reserved-event.php',
            data        : formData, 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            if (!data.success) {
                 console.log('Something wrong!');
            }else{
                $('.sync_container_for_price .sync_price_money_format').each( function(key , value) {
                   $(this).text('');
                   $(this).text(data.newprice[key]);
                });
                check_total = Number(data.newprice[data.newprice.length-1].replace(/[^0-9\.]+/g, ""));
                $('.sync_currency_symbol').text('');
                $('.sync_currency_symbol').text(data.newsymbol);
                $('.payment input[name="sync_currency_code"]').val(data.newsymbol);
            }
        });
    });

    var now = new Date();
    now.setDate(now.getDate());
    //now.setMonth(now.getMonth()-1);
    //now.setFullYear(now.getFullYear()-1);
    $('.docs-date').datepicker({
        inline: true,
        container: '.docs-datepicker-container',
        zIndex: 2048,
        //filter: function(date) {
            //return date.valueOf() > now ? true : false;
        //}
        startDate: now
    });

    $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
        //filter: function(date) {
            //return date.valueOf() > now ? true : false;
        //}
        startDate: now
    });

    $('[data-toggle="car-datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
        //filter: function(date) {
          //  return date.valueOf() > now ? true : false;
        //}
        startDate: now
    });

    if($('#datepicker_car_rental_pick').val()=="") {
        $('#datepicker_car_rental_pick').datepicker("setDate", now);
    }

    //$('#datepicker_car_rental_return').datepicker("setDate", now);

    $('[data-toggle="car-datepicker"]').change(function(){
        
        if(new Date($('#datepicker_car_rental_pick').val()) >= new Date($('#datepicker_car_rental_return').val())) {//compare end <=, not >=
            var date_return_overrider = new Date($('#datepicker_car_rental_pick').val());
            var new_date = (date_return_overrider.getMonth() + 1) + '/' + (date_return_overrider.getDate() + 1) + '/' +  date_return_overrider.getFullYear();
            $('#datepicker_car_rental_return').val(new_date);
        }
        $('[data-toggle="car-min-datepicker"]').datepicker('destroy');
            var disabledate = $('#datepicker_car_rental_pick').val();
            var disabledate2 = new Date(disabledate);
            disabledate2.setDate(disabledate2.getDate()+1);
            $('[data-toggle="car-min-datepicker"]').datepicker({
                autoHide: true,
                zIndex: 2048,
                startDate: disabledate2
        });
    });

    if($('[data-toggle="car-datepicker"]').val()!="") {
        $('[data-toggle="car-min-datepicker"]').datepicker('destroy');
            var disabledate = $('#datepicker_car_rental_pick').val();
            var disabledate2 = new Date(disabledate);
            disabledate2.setDate(disabledate2.getDate()+1);
            $('[data-toggle="car-min-datepicker"]').datepicker({
                autoHide: true,
                zIndex: 2048,
                startDate: disabledate2
        });
    }

    function remove_error() {
        $('.personal-info.firstname .error').remove();
        $('.personal-info.lastname .error').remove();
        $('.personal-info.phone .error').remove();
        $('.personal-info.email-address .error').remove();
        $('.personal-info.driver-name .error').remove();
        $('.personal-info.driver-phone .error').remove();
        $('.personal-info.image .error').remove();

        $('.address_1 .error.error-address-1').remove();
        $('.address_2 .error.error-address-2').remove();
        $('.province .error.error-province').remove();
        $('.city .error.error-city').remove();
        $('.postal-code .error.error-postal').remove();
        $('.sync_restau_holder_name .error.error-name').remove();
        $('.sync_restau_holder_email .error.error-email-address').remove();
        $('.sync_restau_holder_phone .error.error-phone').remove();
        $('.sync_restau_holder_branch .error.error-branch').remove();
        $('.table_guest .error.error-guest').remove();
        $('.sync-table .error.error-table').remove();
        $('.timeslot .error.error-timeslot').remove();
        $('.docs-datepicker-container .error.error-picked-date').remove();
        $('#restau_continue_payment  .error-pick-item').remove();
    }

   $('#sync_reserved_event').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/reserved-event.php',
            data        : $(this).serialize()+"&action=easync_reserved_event", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                 console.log('Something wrong!');
            }else{
                //location.reload();
                var sync_calendar = '';
                switch(data.typee) {
                    case 'hotel':
                        sync_calendar = '#sync_hotel_calendar';
                        break;
                    case 'car':
                        sync_calendar = '#sync_car_rental_calendar';
                        break;
                    case 'restau':
                        sync_calendar = '#sync_restau_calendar';
                        break;    
                    default:
                         console.log('Something wrong!');
                }

                $.ajax({
                    type        : 'GET',
                    url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/calendar-query.php',
                    data        : "type="+data.typee+"&action=easync_calendar_query", 
                    dataType    : 'json', 
                    encode      : true
                }).done(function(data) {
                    if (!data.success) {
                         console.log('Something wrong!');
                    }else{
                        var events = new Array();
                        for (var i = 0; i < data.count; i++) {
                            if(data.typeee=='restau') {
                                events[i] = {
                                    'title':data.event[i][0]['name'], 
                                    'start':data.event[i][0]['start'],
                                    'allDay': false,
                                    'description': data.event[i][0]['description'],
                                    'backgroundColor': data.event[i][0]['backgroundColor']
                                };
                            }else{
                                events[i] = {
                                    'title':data.event[i][0]['lastname']+', '+data.event[i][0]['firstname'], 
                                    'start':data.event[i][0]['start'],
                                    'end'  :data.event[i][0]['end'],
                                    'allDay': false,
                                    'description': data.event[i][0]['description'],
                                    'backgroundColor': data.event[i][0]['backgroundColor']
                                };
                            }
                        }
                        
                        $(sync_calendar).fullCalendar( 'removeEvents');
                        //$('#sync_hotel_calendar').fullCalendar('removeEventSource', events);
                        $(sync_calendar).fullCalendar('addEventSource', events);
                        $(sync_calendar).fullCalendar('refetchEvents');

                    }
                });
                $('#single_view_entry_modal .close').click();

            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


   //$('#sync_hotel_calendar').fullCalendar();

    // change month
    $('#months-tab').on('click', function() {
        // get month from the tab. Get the year from the current fullcalendar date
        var month = $(this).find(":selected").attr('data-month'),
            year = $("#sync_hotel_calendar").fullCalendar('getDate').format('YYYY');
        
        var m = moment([year, month, 1]).format('YYYY-MM-DD');
        
        $('#sync_hotel_calendar').fullCalendar('gotoDate', m );
    });

    $('#months-tab').change(function() {
        // get month from the tab. Get the year from the current fullcalendar date
        var month = $(this).find(":selected").attr('data-month'),
            year = $("#sync_hotel_calendar").fullCalendar('getDate').format('YYYY');
        
        var m = moment([year, month, 1]).format('YYYY-MM-DD');
        
        $('#sync_hotel_calendar').fullCalendar('gotoDate', m );
    });

    // go to prev year
    $("#prev-year").on('click', function() {
        $('#sync_hotel_calendar').fullCalendar( 'prevYear' );
    });

    $("#next-year").on('click', function() {
        $('#sync_hotel_calendar').fullCalendar( 'nextYear' );
    });


        // change month
    $('#months-tab2').on('click', function() {
        // get month from the tab. Get the year from the current fullcalendar date
        var month = $(this).find(":selected").attr('data-month'),
            year = $("#sync_car_rental_calendar").fullCalendar('getDate').format('YYYY');
        
        var m = moment([year, month, 1]).format('YYYY-MM-DD');
        
        $('#sync_car_rental_calendar').fullCalendar('gotoDate', m );
    });

    $('#months-tab2').change(function() {
        // get month from the tab. Get the year from the current fullcalendar date
        var month = $(this).find(":selected").attr('data-month'),
            year = $("#sync_car_rental_calendar").fullCalendar('getDate').format('YYYY');
        
        var m = moment([year, month, 1]).format('YYYY-MM-DD');
        
        $('#sync_car_rental_calendar').fullCalendar('gotoDate', m );
    });

    // go to prev year
    $("#prev-year2").on('click', function() {
        $('#sync_car_rental_calendar').fullCalendar( 'prevYear' );
    });

    $("#next-year2").on('click', function() {
        $('#sync_car_rental_calendar').fullCalendar( 'nextYear' );
    });


         // change month
    $('#months-tab3').on('click', function() {
        // get month from the tab. Get the year from the current fullcalendar date
        var month = $(this).find(":selected").attr('data-month'),
            year = $("#sync_restau_calendar").fullCalendar('getDate').format('YYYY');
        
        var m = moment([year, month, 1]).format('YYYY-MM-DD');
        
        $('#sync_restau_calendar').fullCalendar('gotoDate', m );
    });

    $('#months-tab3').change(function() {
        // get month from the tab. Get the year from the current fullcalendar date
        var month = $(this).find(":selected").attr('data-month'),
            year = $("#sync_restau_calendar").fullCalendar('getDate').format('YYYY');
        
        var m = moment([year, month, 1]).format('YYYY-MM-DD');
        
        $('#sync_restau_calendar').fullCalendar('gotoDate', m );
    });

    // go to prev year
    $("#prev-year3").on('click', function() {
        $('#sync_restau_calendar').fullCalendar( 'prevYear' );
    });

    $("#next-year3").on('click', function() {
        $('#sync_restau_calendar').fullCalendar( 'nextYear' );
    });

    // set the month as the current month
    // has to be -1 because this is 0 based
  //  var month = $("#sync_hotel_calendar").fullCalendar('getDate').format('MM') -1 ;
    // set the correct month selected
  //  $("#months-tab").find('option[data-month=' + month + ']').prop('selected', true);

    
    //restaurant//
    $('#sync_restau_thank_u').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_restau_thanks&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_restau_privacy').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_restau_privacy&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_restau_terms').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_restau_terms&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $('#sync_restau_banner_image').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_banner_image&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $('#sync_restau_email_head_notify').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_restau_email_head_notify&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $('#sync_restau_email_foot_notify').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_restau_email_foot_notify&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $('#sync_car_email_head_notify').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_car_email_head_notify&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $('#sync_car_email_foot_notify').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_car_email_foot_notify&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $('#sync_hotel_email_head_notify').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_hotel_email_head_notify&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $('#sync_hotel_email_foot_notify').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_hotel_email_foot_notify&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    if(easync_admin_check_login.login==1 && easync_admin_check_page.pageIs=='load') {
       // alert('restau');
        $.ajax({
            type        : 'GET',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/calendar-query.php',
            data        : "type=restau&action=easync_calendar_query", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {

            if (!data.success) {
                console.log('Something wrong!');
            }else{
                var temp_event = new Array();
                for (var i = 0; i < data.count; i++) {
                    temp_event[i] = {
                        'title':data.event[i][0]['name'], 
                        'start':data.event[i][0]['start'],
                        'allDay': false,
                        'description': data.event[i][0]['description'],
                        'backgroundColor': data.event[i][0]['backgroundColor']
                    };
                }
                 var source = { 
                    header: {
                        left: null,
                        center: 'title',
                        right: 'prev,next today'
                    },
                    defaultDate: new Date(),
                    navLinks: false, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    eventMouseover: function (data, event, view) {
                        
                        tooltip = '<div class="sync_calendar_schedule tooltiptopicevent">' 
                        + data.title
                        + '</div>';
                        $("body").append(tooltip);
                        $(this).mouseover(function (e) {
                            $(this).css('z-index', 10000);
                            $('.tooltiptopicevent').fadeIn('500');
                            $('.tooltiptopicevent').fadeTo('10', 1.9);
                        }).mousemove(function (e) {
                            $('.tooltiptopicevent').css('top', e.pageY + 10);
                            $('.tooltiptopicevent').css('left', e.pageX + 20);
                                // if(e.pageY>=970) {
                                //     $('.tooltiptopicevent').css('top', e.pageY / 1.34);
                                // }else{
                                //     $('.tooltiptopicevent').css('top', e.pageY + 10);
                                // }
                                // if(e.pageX>=1076) {
                                //     $('.tooltiptopicevent').css('left', e.pageX / 1.64 );
                                // }else{
                                //     $('.tooltiptopicevent').css('left', e.pageX + 20);
                                // }
                        });
                    },
                    eventMouseout: function (data, event, view) {
                        $(this).css('z-index', 8);
                        $('.tooltiptopicevent').remove();
                    },
                    eventClick: function(data, event, view) {

                        $('.sync_calendar_single_view').attr({
                            'data-values'    : data.description.split('+')[0],
                            'data-label'     : data.description.split('+')[1],
                            'data-id'        : data.description.split('+')[2],
                            'data-dismiss'   : 'modal',
                            'data-toggle'    : 'modal',
                            'data-targett'    : '#single_view_entry_modal',
                            'data-backdrop'  : 'static',
                            'data-keyboard'  : 'false' 
                        });
                        var values = $('.sync_calendar_single_view').attr('data-values').split('<>');
                        var labels = $('.sync_calendar_single_view').attr('data-label').split('<>');
                        var id = $('.sync_calendar_single_view').attr('data-id');
                        var append="";
                        $.each( values, function( key, value ) {     
                            if(labels[key]=='Driver license') {
                                var temp='';
                                $.each( value.split("|"), function( key, path ) { 
                                   temp += '<a data-fancybox="gallery" href="'+path+'"><img src="'+path+'"></a>';
                                });
                                append += '<div class="data-row row-license-image"><span>'+labels[key]+'</span>'+temp+'</div>';
                            }else if(value.length<30 && value.indexOf("qty") == -1){
                                append += '<div class="data-row"><span>'+labels[key]+'</span><span>'+value+'</span></div>';
                            }else if(value.indexOf("qty") != -1){
                                append += '<div class="data-row"><span>'+labels[key]+'</span><p style="text-align:right;">'+value+'</p></div>';
                            }else{
                                append += '<div class="data-row"><span>'+labels[key]+'</span><p style="text-align:right;">'+value+'</p></div>';
                            }
                            
                        });

                        // Fix passed bookings still being able to start
                        var today = moment(new Date());
                        var diff = today.diff(data.start, 'days'); // Calculate date today and start date

                        $('#sync_activator').text('');
                        var reserved_option = '';
                        $('#sync_activator').css('display', 'block');
                        $('#sync_activator').attr('disabled', false);

                        // Fix passed bookings still being able to start
                        if( diff > 0 && (reserved_option != 'trash') ) { // Hide button if days > 1
                            $('#sync_activator').hide();
                            reserved_option = 'trash';
                        }

                        if(values[0]=='Pending') {
                            $('#sync_activator').text('Start');
                            reserved_option = 'active';
                        }else if(values[0]=='Active') {
                            $('#sync_activator').text('End');
                            reserved_option = 'inactive';
                        }else if(values[0]=='Inactive'){
                            $('#sync_activator').text('Trash');
                            reserved_option = 'trash';
                        }else{
                            $('#sync_activator').text('Deleted');
                            $('#sync_activator').attr('disabled', true);
                            $('#sync_activator').css('display', 'none');
                        }    

                        $('#sync_reserved_event input[name="type"]').val('restau');
                        $('#sync_reserved_event input[name="reserve_event_id"]').val(id);
                        $('#sync_reserved_event input[name="reserve_event_option"]').val(reserved_option);
                        $('.data-container').text('');
                        $('.data-container').append(append);
                        $('.sync_calendar_single_view').click();
                    },
                    dayClick: function () {
                        //tooltip.hide();
                    },
                    eventResizeStart: function () {
                        tooltip.hide();
                    },
                    eventDragStart: function () {
                        tooltip.hide();
                    },
                    viewDisplay: function () {
                        tooltip.hide();
                    },
                    events: temp_event
            };
                $('#sync_restau_calendar').fullCalendar( source );
            }
        });
    }

    
    try {
     $('.branch_location').select2({placeholder: "",allowClear: true});
    }
    catch(err) {
      console.log('please set for configuration in restaurant modules')
    }
    $('.timeslot .timeslot-box .timeslot-item').on('click', function() {
        $('.timeslot .timeslot-box .timeslot-item').removeClass('active');
      if($(this).hasClass('active')==true) {
        $(this).removeClass('active');
      }else{
        $(this).addClass('active');
        $('.preferred-timeslot').val($(this).find('input').val());
      }
    });

   
    $('#reserved_table').on('submit', function(event) {
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/validation.php',
            data        : $(this).serialize()+ "&type=restau-second&action=easync_validation", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            if (!data.success) {
                remove_error();
                if (data.errors.namee) {
                    $('#reserved_table .sync_restau_holder_name').append('<div class="error error-name active">' + data.errors.namee + '</div>'); 
                }
                if (data.errors.email) {
                    $('#reserved_table .sync_restau_holder_email').append('<div class="error error-email-address active">' + data.errors.email + '</div>'); 
                }
                if (data.errors.phone_no) {
                    $('#reserved_table .sync_restau_holder_phone').append('<div class="error error-phone active">' + data.errors.phone_no + '</div>'); 
                }
                if (data.errors.branch) {
                    $('#reserved_table .sync_restau_holder_branch').append('<div class="error error-branch active">' + data.errors.branch + '</div>'); 
                }
                if (data.errors.guest_no) {
                    $('#reserved_table .table_guest .sync-guest').append('<div class="error error-guest active">' + data.errors.guest_no + '</div>'); 
                }
                if (data.errors.table_no ) {
                    $('#reserved_table .table_guest .sync-table').append('<div class="error error-table active">' + data.errors.table_no + '</div>'); 
                }
                if (data.errors.timeslot ) {
                    $('#reserved_table .timeslot').append('<div class="error error-timeslot active">' + data.errors.timeslot + '</div>'); 
                }
                if (data.errors.picked_date ) {
                    $('#reserved_table .docs-datepicker-container').append('<div class="error error-picked-date active">' + data.errors.picked_date + '</div>'); 
                }
            }else{
                /*reset*/
                temporary_data = [];
                /*name*/
                temporary_data[0] = data.name;
                /*email*/
                temporary_data[1] = data.email;
                /*phone*/
                temporary_data[2] = data.phone_no;
                /*branch*/
                temporary_data[3] = data.branch;
                /*guest*/
                temporary_data[4] = data.guest_no;
                /*table*/
                temporary_data[5] = data.table_no;
                /*timeslot*/
                temporary_data[6] = data.timeslot;
                /*picked date*/
                temporary_data[7] = data.picked_date;
                

                
                
                $('.reserve-table').attr({
                    'type'           : 'button',
                    'data-dismiss'   : 'modal',
                    'data-toggle'    : 'modal',
                    'data-targett'    : '#restau_menu_info',
                    'data-backdrop'  : 'static',
                    'data-keyboard'  : 'false' 
                });
                $('.reserve-table').click();
                $('.reserve-table').attr({
                    'type'           : 'submit'
                });
                $('.reserve-table').removeAttr('data-dismiss');
                $('.reserve-table').removeAttr('data-toggle');
                $('.reserve-table').removeAttr('data-targett');
                $('.reserve-table').removeAttr('data-backdrop');
                $('.reserve-table').removeAttr('data-keyboard');
            }
        });
         event.preventDefault();
    });

    // var is_change = 0;

    // $(document).on('change','#restau_continue_payment .fourth-row :input',function () {
    //     is_change = 1;
    // });

    //if(is_change==0) {
        // $(document).on('click','.quantity-up, .quantity-down',function() {
        //   $('#restau_continue_payment .fourth-row :input').change();
        // });
    //}

    $('#restau_continue_payment .fourth-row :input').change(function () {

        if(error_trap1==0) {
            var direction      = this.defaultValue < parseInt(this.value);
            this.defaultValue  = this.value;

            var val     = $(this).parent().parent().parent().find('.list-row.fourth-row p:nth-child(2) span:nth-child(2)').text();
            var new_val = $(this).parent().parent().parent().find('.list-row.fourth-row p:last-child() span').text();
            val = Number(val.replace(/[^0-9\.]+/g, ""));
            new_val = Number(new_val.replace(/[^0-9\.]+/g, ""));

            if(direction){
                check_subtotal = (val*(this).value);
                $(this).parent().parent().parent().find('.list-row.fourth-row p:last-child() span').text(toCurrency(check_subtotal));
                check_total += val;
            }
            if(!direction) {
                if(new_val > val) {
                    check_subtotal = new_val-parseFloat(val);
                    $(this).parent().parent().parent().find('.list-row.fourth-row p:last-child() span').text(toCurrency(check_subtotal));
                    check_total -= val;
                }
            }        

            var d_check_total  = check_total;

            $('#restau_menu_info .book-summary-total p span.sync_price_money_format').text(toCurrency(d_check_total));   
        }
        error_trap1=0;     
    });

    $('#restau_continue_payment .special-request-field + label').on('click', function(){
        $('.error.error-pick-item').remove();
        error_trap1 = 1;
        var price = $(this).parent().parent().find('.list-row.fourth-row p:nth-child(2) span:nth-child(2)').text();  
        var qty   = parseInt($(this).parent().parent().find('.fourth-row p:first-child input').val());
        price = Number(price.replace(/[^0-9\.]+/g, ""));

        if($(this).hasClass('active')==true) {
            $(this).parent().parent().find('.fourth-row p:first-child .quantity-nav').css('display', 'none');
            $(this).parent().find('input').prop('checked', false);
            $(this).parent().parent().find('.fourth-row p:first-child input').prop('disabled', true);
            check_total -= (price * qty);
            if(check_total < 0)
                check_total = 0;
        }else{
            $(this).parent().parent().find('.fourth-row p:first-child .quantity-nav').css('display', 'block');
            $(this).parent().find('input').prop('checked', true);
            $(this).parent().parent().find('.fourth-row p:first-child input').prop('disabled', false);
            check_total += (price * qty);
        }

        var d_check_total  = check_total;

        $('#restau_menu_info .book-summary-total p span.sync_price_money_format').text(toCurrency(d_check_total));
    });


    $('.special-request .second-row img').on('click', function() {
        $(this).parent().parent().find('.first-row .special-request-field + label').click();
    });

    $('#restau_continue_payment').on('submit', function(event) {
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/validation.php',
            data        : $(this).serialize()+ "&type=restau&action=easync_validation", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            if (!data.success) {
                remove_error();
                if (data.errors.menu_ids) {
                    $('#restau_continue_payment #tab').append('<div class="error error-pick-item active">' + data.errors.menu_ids + '</div>'); 
                }
            }else{
                /*menu ids*/
                temporary_data[8] = data.menu_ids;
                temporary_entry    = [];
                temporary_entry[0] = [];
                temporary_entry[1] = [];
                temporary_entry[2] = [];
                $.each( data.paypal_items, function( key, value ) {
                  $('.sync_payment_display').prepend('<input type="hidden" name="item_name_'+(key+1)+'" value="'+value+'">');
                  temporary_entry[0][key] = value;
                });
                $.each( data.paypal_item_qtys, function( key, value ) {
                  $('.sync_payment_display').prepend('<input type="hidden" name="item_number_'+(key+1)+'" value="'+value+'">');
                  temporary_entry[1][key]  = value;  
                });
                $.each( data.paypal_item_prices, function( key, value ) {
                  $('.sync_payment_display').prepend('<input type="hidden" name="amount_'+(key+1)+'" value="'+value+'">');
                  temporary_entry[2][key]  = (value / temporary_entry[1][key]);  
                });
                //$('.sync_payment_display input:first-child').val(data.paypal_dis);
               // $('.sync_payment_display input:nth-child(2)').val(data.paypal_dis_price);
                $('.restau-continue-payment').attr({
                    'type'           : 'button',
                    'data-dismiss'   : 'modal',
                    'data-toggle'    : 'modal',
                    'data-targett'    : '#restau_customer_payment',
                    'data-backdrop'  : 'static',
                    'data-keyboard'  : 'false' 
                });
                $('.restau-continue-payment').click();
                $('.restau-continue-payment').attr({
                    'type'           : 'submit'
                });
                $('.restau-continue-payment').removeAttr('data-dismiss');
                $('.restau-continue-payment').removeAttr('data-toggle');
                $('.restau-continue-payment').removeAttr('data-targett');
                $('.restau-continue-payment').removeAttr('data-backdrop');
                $('.restau-continue-payment').removeAttr('data-keyboard');

            }
        });
         event.preventDefault();
    });

    
    $('#restau_pay_now').on('submit', function(event) {
        temporary_entry[4] = 'fail';
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/validation.php',
            data        : $(this).serialize()+"&type=restau-payment&action=easync_validation",
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
             
            if (!data.success) {
                $('body').loading('stop');
                $('.modall').css('z-index', '');
                  remove_error();
                  var genError = "This field is required.";
                    if (data.errors.address_1) {
                        $('.billing-address-info .address_1').append('<div class="error error-address-1 active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .address_1').append('<div class="error error-address-1 ok active"> OK </div>');
                    }
                    if (data.errors.address_2) {
                        $('.billing-address-info .address_2').append('<div class="error error-address-2 active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .address_2').append('<div class="error error-address-2 ok active"> OK </div>');
                    }
                    if (data.errors.province) {
                        $('.billing-address-info .province').append('<div class="error error-province active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .province').append('<div class="error error-province ok active"> OK </div>');
                    }
                    if (data.errors.city) {
                        $('.billing-address-info .city').append('<div class="error error-city active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .city').append('<div class="error error-city ok active"> OK </div>');
                    }
                    if (data.errors.postal_code) {
                        $('.billing-address-info .postal-code').append('<div class="error error-postal active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .postal-code').append('<div class="error error-postal ok active"> OK </div>');
                    }
                //   if (data.errors.address_1) {
                //         $('.billing-address-info .address_1').append('<div class="error error-address-1 active">' + data.errors.address_1 + '</div>'); 
                //     }
                //     if (data.errors.address_2) {
                //         $('.billing-address-info .address_2').append('<div class="error error-address-2 active">' + data.errors.address_2 + '</div>'); 
                //     }
                //     if (data.errors.province) {
                //         $('.billing-address-info .province').append('<div class="error error-province active">' + data.errors.province + '</div>'); 
                //     }
                //     if (data.errors.city) {
                //         $('.billing-address-info .city').append('<div class="error error-city active">' + data.errors.city + '</div>'); 
                //     }
                //     if (data.errors.postal_code) {
                //         $('.billing-address-info .postal-code').append('<div class="error error-postal active">' + data.errors.postal_code + '</div>'); 
                //     }

            }else{

                var temp_path = '.payment-info .billing-address .sync_components .billing-address-info';
                temporary_data[9]  = $(temp_path+' input[name="address_1"]').val();
                temporary_data[10] = $(temp_path+' input[name="address_2"]').val();
                temporary_data[11] = $(temp_path+' input[name="city"]').val();
                temporary_data[12] = $(temp_path+' input[name="province"]').val();
                temporary_data[13] = $(temp_path+' input[name="postal_code"]').val();

                var formData = {
                    'type'           : 'restau',
                    'name'           : temporary_data[0],
                    'email'          : temporary_data[1],
                    'phone_no'       : temporary_data[2],
                    'branch'         : temporary_data[3],
                    'guest_no'       : temporary_data[4],
                    'table_no'       : temporary_data[5],
                    'timeslot'       : temporary_data[6],
                    'picked_date'    : temporary_data[7],
                    'menu_ids'       : temporary_data[8],
                    'address_1'      : temporary_data[9],
                    'address_2'      : temporary_data[10],
                    'city'           : temporary_data[11],
                    'province'       : temporary_data[12],
                    'postal_code'    : temporary_data[13],
                    'action'         :'easync_session_store',
                };

                $.ajax({
                    type        : 'POST',
                    url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/session-store.php',
                    data        : formData, 
                    dataType    : 'json', 
                    encode      : true
                }).done(function(data) {
                    if (!data.success) {
                            console.log('Something wrong!');
                    }else{
                        temporary_data  = [];
                        $('.restau-pay-now').attr({
                            'type'           : 'button',
                            'data-dismiss'   : 'modal',
                            'data-toggle'    : 'modal',
                            'data-targett'    : '#restau_thank_you_modal',
                            'data-backdrop'  : 'static',
                            'data-keyboard'  : 'false' 
                        });
                        //$('.restau-pay-now').click();
                        $('.restau-pay-now').attr({
                            'type'           : 'submit'
                        });
                        $('.restau-pay-now').removeAttr('data-dismiss');
                        $('.restau-pay-now').removeAttr('data-toggle');
                        $('.restau-pay-now').removeAttr('data-targett');
                        $('.restau-pay-now').removeAttr('data-backdrop');
                        $('.restau-pay-now').removeAttr('data-keyboard');

                       // $('#sync_payment_restau_trig').submit();
                    }
                });
            }
        });
         event.preventDefault();
    });
    $('#restau_thank_you_modal .close').on('click', function(e) {
        location.reload();
    });

   

    if(easync_admin_check_login.login==1 && easync_admin_check_page.pageIs=='load') {
    	//car rental//

        $.ajax({
            type        : 'GET',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/calendar-query.php',
            data        : "type=car&action=easync_calendar_query", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                console.log('Something wrong!');
            }else{
                var temp_event = new Array();
                for (var i = 0; i < data.count; i++) {
                    temp_event[i] = {
                        'title':data.event[i][0]['lastname']+', '+data.event[i][0]['firstname'], 
                        'start':data.event[i][0]['start'],
                        'end'  :data.event[i][0]['end'],
                        'allDay': false,
                        'description': data.event[i][0]['description'],
                        'backgroundColor': data.event[i][0]['backgroundColor']
                    };
                }
                console.log(temp_event);
                 var source = { 
                    header: {
                        left: null,
                        center: 'title',
                        right: 'prev,next today'
                    },
                    defaultDate: new Date(),
                    navLinks: false, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    eventMouseover: function (data, event, view) {
                        
                        tooltip = '<div class="sync_calendar_schedule tooltiptopicevent">' 
                        + data.title
                        + '</div>';
                        $("body").append(tooltip);
                        $(this).mouseover(function (e) {
                            $(this).css('z-index', 10000);
                            $('.tooltiptopicevent').fadeIn('500');
                            $('.tooltiptopicevent').fadeTo('10', 1.9);
                        }).mousemove(function (e) {
                            $('.tooltiptopicevent').css('top', e.pageY + 10);
                            $('.tooltiptopicevent').css('left', e.pageX + 20);
                                // if(e.pageY>=970) {
                                //     $('.tooltiptopicevent').css('top', e.pageY / 1.34);
                                // }else{
                                //     $('.tooltiptopicevent').css('top', e.pageY + 10);
                                // }
                                // if(e.pageX>=1076) {
                                //     $('.tooltiptopicevent').css('left', e.pageX / 1.64 );
                                // }else{
                                //     $('.tooltiptopicevent').css('left', e.pageX + 20);
                                // }
                        });
                    },
                    eventMouseout: function (data, event, view) {
                        $(this).css('z-index', 8);
                        $('.tooltiptopicevent').remove();
                    },
                    eventClick: function(data, event, view) {

                        $('.sync_calendar_single_view').attr({
                            'data-values'    : data.description.split('+')[0],
                            'data-label'     : data.description.split('+')[1],
                            'data-id'        : data.description.split('+')[2],
                            'data-dismiss'   : 'modal',
                            'data-toggle'    : 'modal',
                            'data-targett'    : '#single_view_entry_modal',
                            'data-backdrop'  : 'static',
                            'data-keyboard'  : 'false' 
                        });
                        var values = $('.sync_calendar_single_view').attr('data-values').split('<>');
                        var labels = $('.sync_calendar_single_view').attr('data-label').split('<>'); 
                        var id     = $('.sync_calendar_single_view').attr('data-id'); 
                        var append="";
                        $.each( values, function( key, value ) {     
                            if(labels[key]=="Driver\'s License") {
                                var temp='';
                                $.each( value.split("|"), function( key, path ) { 
                                   temp += '<a data-fancybox="gallery" href="'+path+'"><img src="'+path+'"></a>';
                                });
                                append += '<div class="data-row row-license-image"><span>'+labels[key]+'</span>'+temp+'</div>';
                            }else if(value.length<30){
                                append += '<div class="data-row"><span>'+labels[key]+'</span><span>'+value+'</span></div>';
                            }else{
                                append += '<div class="data-row"><span>'+labels[key]+'</span><p>'+value+'</p></div>';
                            }
                        });

                        // Fix passed bookings still being able to start
                        var today = moment(new Date());
                        var diff = today.diff(data.start, 'days'); // Calculate date today and start date

                        $('#sync_activator').text('');
                        var reserved_option = '';
                        $('#sync_activator').css('display', 'block');
                        $('#sync_activator').attr('disabled', false);

                        // Fix passed bookings still being able to start
                        if( diff > 0 && (reserved_option != 'trash') ) { // Hide button if days > 1
                            $('#sync_activator').hide();
                            reserved_option = 'trash';
                        }

                        if(values[0].toLowerCase()=='pending') {
                            $('#sync_activator').text('Start');
                            reserved_option = 'active';
                        }else if(values[0].toLowerCase()=='active') {
                            $('#sync_activator').text('End');
                            reserved_option = 'inactive';
                        }else if(values[0].toLowerCase()=='inactive') {
                            $('#sync_activator').text('Trash');
                            reserved_option = 'trash';
                        }else{
                            $('#sync_activator').text('Deleted');
                            $('#sync_activator').css('display', 'none');
                            $('#sync_activator').attr('disabled', true);

                        }    

                        $('#sync_reserved_event input[name="type"]').val('car');
                        $('#sync_reserved_event input[name="reserve_event_id"]').val(id);
                        $('#sync_reserved_event input[name="reserve_event_option"]').val(reserved_option);
                        $('.data-container').text('');
                        $('.data-container').append(append);    
                        $('.sync_calendar_single_view').click();
                    },
                    dayClick: function () {
                        //tooltip.hide();
                    },
                    eventResizeStart: function () {
                        tooltip.hide();
                    },
                    eventDragStart: function () {
                        tooltip.hide();
                    },
                    viewDisplay: function () {
                        tooltip.hide();
                    },
                    events: temp_event
            };
                $('#sync_car_rental_calendar').fullCalendar( source );
            }
        });
    }
    
    try {
      $('#rental_pick_time').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false,format:'HH:mm'});
      $('#rental_return_time').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false,format:'HH:mm' });
      $('.rental_pick_location').select2({placeholder: "",allowClear: true});
      $('.rental_vehicle_type').select2({placeholder: "",allowClear: true});   
    }
    catch(err) {
      console.log('please set for configuration in car rental modules');
    }
    //$('.province-select').select2({placeholder: "Province",allowClear: true});
	$('.rent-driver + label').on('click', function() {
		$('.rent-driver + label').removeClass('active');
	  if($(this).hasClass('active')==true) {
	  	$(this).removeClass('active');
	  }else{
	  	$(this).addClass('active');
        $('.with_or_out_driver').val($(this).parent().find('input').val());
	  }
	});
    var car_name = '';
    var subtotal = '';
    $('.book-car').on('click', function (e) {
        var car_id       =  $(this).parent().parent().parent().find('.result-item-details input.car-id').val();
        car_name     =  $(this).parent().parent().parent().find('.result-item-details h2').text();
        var car_type     =  $(this).parent().parent().parent().find('.result-item-details p.type span').text();
        var car_model    =  $(this).parent().parent().parent().find('.result-item-details p.model span').text();
        var car_price    =  $(this).parent().parent().parent().find('.result-image span span').text();
        var car_image    =  $(this).parent().parent().parent().find('.result-image img').prop('src');
        var rent_car_day =  $('#car_customer_info .customer-info .first-row .sync_components .car-cost .date input').val();
        //var tax          =  $('#car_customer_info .customer-info .second-row .sync_components .book-summary-subtotal input').val();
        subtotal     =  (rent_car_day*Number(car_price.replace(/[^0-9\.-]+/g,"")));
        total  = subtotal.toFixed(2);
        subtotal  = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        
        var currency_code = $('.payment input[name="sync_currency_code"]').val();
        //reset temporary save//
        temporary_data     = [];
        //car id//
        temporary_data[0]  = car_id;
        if($('.with-or-without').val()=='self-driven') {
            $('.sync_with_driver_container').addClass('active');
            with_driver = 'self-driven';
        }else{
            $('.sync_with_driver_container').removeClass('active');
            with_driver = 'with driver';
        }
        $('#car_customer_info .customer-info .first-row .sync_components .car-profile .car-name h2').text(car_name);
        $('#car_customer_info .customer-info .first-row .sync_components .car-profile .car-name span.type').text('Type: '+car_type);
        $('#car_customer_info .customer-info .first-row .sync_components .car-profile .car-name span.model ').text(car_model);
        $('#car_customer_info .customer-info .first-row .sync_components .car-profile img').prop('src',car_image);
        $('#car_customer_info .customer-info .first-row .sync_components .car-cost .pricing-details p span').text(car_price);
        $('#car_customer_info .customer-info .second-row .sync_components .book-summary-subtotal p:first-child p').text(car_name);
        $('#car_customer_info .customer-info .second-row .sync_components .book-summary-subtotal p:first-child span').text(currency_code+' '+subtotal);
        $('#car_customer_info .customer-info .second-row .sync_components .book-summary-total p span').text(currency_code+' '+subtotal);           
        $('#car_customer_info .customer-info .second-row .sync_components .book-summary-subtotal p strong').text(car_name);
    });

    $('#car_continue_payment').on('submit', function(event) {
         event.preventDefault();
        $('body').loading();
        $('.modall').css('z-index', '0');


        var file1 = document.getElementById("file1").value;
        var file2 = document.getElementById("file2").value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var image_empty = '';
        if(document.getElementById("file1").files.length == 0 || document.getElementById("file2").files.length == 0) {
            image_empty = 'no-file';
        }else if(!allowedExtensions.exec(file1) || !allowedExtensions.exec(file2) ){
            image_empty = 'invalid-file';
        }
        var formData = new FormData(this);         
        formData.append('type', 'car'); 
        formData.append('with_driver', with_driver); 
        // for (var p of formData) {
        //   console.log(p);    
        //+'&action=easync_validation'
        // easync_admin_ajax_directory.ajaxurl
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/validation.php',
            data        : $(this).serialize()+"&type=car&with_driver="+with_driver+"&file_empty="+image_empty+'&action=easync_validation',
            dataType    : 'json', 
            encode      : true
            // contentType: false,
            // cache: false,
            // processData:false,
           // enctype: 'multipart/form-data'
        }).done(function(data) {
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            if (!data.success) {
                remove_error();
               // alert(data.errors.file);
                    if (data.errors.firstname) {
                        $('.personal-info.firstname').append('<div class="error error-firstname active">' + data.errors.firstname + '</div>'); 
                    }else{
                        $('.personal-info.firstname').append('<div class="error error-firstname ok active"> OK </div>');
                    }
                    if (data.errors.lastname) {
                        $('.personal-info.lastname').append('<div class="error error-lastname active">' + data.errors.lastname + '</div>'); 
                    }else{
                        $('.personal-info.lastname').append('<div class="error error-lastname ok active"> OK </div>');
                    }
                    if (data.errors.phone) {
                        $('.personal-info.phone').append('<div class="error error-phone active">' + data.errors.phone + '</div>'); 
                    }else{
                        $('.personal-info.phone').append('<div class="error error-phone ok active"> OK </div>');
                    }
                    if (data.errors.email) {
                        $('.personal-info.email-address').append('<div class="error error-email-address active">' + data.errors.email + '</div>'); 
                    }else{
                        $('.personal-info.email-address').append('<div class="error error-email-address ok active"> OK </div>');
                    }
                    if (data.errors.driver_name) {
                        $('.personal-info.driver-name').append('<div class="error error-driver-name active">' + data.errors.driver_name + '</div>'); 
                    }else{
                        $('.personal-info.driver-name').append('<div class="error error-driver-name ok active"> OK </div>');
                    }
                    if (data.errors.driver_phone) {
                        $('.personal-info.driver-phone').append('<div class="error error-driver-number active">' + data.errors.driver_phone + '</div>'); 
                    }else{
                        $('.personal-info.driver-phone').append('<div class="error error-driver-number ok active"> OK </div>');
                    }
                    if (data.errors.file ) {
                        $('.personal-info.image').append('<div class="error error-driver-image active">' + data.errors.file + '</div>'); 
                    }else{
                        $('.personal-info.image').append('<div class="error error-driver-image ok active"> OK </div>');
                    }
                    $('.modall').animate({scrollTop: $('.modal-header').offset().top}, 200);
            }else{
                //pick date//
                temporary_data[1]  = data.date_pick;
                //pick time//
                temporary_data[2]  = data.pick_time;
                //return date//
                temporary_data[3]  = data.date_return;
                //return time//
                temporary_data[4]  = data.return_time;
                //pickup location//
                temporary_data[5]  = data.pick_location;
                //days number//
                temporary_data[6]  = data.number_days;
                //days number//
                temporary_data[7]  = data.with_or_out_driver;
                //firstname//
                temporary_data[8]  = data.firstname;
                //lastname//
                temporary_data[9]  = data.lastname;
                //phone//
                temporary_data[10]  = data.phone;
                //email//
                temporary_data[11] = data.email;
                //image license//
                temporary_data[12] = data.driver_name;
                //image license//
                temporary_data[13] = data.driver_phone;

                jQuery('.sync_payment_display input:first-child').val(car_name);
                jQuery('.sync_payment_display input:nth-child(2)').val(Number(subtotal.replace(/[^0-9\.]+/g, "")));

                temporary_entry    = [];
                temporary_entry[0] = car_name;
                temporary_entry[1] = Number(subtotal.replace(/[^0-9\.]+/g, "")) / data.number_days;
                temporary_entry[2] = data.number_days;
                temporary_entry[3] = Number(subtotal.replace(/[^0-9\.]+/g, ""));


                remove_error();
                $('.car-continue-payment').attr({
                    'type'           : 'button',
                    'data-dismiss'   : 'modal',
                    'data-toggle'    : 'modal',
                    'data-targett'    : '#car_customer_payment',
                    'data-backdrop'  : 'static',
                    'data-keyboard'  : 'false' 
                });

                $('.car-continue-payment').click();
                $('.car-continue-payment').attr({
                    'type'           : 'submit'
                });
                $('.car-continue-payment').removeAttr('data-dismiss');
                $('.car-continue-payment').removeAttr('data-toggle');
                $('.car-continue-payment').removeAttr('data-targett');
                $('.car-continue-payment').removeAttr('data-backdrop');
                $('.car-continue-payment').removeAttr('data-keyboard');
            }
        });
    });

    $('#car_pay_now').on('submit', function(event) {
        temporary_entry[4] = 'fail';
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/validation.php',
            data        : $(this).serialize()+"&type=car-payment&action=easync_validation",
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
              remove_error();
            if (!data.success) {
                $('body').loading('stop');
                $('.modall').css('z-index', '');
                 
                  var genError = "This field is required.";
                    if (data.errors.address_1) {
                        $('.billing-address-info .address_1').append('<div class="error error-address-1 active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .address_1').append('<div class="error error-address-1 ok active"> OK </div>');
                    }
                    if (data.errors.address_2) {
                        $('.billing-address-info .address_2').append('<div class="error error-address-2 active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .address_2').append('<div class="error error-address-2 ok active"> OK </div>');
                    }
                    if (data.errors.province) {
                        $('.billing-address-info .province').append('<div class="error error-province active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .province').append('<div class="error error-province ok active"> OK </div>');
                    }
                    if (data.errors.city) {
                        $('.billing-address-info .city').append('<div class="error error-city active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .city').append('<div class="error error-city ok active"> OK </div>');
                    }
                    if (data.errors.postal_code) {
                        $('.billing-address-info .postal-code').append('<div class="error error-postal active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .postal-code').append('<div class="error error-postal ok active"> OK </div>');
                    }
                //   if (data.errors.address_1) {
                //         $('.billing-address-info .address_1').append('<div class="error error-address-1 active">' + data.errors.address_1 + '</div>'); 
                //     }
                //     if (data.errors.address_2) {
                //         $('.billing-address-info .address_2').append('<div class="error error-address-2 active">' + data.errors.address_2 + '</div>'); 
                //     }
                //     if (data.errors.province) {
                //         $('.billing-address-info .province').append('<div class="error error-province active">' + data.errors.province + '</div>'); 
                //     }
                //     if (data.errors.city) {
                //         $('.billing-address-info .city').append('<div class="error error-city active">' + data.errors.city + '</div>'); 
                //     }
                //     if (data.errors.postal_code) {
                //         $('.billing-address-info .postal-code').append('<div class="error error-postal active">' + data.errors.postal_code + '</div>'); 
                //     }

            }else{

                var temp_path = '.payment-info .billing-address .sync_components .billing-address-info';
                temporary_data[14] = $(temp_path+' input[name="address_1"]').val();
                temporary_data[15] = $(temp_path+' input[name="address_2"]').val();
                temporary_data[16] = $(temp_path+' input[name="city"]').val();
                temporary_data[17] = $(temp_path+' input[name="province"]').val();
                temporary_data[18] = $(temp_path+' input[name="postal_code"]').val();

                var formData = new FormData();
                formData.append('type', 'car');
                formData.append('with_driver', with_driver);  
                formData.append('car_id', temporary_data[0]);
                formData.append('date_pick', temporary_data[1]);
                formData.append('pick_time', temporary_data[2]);
                formData.append('date_return', temporary_data[3]);
                formData.append('return_time', temporary_data[4]);
                formData.append('pick_location', temporary_data[5]);
                formData.append('number_days', temporary_data[6]);
                formData.append('with_or_out_driver', temporary_data[7]);
                formData.append('firstname', temporary_data[8]);
                formData.append('lastname', temporary_data[9]);
                formData.append('phone', temporary_data[10]);
                formData.append('email', temporary_data[11]);
                formData.append('driver_name', temporary_data[12]);
                formData.append('driver_phone', temporary_data[13]);//
                formData.append('driver_license_image1', $('.personal-info.image #filediv1 input[type=file]')[0].files[0]);
                formData.append('driver_license_image2', $('.personal-info.image #filediv2 input[type=file]')[0].files[0]);
                formData.append('address_1', temporary_data[14]);
                formData.append('address_2', temporary_data[15]);
                formData.append('city', temporary_data[16]);
                formData.append('province', temporary_data[17]);
                formData.append('postal_code', temporary_data[18]);
                formData.append('action', 'easync_session_store');
                // for (var value of formData.values()) {
                //    console.log(value); 
                // }

                $.ajax({
                    type        : 'POST',
                    url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/session-store.php',
                    data        : formData, 
                    dataType    : 'json', 
                    encode      : true,
                    cache       : false,
                    processData : false,
                    contentType : false
                }).done(function(data) {
                    $('body').loading('stop');
                    $('.modall').css('z-index', '');
                    if (!data.success) {
                           // console.log('Something wrong!');
                    }else{
                        temporary_data  = [];
                        $('.car-pay-now').attr({
                            'type'           : 'button',
                            'data-dismiss'   : 'modal',
                            'data-toggle'    : 'modal',
                            'data-targett'    : '#car_thank_you_modal',
                            'data-backdrop'  : 'static',
                            'data-keyboard'  : 'false' 
                        });
                        //$('.car-pay-now').click();
                        $('.car-pay-now').attr({
                            'type'           : 'submit'
                        });
                        $('.car-pay-now').removeAttr('data-dismiss');
                        $('.car-pay-now').removeAttr('data-toggle');
                        $('.car-pay-now').removeAttr('data-targett');
                        $('.car-pay-now').removeAttr('data-backdrop');
                        $('.car-pay-now').removeAttr('data-keyboard');

                        //$('#sync_payment_car_trig').submit();
                         //$('.paypal-button-container .paypal-button').trigger('click');
                         temporary_entry[4] = 'success';
                    }
                });


            }
 
        });  
         event.preventDefault();
    });

    $('#car_thank_you_modal .close').on('click', function(e) {
        location.reload();
    });



	//backend//

    $('#sync_hotel_thank_u').on('submit', function(event){ 
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_hotel_thanks&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                   // console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        }); 
        event.preventDefault();
    });

    $('#sync_hotel_privacy').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_hotel_privacy&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_hotel_terms').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_hotel_terms&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_paypal_config').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_paypal_set&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    try {
      $('#sync_default_pickup').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
      $('#sync_default_return').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
    }
    catch(err) {
      console.log('Please set configuration in car rental modules');
    }

    
    $('#sync_default_car_time').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_default_car_time&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_product_currency').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_product_currency&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });
    

    try{
        $("#sync_hotel_switch").toggleSwitch();
        $("#sync_car_switch").toggleSwitch();
        $("#sync_restau_switch").toggleSwitch();
    }
    catch(err) {
       //console.log('Please set configuration in car restaurant modules');
    }

    $('button[data-dismiss="modal"]').on('click', function (e) {
      $('body').css('overflow-y', 'scroll');
      if($('#'+$(this).attr('data-close')).parent().find('.NubWrapper').hasClass('Checked')) {
        $('#'+$(this).attr('data-close')).parent().find('.NubWrapper').removeClass('Checked');
      }else{
         $('#'+$(this).attr('data-close')).parent().find('.NubWrapper').addClass('Checked');
      }
    });



    $("#sync_hotel_switch").on('change', function() {
        truggerOnSwitch('sync_enable_switch_hotel', this)
    });

    $("#sync_car_switch").on('change', function() {
        truggerOnSwitch('sync_enable_switch_car', this)
    });

    $("#sync_restau_switch").on('change', function() {
        truggerOnSwitch('sync_enable_switch_restau', this)
    });

    var className = $('.sync_settings_enable.hotel').find('.NubWrapper').attr('class');
    var className2 = $('.sync_settings_enable.car').find('.NubWrapper').attr('class');
    var className3 = $('.sync_settings_enable.restau').find('.NubWrapper').attr('class');
    $('.sync-cancel-switch').on('click', function(){

        if($(this).attr('data-close') == 'sync_hotel_switch') {
            if(className=$('.sync_settings_enable.hotel').find('.NubWrapper').attr('class')) {
                $('.sync_settings_enable.hotel').find('.NubWrapper').addClass('Checked');
           }else{
                $('.sync_settings_enable.hotel').find('.NubWrapper').removeClass('Checked');
           }
        }
        if($(this).attr('data-close') == 'sync_car_switch') {
           if(className2==$('.sync_settings_enable.car').find('.NubWrapper').attr('class')) {
                $('.sync_settings_enable.car').find('.NubWrapper').addClass('Checked'); 
           }else{
                $('.sync_settings_enable.hotel').find('.NubWrapper').removeClass('Checked');
           }
        }
        if($(this).attr('data-close') == 'sync_restau_switch') {
            if($('.sync_settings_enable.restau').find('.NubWrapper').hasClass('Checked')==false) {
                $('.sync_settings_enable.restau').find('.NubWrapper').addClass('Checked');
           }
        }
    });

    //NubWrapper Checked

    switching('#sync_enable_switch_hotel', 'option_switch_hotel');
    switching('#sync_enable_switch_car', 'option_switch_car');
    switching('#sync_enable_switch_restau', 'option_switch_restau');


   //  $('#hotel_entries_table').DataTable({
   //      "ordering": false,
   //      columnDefs: [{
   //        orderable: false,
   //        targets: "no-sort",
   //        targets: [ 0, 1, 2 ],
   //        className: 'mdl-data-table__cell--non-numeric'
   //      }],
   //      initComplete: function () {
   //          this.api().columns([6]).every( function () {
   //              var column = this;
   //              var select = $('<select><option value="">All room type</option></select>')
   //                  .appendTo( $(column.footer()).empty() )
   //                  .on( 'change', function () {
   //                      var val = $.fn.dataTable.util.escapeRegex(
   //                          $(this).val()
   //                      );
 
   //                      column
   //                          .search( val ? '^'+val+'$' : '', true, false )
   //                          .draw();
   //                  } );
 
   //              column.data().unique().sort().each( function ( d, j ) {
   //                  select.append( '<option value="'+d+'">'+d+'</option>' )
   //              } );
   //          } );
   //      }

   //     // "order": [4, "asc"]
   // });

   //  $('#car_entries_table').DataTable({
   //      "ordering": false,
   //      columnDefs: [{
   //        orderable: false,
   //        targets: "no-sort",
   //        targets: [ 0, 1, 2 ],
   //        className: 'mdl-data-table__cell--non-numeric'
   //      }],
   //      initComplete: function () {
   //          this.api().columns([6]).every( function () {
   //              var column = this;
   //              var select = $('<select><option value="">All car name</option></select>')
   //                  .appendTo( $(column.footer()).empty() )
   //                  .on( 'change', function () {
   //                      var val = $.fn.dataTable.util.escapeRegex(
   //                          $(this).val()
   //                      );
 
   //                      column
   //                          .search( val ? '^'+val+'$' : '', true, false )
   //                          .draw();
   //                  } );
 
   //              column.data().unique().sort().each( function ( d, j ) {
   //                  select.append( '<option value="'+d+'">'+d+'</option>' )
   //              } );
   //          } );
   //      }
   //     // "order": [4, "asc"]
   // });

   //  $('#restau_entries_table').DataTable({
   //      "ordering": false,
   //      columnDefs: [{
   //        orderable: false,
   //        targets: "no-sort",
   //        targets: [ 0, 1, 2 ],
   //        className: 'mdl-data-table__cell--non-numeric'
   //      }],
   //      initComplete: function () {
   //          this.api().columns([6]).every( function () {
   //              var column = this;
   //              var select = $('<select><option value="">All branch</option></select>')
   //                  .appendTo( $(column.footer()).empty() )
   //                  .on( 'change', function () {
   //                      var val = $.fn.dataTable.util.escapeRegex(
   //                          $(this).val()
   //                      );
 
   //                      column
   //                          .search( val ? '^'+val+'$' : '', true, false )
   //                          .draw();
   //                  } );
 
   //              column.data().unique().sort().each( function ( d, j ) {
   //                  select.append( '<option value="'+d+'">'+d+'</option>' )
   //              } );
   //          } );
   //      }
   //     // "order": [4, "asc"]
   // });

    $('.bubbly-button').on('click', function(event){
        var values = $(this).attr('data-values').split('<>');
        var labels = $(this).attr('data-label').split('<>');
        var append="";
        $.each( values, function( key, value ) {     
            if(labels[key]=='Driver license') {
                var temp='';
                $.each( value.split("|"), function( key, path ) { 
                   temp += '<a data-fancybox="gallery" href="'+path+'"><img src="'+path+'"></a>';
                });
                append += '<div class="data-row row-license-image"><span>'+labels[key]+'</span>'+temp+'</div>';
            }else if(value.length<30){
                append += '<div class="data-row"><span>'+labels[key]+'</span><span>'+value+'</span></div>';
            }else{
                append += '<div class="data-row"><span>'+labels[key]+'</span><p>'+value+'</p></div>';
            }
        });
        $('.data-container').text('');
        $('.data-container').append(append);
    });

    $(document).on('click','.select-branch-location',function(event){
        $('.sync_branch input[name="branch_name"]').val($(this).attr('data-value'));
        var append = '<input type="submit" value="Update" name="update" class="update-btn btn btn-success"/>'
                   +'  <input type="submit" value="Delete" name="delete" class="remove-btn btn btn-danger"/>'
                   +'  <input type="button" value="New" name="option_trig" class="new-btn btn btn-primary"/>'
                   +'  <input type="hidden" name="branch_id" value="'+$(this).attr('data-id')+'">';

        $('.sync_branch .item-row input[name="branch_id"]').remove();           
        $('.sync_branch .item-row .save-btn').remove();
        $('.sync_branch .item-row .update-btn').remove();
        $('.sync_branch .item-row .remove-btn').remove();
        $('.sync_branch .item-row .new-btn').remove();
        $('.sync_branch .item-row').append(append);
        event.preventDefault();
    });

    $(document).on('click', '.sync_branch .item-row .new-btn',function(){
        var append = '<input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>';
        $('.sync_branch .item-row input[name="branch_name"]').val('');
        $('.sync_branch .item-row .update-btn').remove();
        $('.sync_branch .item-row .remove-btn').remove();
        $('.sync_branch .item-row .new-btn').remove();
        $('.sync_branch .item-row').append(append);
    });

    var trig_on = '';
    $(document).on('click', '.sync_branch .item-row .update-btn', function(){
        trig_on = 'update';
    });

    $(document).on('click', '.sync_branch .item-row .save-btn', function(){
        trig_on = 'save';
    });

    $(document).on('click', '.sync_branch .item-row .remove-btn', function(){
        trig_on = 'delete';
    });

    $('#sync_branch').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_branch&trig="+trig_on+"&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }else{
                $('#sync_branch').parent().find('.container .list-group').empty();
                var append = '';
                $.each(data.entries, function( index, value ) {
                  append += '<a href="#" class="list-group-item select-branch-location" data-id="'+value.id+'" data-value="'+value.option_value+'" >'+value.option_value+'</a>';
                });
                $('#sync_branch').parent().find('.container .list-group').append(append);
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $(document).on('click','.select-pickup-location',function(event){
        $('.sync_car_pickup input[name="location_name"]').val($(this).attr('data-value'));
        var append = '<input type="submit" value="Update" name="update" class="update-btn btn btn-success"/>'
                   +'  <input type="submit" value="Delete" name="delete" class="remove-btn btn btn-danger"/>'
                   +'  <input type="button" value="New" name="option_trig" class="new-btn btn btn-primary"/>'
                   +'  <input type="hidden" name="pickup_id" value="'+$(this).attr('data-id')+'">';

        $('.sync_car_pickup .item-row input[name="pickup_id"]').remove();           
        $('.sync_car_pickup .item-row .save-btn').remove();
        $('.sync_car_pickup .item-row .update-btn').remove();
        $('.sync_car_pickup .item-row .remove-btn').remove();
        $('.sync_car_pickup .item-row .new-btn').remove();
        $('.sync_car_pickup .item-row').append(append);
        event.preventDefault();
    });

    $(document).on('click', '.sync_car_pickup .item-row .new-btn', function(){
        var append = '<input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>';
        $('.sync_car_pickup .item-row input[name="location_name"]').val('');
        $('.sync_car_pickup .item-row .update-btn').remove();
        $('.sync_car_pickup .item-row .remove-btn').remove();
        $('.sync_car_pickup .item-row .new-btn').remove();
        $('.sync_car_pickup .item-row').append(append);
    });

    $(document).on('click', '.sync_car_pickup .item-row .update-btn', function(){
        trig_on = 'update';
    });

    $(document).on('click', '.sync_car_pickup .item-row .save-btn', function(){
        trig_on = 'save';
    });

    $(document).on('click', '.sync_car_pickup .item-row .remove-btn', function(){
        trig_on = 'delete';
    });

    $('#sync_car_pickup').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_pickup_location&trig="+trig_on+"&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }else{
                $('#sync_car_pickup').parent().find('.container .list-group').empty();
                var append = '';
                $.each(data.entries, function( index, value ) {
                  append += '<a href="#" class="list-group-item select-pickup-location" data-id="'+value.id+'" data-value="'+value.option_value+'">'+value.option_value+'</a>';
                });
                $('#sync_car_pickup').parent().find('.container .list-group').append(append);
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });


    $(document).on('click','.select-car-type',function(event){
        $('.sync_car_types input[name="type_name"]').val($(this).attr('data-value'));
        var append = '<input type="submit" value="Update" name="update" class="update-btn btn btn-success"/>'
                   +'  <input type="submit" value="Delete" name="delete" class="remove-btn btn btn-danger"/>'
                   +'  <input type="button" value="New" name="option_trig" class="new-btn btn btn-primary"/>'
                   +'  <input type="hidden" name="type_id" value="'+$(this).attr('data-id')+'">';

        $('.sync_car_types .item-row input[name="type_id"]').remove();           
        $('.sync_car_types .item-row .save-btn').remove();
        $('.sync_car_types .item-row .update-btn').remove();
        $('.sync_car_types .item-row .remove-btn').remove();
        $('.sync_car_types .item-row .new-btn').remove();
        $('.sync_car_types .item-row').append(append);
        event.preventDefault();
    });

    $(document).on('click', '.sync_car_types .item-row .new-btn', function(){
        var append = '<input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>';
        $('.sync_car_types .item-row input[name="type_name"]').val('');
        $('.sync_car_types .item-row .update-btn').remove();
        $('.sync_car_types .item-row .remove-btn').remove();
        $('.sync_car_types .item-row .new-btn').remove();
        $('.sync_car_types .item-row').append(append);
    });

    $(document).on('click', '.sync_car_types .item-row .update-btn', function(){
        trig_on = 'update';
    });

    $(document).on('click', '.sync_car_types .item-row .save-btn', function(){
        trig_on = 'save';
    });

    $(document).on('click', '.sync_car_types .item-row .remove-btn', function(){
        trig_on = 'delete';
    });

    $('#sync_car_types').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_car_types&trig="+trig_on+"&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }else{
                $('#sync_car_types').parent().find('.container .list-group').empty();
                var append = '';
                $.each(data.entries, function( index, value ) {
                  append += '<a href="#" class="list-group-item select-car-type" data-id="'+value.id+'" data-value="'+value.option_value+'">'+value.option_value+'</a>';
                });
                $('#sync_car_types').parent().find('.container .list-group').append(append);
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });    



    $(document).on('click','.select-car-model',function(event){
        $('.sync_car_model input[name="model_name"]').val($(this).attr('data-value'));
        var append = '<input type="submit" value="Update" name="update" class="update-btn btn btn-success"/>'
                   +'  <input type="submit" value="Delete" name="delete" class="remove-btn btn btn-danger"/>'
                   +'  <input type="button" value="New" name="option_trig" class="new-btn btn btn-primary"/>'
                   +'  <input type="hidden" name="model_id" value="'+$(this).attr('data-id')+'">';

        $('.sync_car_model .item-row input[name="model_id"]').remove();           
        $('.sync_car_model .item-row .save-btn').remove();
        $('.sync_car_model .item-row .update-btn').remove();
        $('.sync_car_model .item-row .remove-btn').remove();
        $('.sync_car_model .item-row .new-btn').remove();
        $('.sync_car_model .item-row').append(append);
        event.preventDefault();
    });

    $(document).on('click', '.sync_car_model .item-row .new-btn', function(){
        var append = '<input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>';
        $('.sync_car_model .item-row input[name="model_name"]').val('');
        $('.sync_car_model .item-row .update-btn').remove();
        $('.sync_car_model .item-row .remove-btn').remove();
        $('.sync_car_model .item-row .new-btn').remove();
        $('.sync_car_model .item-row').append(append);
    });

    $(document).on('click', '.sync_car_model .item-row .update-btn', function(){
        trig_on = 'update';
    });

    $(document).on('click', '.sync_car_model .item-row .save-btn', function(){
        trig_on = 'save';
    });

    $(document).on('click', '.sync_car_model .item-row .remove-btn', function(){
        trig_on = 'delete';
    });

    $('#sync_car_model').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_car_model&trig="+trig_on+"&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }else{
                $('#sync_car_model').parent().find('.container .list-group').empty();
                var append = '';
                $.each(data.entries, function( index, value ) {
                  append += '<a href="#" class="list-group-item select-car-model" data-id="'+value.id+'" data-value="'+value.option_value+'">'+value.option_value+'</a>';
                });
                $('#sync_car_model').parent().find('.container .list-group').append(append);
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });    



    $(document).on('click','.select-currency-location',function(event){
        $('.sync_currency select[name="sync_currency_name"] option[value="'+$(this).attr('data-select')+'"]').prop('selected', true);
        var append = '<input type="submit" value="Update" name="update" class="update-btn btn btn-success"/>'
                   +'  <input type="submit" value="Delete" name="delete" class="remove-btn btn btn-danger"/>'
                   +'  <input type="button" value="New" name="option_trig" class="new-btn btn btn-primary"/>'
                   +'  <input type="hidden" name="sync_currency_id" value="'+$(this).attr('data-id')+'">';

        $('.sync_currency .item-row input[name="sync_currency_id"]').remove();           
        $('.sync_currency .item-row .save-btn').remove();
        $('.sync_currency .item-row .update-btn').remove();
        $('.sync_currency .item-row .remove-btn').remove();
        $('.sync_currency .item-row .new-btn').remove();
        $('.sync_currency .item-row').append(append);
        event.preventDefault();
    });

    $(document).on('click', '.sync_currency .item-row .new-btn', function(){
        var append = '<input type="submit" value="Save" name="save" class="save-btn btn btn-success"/>';
        $('.sync_currency .item-row .update-btn').remove();
        $('.sync_currency .item-row .remove-btn').remove();
        $('.sync_currency .item-row .new-btn').remove();
        $('.sync_currency .item-row').append(append);
    });

    $(document).on('click', '.sync_currency .item-row .update-btn', function(){
        trig_on = 'update';
    });

    $(document).on('click', '.sync_currency .item-row .save-btn', function(){
        trig_on = 'save';
    });

    $(document).on('click', '.sync_currency .item-row .remove-btn', function(){
        trig_on = 'delete';
    });

    $('#sync_currency').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_currency&trig="+trig_on+"&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }else{
                $('#sync_currency').parent().find('.container .list-group').empty();
                var append = '';
                $.each(data.entries, function( index, value ) {
                  append += '<a href="#" class="list-group-item select-currency-location" data-id="'+value.id+'" data-select="'+value.option_value+'">'+value.option_value+'</a>';
                });
                $('#sync_currency').parent().find('.container .list-group').append(append);
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
        });
        event.preventDefault();
    });


    $('#sync_car_thank_u').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_car_thanks&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_car_privacy').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_car_privacy&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_car_terms').on('submit', function(event){
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_car_terms&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });

    $('#sync_rental_tax').on('submit', function(event){
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_rental_tax&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }else{
                location.reload();
            }
        });
        event.preventDefault();
    });

    $('#sync_hotel_tax').on('submit', function(event){
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_hotel_tax&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }else{
                location.reload();
            }
        });
        event.preventDefault();
    });

    try {
    
        $('#timeslot1').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot1_1').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot2').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot1_2').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot3').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot1_3').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot4').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot1_4').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot5').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
        $('#timeslot1_5').timeDropper({autoswitch:true,mousewheel:true,meridians:true,init_animation:'dropdown',setCurrentTime:false});
    }
    catch(err) {
        console.log('Please set configuration in car restaurant modules');
    }

    timeslot(1);
    timeslot(2);
    timeslot(3);
    timeslot(4);
    timeslot(5);

    //hotel booking//

    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });

    $('#spend_night_hotel').add('.holder-guest-number input').add('.holder-rooms-number input').keypress(function(e) {
        return false
    });

    // $('.quantity input').keydown(function (e) {
    //     var key = e.keyCode || e.charCode;
    //     if (key == 8 || key == 46) {
    //         e.preventDefault();
    //         e.stopPropagation();
    //     }
    //   });

    $('.holder-night input').add('.holder-guest-number input').add('.holder-rooms-number input').keydown(function (e) {
      var key = e.keyCode || e.charCode;
      if (key == 8 || key == 46) {
          e.preventDefault();
          e.stopPropagation();
      }
    });  

      $('.holder-guest-number input').unbind('keyup change input paste').bind('keyup change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
        }
    }); 

    $('.holder-rooms-number input').unbind('keyup change input paste').bind('keyup change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
        }
    }); 

    if(easync_admin_check_login.login==1 && easync_admin_check_page.pageIs=='load') {

        $.ajax({
            type        : 'GET',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/calendar-query.php',
            data        : "type=hotel&action=easync_calendar_query", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                 console.log('Something wrong!');
            }else{
                var temp_event = new Array();
                for (var i = 0; i < data.count; i++) {
                    temp_event[i] = {
                        'title':data.event[i][0]['lastname']+', '+data.event[i][0]['firstname'], 
                        'start':data.event[i][0]['start'],
                        'end'  :data.event[i][0]['end'],
                        'allDay': false,
                        'description': data.event[i][0]['description'],
                        'backgroundColor': data.event[i][0]['backgroundColor']
                    };
                }
                 var source = { 
                    header: {
                        left: null,
                        center: 'title',
                        right: 'prev,next today'
                    },
                    defaultDate: new Date(),
                    navLinks: false, // can click day/week names to navigate views
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    eventMouseover: function (data, event, view) {
                        
                        tooltip = '<div class="sync_calendar_schedule tooltiptopicevent ">' 
                        + data.title
                        + '</div>';
                        $("body").append(tooltip);
                        $(this).mouseover(function (e) {
                            $(this).css('z-index', 10000);
                            $('.tooltiptopicevent').fadeIn('500');
                            $('.tooltiptopicevent').fadeTo('10', 1.9);
                        }).mousemove(function (e) {
                            $('.tooltiptopicevent').css('top', e.pageY + 10);
                            $('.tooltiptopicevent').css('left', e.pageX + 20);
                                // if(e.pageY>=970) {
                                //     $('.tooltiptopicevent').css('top', e.pageY / 1.34);
                                // }else{
                                //     $('.tooltiptopicevent').css('top', e.pageY + 10);
                                // }
                                // if(e.pageX>=1076) {
                                //     $('.tooltiptopicevent').css('left', e.pageX / 1.64 );
                                // }else{
                                //     $('.tooltiptopicevent').css('left', e.pageX + 20);
                                // }
                        });
                    },
                    eventMouseout: function (data, event, view) {
                        $(this).css('z-index', 8);
                        $('.tooltiptopicevent').remove();
                    },
                    eventClick: function(data, event, view) {

                        $('.sync_calendar_single_view').attr({
                            'data-values'    : data.description.split('+')[0],
                            'data-label'     : data.description.split('+')[1],
                            'data-id'        : data.description.split('+')[2],
                            'data-dismiss'   : 'modal',
                            'data-toggle'    : 'modal',
                            'data-targett'    : '#single_view_entry_modal',
                            'data-backdrop'  : 'static',
                            'data-keyboard'  : 'false' 
                        });
                        var values = $('.sync_calendar_single_view').attr('data-values').split('<>');
                        var labels = $('.sync_calendar_single_view').attr('data-label').split('<>'); 
                        var id = $('.sync_calendar_single_view').attr('data-id'); 
                        var append="";
                        $.each( values, function( key, value ) {     
                            if(labels[key]=='Driver license') {
                                var temp='';
                                $.each( value.split("|"), function( key, path ) { 
                                   temp += '<a data-fancybox="gallery" href="'+path+'"><img src="'+path+'"></a>';
                                });
                                append += '<div class="data-row row-license-image"><span>'+labels[key]+'</span>'+temp+'</div>';
                            }else if(value.length<30){
                                append += '<div class="data-row"><span>'+labels[key]+'</span><span>'+value+'</span></div>';
                            }else{
                                append += '<div class="data-row"><span>'+labels[key]+'</span><p style="text-align:right;">'+value+'</p></div>';
                            }
                        });

                        // Fix passed bookings still being able to start
                        var today = moment(new Date());
                        var diff = today.diff(data.start, 'days'); // Calculate date today and start date
                        var end_diff = today.diff(data.end, 'days');

                        $('#sync_activator').text('');
                        var reserved_option = '';
                        $('#sync_activator').css('display', 'block');
                        $('#sync_activator').attr('disabled', false);

                        // Fix passed bookings still being able to start
                        if( diff > 0 && (reserved_option != 'trash') ) { // Hide button if days > 1
                            $('#sync_activator').hide();
                            reserved_option = 'trash';
                        }

                        if(values[0]=='Pending') {
                            $('#sync_activator').text('Start');
                            reserved_option = 'active';
                        }else if(values[0]=='Active') {
                            $('#sync_activator').text('End');
                            reserved_option = 'inactive';
                        }else if(values[0]=='Inactive') {
                            $('#sync_activator').text('Trash');
                            reserved_option = 'trash';
                        }else{
                            $('#sync_activator').text('Deleted');
                            $('#sync_activator').css('display', 'none');
                            $('#sync_activator').attr('disabled', true);
                        }    

                        $('#sync_reserved_event input[name="type"]').val('hotel');
                        $('#sync_reserved_event input[name="reserve_event_id"]').val(id);
                        $('#sync_reserved_event input[name="reserve_event_option"]').val(reserved_option);
                        $('.data-container').text('');
                        $('.data-container').append(append);    
                        $('.sync_calendar_single_view').click();
                    },
                    dayClick: function () {
                        //tooltip.hide();
                    },
                    eventResizeStart: function () {
                        tooltip.hide();
                    },
                    eventDragStart: function () {
                        tooltip.hide();
                    },
                    viewDisplay: function () {
                        tooltip.hide();
                    },
                    events: temp_event
            };
                $('#sync_hotel_calendar').fullCalendar( source );
            }
        });
    }

	Date.prototype.addDays = function(days) {
	  var dat = new Date($('#datepicker_hotel').val());
	  dat.setDate(dat.getDate() + days);
	  return (dat.getMonth() + 1) + '/' + dat.getDate() + '/' +  dat.getFullYear();
	}

	// var temp=0;
	// var typingTimer;                
	// var doneTypingInterval = 1000;  
	// var $input = $('.quantity-up');
	// $input.on('click', function () {
	//   clearTimeout(typingTimer);
	//   typingTimer = setTimeout(doneTyping, doneTypingInterval);
	// });

	// $input.on('click', function () {
	//   if(temp==0) {	
	//   	temp = 1;
	//   	$('#date_departure_num').append('<i class="far fa-clock fa-2x loading-clock"></i>');
	//   }
	//   clearTimeout(typingTimer);
	// });

    var now = new Date();
    now.setDate(now.getDate());
    if($('#datepicker_hotel').val()=="") {
        $('#datepicker_hotel').datepicker("setDate", now);
    }

    // Fix date calculation on change
    $('#datepicker_hotel').change(function() {
        check_out_stat();
    })


	$('.quantity-up').on('click', function () {
		check_out_stat();
	});

    $('.quantity-down').on('click', function () {
        check_out_stat();
    });

    check_out_stat();

    function check_out_stat() {
        var dat = new Date();
        $('.date_departure').text('');
        $('#date_departure_num').text('');
        $('.date_departure').append(dat.addDays(parseInt($('#spend_night_hotel').val())));
        $('#date_departure').val(dat.addDays(parseInt($('#spend_night_hotel').val())));
        $('#date_departure_num').append('<i class="fas fa-moon fa-1x"></i> '+$('#spend_night_hotel').val()+' night(s) only');
    }


	$('.modall').on('show.bs.modal', function (e) {
	    $('body').css('overflow-y', 'hidden');
	})
	$('.close').on('click', function (e) {
	  $('body').css('overflow-y', 'scroll');
      $('.modall.sync-transform').css('overflow-y', 'scroll');   
	})
	$('.find-room').on('click', function(e) {
		var arrive_date    = $(this).parent().parent().parent().parent().find('.sync_components .holder-calendar input#datepicker_hotel ').val();
		var departure_date = $(this).parent().parent().parent().parent().find('.sync_components .holder-check-out label.date_departure ').text();
		var night_number   = $(this).parent().parent().parent().parent().find('.sync_components .holder-night input#spend_night_hotel ').val();
		var guest_number   = $(this).parent().parent().parent().parent().find('.sync_components .holder-guest-number input').val();
		var room_number    = $(this).parent().parent().parent().parent().find('.sync_components .holder-rooms-number input').val();		
		$('.error-check-in').removeClass('active');
		$('.error-night-number').removeClass('active');
		$('.error-guest-number').removeClass('active');
		$('.error-room-number').removeClass('active');		
		var required = false;
		if(arrive_date=='') {
			$('.error-check-in').addClass('active');
			required = true;
		}
		if(night_number=='') {
			$('.error-night-number').addClass('active');
			required = true;
		}
		if(guest_number=='') {
			$('.error-guest-number').addClass('active');	
			required = true;		
		}
		if(room_number=='') {
			$('.error-room-number').addClass('active');	
			required = true;		
		}
		if(required==false){
			$('#search_hotel_room').submit();	
		}
	});

    var room_title = '';
    var subtotal = '';
	$(document).on('click', '.book-save', function (e) {
		var room_id         =  $(this).parent().parent().find('.result-item-details input.room-id').val();
		room_title      =  $(this).parent().parent().find('.result-item-details h2').text();
		var room_desc       =  $(this).parent().parent().find('.result-item-details p').text();
		var room_price      =  $(this).parent().parent().find('.result-image span span').text();
		var night_number    =  $('.customer-info .first-row .sync_components .room-cost .date span span').text();
		var number_room     =  $('#customer_info .customer-info .first-row .sync_components .room-cost .rooms p span').text();
		var room_image      =  $(this).parent().parent().find('.result-image img').prop('src');
		var obj_amenities   =  $(this).parent().parent().find('.result-item-details input.amenities').val();
        var obj_facilities  =  $(this).parent().parent().find('.result-item-details input.facilities-special-request').val();
        
        var specify_request =  $(this).parent().parent().find('.result-item-details input.specify-special-request').val();
        var arr = obj_amenities.split(',');
        arr = arr.slice(0, -1);
        var amenities = '';
        $.each( arr, function( key, value ) {
          amenities += '  <span><i class="fas fa-dot-circle"></i> '+value+'</span>';
        });
        var arr = obj_facilities.split(',');
        arr = arr.slice(0, -1);
        var facilities = '';
        $.each( arr, function( key, value ) {
          facilities += '<div class="personal-info">'
                     +  '<input type="checkbox" name="request_facilities[]" value="'+value+'" class="special-request-field">'
                     +  '<label>'+value+'</label></div>';
        });
        
        
        
        $('#customer_info .customer-info .second-row .sync_components .special-request-others label').css('display', 'none');
        $('#customer_info .customer-info .second-row .sync_components .special-request-others textarea').remove(); 
        if(specify_request=='Yes') {
            facilities += '<div class="personal-info">'
                       +  '<input type="checkbox" name="others" value="others" class="others-req special-request-field">'
                       +  '<label>Others</label></div>';
            var append = '<textarea placeholder=" " width="500" name="other_req"> </textarea>';   
            $('#customer_info .customer-info .second-row .sync_components .special-request-others label').css('display', 'block');
            $('#customer_info .customer-info .second-row .sync_components .special-request-others textarea').remove();       
            $('#customer_info .customer-info .second-row .sync_components .special-request-others').append(append);
        }

		//var tax           =  $('#customer_info .customer-info .second-row .sync_components .book-summary-subtotal input').val();
        var currency_code = $('.payment input[name="sync_currency_code"]').val();
		subtotal  =  (night_number*(number_room*Number(room_price.replace(/[^0-9\.-]+/g,""))));
        subtotal  = subtotal.toFixed(2);
        subtotal  = subtotal.toString().replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");

        //alert(subtotal.toString());

		//reset temporary save//
		temporary_data     = [];
		//room id//
		temporary_data[0]  = room_id;
		$('#customer_info .customer-info .first-row .sync_components .room-profile h2').text(room_title);
        $('#customer_info .customer-info .first-row .sync_components .room-profile .amenities').text('');
		$('#customer_info .customer-info .first-row .sync_components .room-profile .amenities').append(amenities);
        $('#customer_info .customer-info .second-row .sync_components .special-request .special-request-holder').text('');
        $('#customer_info .customer-info .second-row .sync_components .special-request .special-request-holder').append(facilities);
		$('#customer_info .customer-info .first-row .sync_components .room-profile img').prop('src',room_image);
		$('#customer_info .customer-info .first-row .sync_components .room-cost .pricing-details p span').text(room_price);
		$('#customer_info .customer-info .second-row .sync_components .book-summary-subtotal p:first-child span').text(currency_code+' '+subtotal);
        $('#customer_info .customer-info .second-row .sync_components .book-summary-subtotal p strong').text(room_title);
		$('#customer_info .customer-info .second-row .sync_components .book-summary-total p span').text(currency_code+' '+subtotal);			  
    });
    $(document).on('click', '.special-request-others textarea', function() {
        $('.special-request-others textarea').prop('readonly', false);
        $('.others-req + label').addClass('active');
        $('.others-req + label').parent().find('input').prop('checked', true);
    });
    $(document).on('click', '.special-request-field + label', function() {
      if($(this).hasClass('active')==true) {
        $(this).removeClass('active');
        $(this).parent().find('input').prop('checked', false);
      }else{
        $(this).addClass('active');
        $(this).parent().find('input').prop('checked', true);
      }
    });
	$(document).on('click', '.others-req + label', function (e) {
		if($('.special-request-others textarea').is(':disabled')) {
			$('.special-request-others textarea').prop('readonly', false);
		}else{
			$('.special-request-others textarea').prop('readonly', false);
			$('.special-request-others textarea').val("");
		}
	})
     
	$('#continue_payment').on('submit', function(event) {
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/validation.php',
            data        : $(this).serialize()+"&type=hotel&action=easync_validation",
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            $('body').loading('stop');
            $('.modall').css('z-index', '');
        	if (!data.success) {
        		remove_error();
					if (data.errors.firstname) {
						$('.personal-info.firstname').append('<div class="error error-firstname active">' + data.errors.firstname + '</div>'); 
					}else{
                        $('.personal-info.firstname').append('<div class="error error-firstname ok active"> OK </div>');
                    }
					if (data.errors.lastname) {
						$('.personal-info.lastname').append('<div class="error error-lastname active">' + data.errors.lastname + '</div>'); 
					}else{
                        $('.personal-info.lastname').append('<div class="error error-lastname ok active"> OK </div>'); 
                    }
					if (data.errors.phone) {
						$('.personal-info.phone').append('<div class="error error-phone active">' + data.errors.phone + '</div>'); 
					}else{
                        $('.personal-info.phone').append('<div class="error error-phone ok active"> OK </div>'); 
                    }
					if (data.errors.email) {
						$('.personal-info.email-address').append('<div class="error error-email-address active">' + data.errors.email + '</div>'); 
					}else{
                        $('.personal-info.email-address').append('<div class="error error-email-address ok active"> OK </div>'); 
                    }
					$('.modall').animate({scrollTop: $('.modal-header').offset().top}, 200);
        	}else{
        		//arrival date//
        		temporary_data[1]   = data.date_arrive;
        		//departure date//
        		temporary_data[2]   = data.date_departure;
        		//night number//
        		temporary_data[3]   = data.night_number;
        		//guestnumber//
        		temporary_data[4]   = data.number_guest;
        		//rooms number//
        		temporary_data[5]   = data.number_room;
        		//firstname//
        		temporary_data[6]   = data.firstname;
        		//lastname//
        		temporary_data[7]   = data.lastname;
        		//phone//
        		temporary_data[8]   = data.phone;
        		//email//
        		temporary_data[9]   = data.email;
                //request facilities
                temporary_data[10] = data.facility_request;
        		//other request// 
        		temporary_data[11]  = data.other_req;

                jQuery('.sync_payment_display input:first-child').val(room_title);
                jQuery('.sync_payment_display input:nth-child(2)').val(Number(subtotal.replace(/[^0-9\.]+/g, "")));

//        		$('#for_payment_room_type').remove();
//				$('#for_payment_room_amount').remove();
//                var to_paypal_room_type = $('.customer-info .first-row .sync_components .room-profile h2').text();
//                var to_paypal_room_amount   = $('#continue_payment .sync_components .book-summary-total p span').text();
//                var to_paypal = '<input type="hidden" name="item_name" id="for_payment_room_type" value="'+to_paypal_room_type+'">'
//	        				  + '<input type="hidden" name="amount" id="for_payment_amount" value="'+to_paypal_room_amount+'">';
//        		$('#redirect_paypal').prepend(to_paypal);
                
                temporary_entry    = [];
                temporary_entry[0] = room_title;
                temporary_entry[1] = Number(subtotal.replace(/[^0-9\.]+/g, "")) / data.night_number;
                temporary_entry[2] = data.night_number;
                temporary_entry[3] = Number(subtotal.replace(/[^0-9\.]+/g, ""));
                
        		remove_error();
        		$('.continue-payment').attr({
        			'type'           : 'button',
        			'data-dismiss'   : 'modal',
        			'data-toggle'    : 'modal',
        			'data-targett'    : '#customer_payment',
        			'data-backdrop'  : 'static',
        			'data-keyboard'  : 'false' 
        		});
        		$('.continue-payment').click();
        		$('.continue-payment').attr({
        			'type'           : 'submit'
        		});
        		$('.continue-payment').removeAttr('data-dismiss');
        		$('.continue-payment').removeAttr('data-toggle');
        		$('.continue-payment').removeAttr('data-targett');
        		$('.continue-payment').removeAttr('data-backdrop');
        		$('.continue-payment').removeAttr('data-keyboard');
        	}
        });
         event.preventDefault();
    });
    
    $('#pay_now').on('submit', function(event) {
        temporary_entry[4] = 'fail';
        $('body').loading();
        $('.modall').css('z-index', '1');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/validation.php',
            data        : $(this).serialize()+"&type=hotel-payment&action=easync_validation",
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                $('body').loading('stop');
                $('.modall').css('z-index', '');
                  remove_error();
                  var genError = "This field is required.";
                    if (data.errors.address_1) {
                        $('.billing-address-info .address_1').append('<div class="error error-address-1 active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .address_1').append('<div class="error error-address-1 ok active"> OK </div>');
                    }
                    if (data.errors.address_2) {
                        $('.billing-address-info .address_2').append('<div class="error error-address-2 active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .address_2').append('<div class="error error-address-2 ok active"> OK </div>');
                    }
                    if (data.errors.province) {
                        $('.billing-address-info .province').append('<div class="error error-province active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .province').append('<div class="error error-province ok active"> OK </div>');
                    }
                    if (data.errors.city) {
                        $('.billing-address-info .city').append('<div class="error error-city active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .city').append('<div class="error error-city ok active"> OK </div>');
                    }
                    if (data.errors.postal_code) {
                        $('.billing-address-info .postal-code').append('<div class="error error-postal active">' + genError + '</div>'); 
                    }else{
                         $('.billing-address-info .postal-code').append('<div class="error error-postal ok active"> OK </div>');
                    }
                //   if (data.errors.address_1) {
                //         $('.billing-address-info .address_1').append('<div class="error error-address-1 active">' + data.errors.address_1 + '</div>'); 
                //     }
                //     if (data.errors.address_2) {
                //         $('.billing-address-info .address_2').append('<div class="error error-address-2 active">' + data.errors.address_2 + '</div>'); 
                //     }
                //     if (data.errors.province) {
                //         $('.billing-address-info .province').append('<div class="error error-province active">' + data.errors.province + '</div>'); 
                //     }
                //     if (data.errors.city) {
                //         $('.billing-address-info .city').append('<div class="error error-city active">' + data.errors.city + '</div>'); 
                //     }
                //     if (data.errors.postal_code) {
                //         $('.billing-address-info .postal-code').append('<div class="error error-postal active">' + data.errors.postal_code + '</div>'); 
                //     }

            }else{

                var temp_path = '.payment-info .billing-address .sync_components .billing-address-info';
                temporary_data[12] = $(temp_path+' input[name="address_1"]').val();
                temporary_data[13] = $(temp_path+' input[name="address_2"]').val();
                temporary_data[14] = $(temp_path+' input[name="city"]').val();
                temporary_data[15] = $(temp_path+' input[name="province"]').val();
                temporary_data[16] = $(temp_path+' input[name="postal_code"]').val();
                temporary_data[17] = $(temp_path+' input[name="easync_payment_nonce"]').val();
                

                var formData = {
                    'type'                  : 'hotel',
                    'room_id'               : temporary_data[0],
                    'arrival_date'          : temporary_data[1],
                    'departure_date'        : temporary_data[2],
                    'night_number'          : temporary_data[3],
                    'guest_number'          : temporary_data[4],
                    'room_number'           : temporary_data[5],
                    'firstname'             : temporary_data[6],
                    'lastname'              : temporary_data[7],
                    'phone'                 : temporary_data[8],
                    'email'                 : temporary_data[9],
                    'facility_request'      : temporary_data[10],
                    'other_req'             : temporary_data[11],
                    'address_1'             : temporary_data[12],
                    'address_2'             : temporary_data[13],
                    'city'                  : temporary_data[14],
                    'province'              : temporary_data[15],
                    'postal_code'           : temporary_data[16],
                    'easync_payment_nonce'  : temporary_data[17],
                    'action'                :'easync_session_store',
                };

                
                
                
                $.ajax({
                    type        : 'POST',
                    url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/session-store.php',
                    data        : formData, 
                    dataType    : 'json', 
                    encode      : true
                }).done(function(data) {
                    $('body').loading('stop');
                    $('.modall').css('z-index', '');
                    if (!data.success) {
                             console.log('Something wrong!');
                    }else{
                        temporary_data  = [];
                        $('.pay-now').attr({
                            'type'           : 'button',
                            'data-dismiss'   : 'modal',
                            'data-toggle'    : 'modal',
                            'data-targett'    : '#hotel_thank_you_modal',
                            'data-backdrop'  : 'static',
                            'data-keyboard'  : 'false' 
                        });
                        //$('.pay-now').click();
                        $('.pay-now').attr({
                            'type'           : 'submit'
                        });
                        $('.pay-now').removeAttr('data-dismiss');
                        $('.pay-now').removeAttr('data-toggle');
                        $('.pay-now').removeAttr('data-targett');
                        $('.pay-now').removeAttr('data-backdrop');
                        $('.pay-now').removeAttr('data-keyboard');

                        //$('#sync_payment_hotel_trig').submit();
                        temporary_entry[4] = 'success';
                    }
                });

            }
        });

    	
         event.preventDefault();
    });
    $('#hotel_thank_you_modal .close').on('click', function(e) {
    	location.reload();
    });

   /* timeslot */
function timeslot(number) {
    $('#sync_timeslot'+number).on('submit', function(event){//diri
        $('body').loading();
        $('.modall').css('z-index', '0');
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type=option_timeslot"+number+"&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                    console.log('Something wrong!');
            }
            $('body').loading('stop');
            $('.modall').css('z-index', '');
            sweetfb();
        });
        event.preventDefault();
    });
}

function switching(id, type) {
    $(document).on('submit', id, function(event){
        $.ajax({
            type        : 'POST',
            url         : easync_admin_ajax_directory.ajaxurl,//sync_plugin_directory.pluginsUrl +'/easync/settings-save.php',
            data        : $(this).serialize()+ "&type="+type+"&action=easync_setting_save", 
            dataType    : 'json', 
            encode      : true
        }).done(function(data) {
            if (!data.success) {
                     console.log('Something wrong!');
            }else{
                location.reload();
            }
        });
        event.preventDefault();
    });
}

function truggerOnSwitch(id, thiss) {
    var pr = $(thiss).parent();
    var temp_val = 'off';
    if(pr.find('.NubWrapper').hasClass('Checked', false) === true) {
        temp_val = 'on';
    }else{
        temp_val = 'off';
    }
   
    $('#sync_switch_toggle .modal-footer form').removeAttr('id');
    $('#sync_switch_toggle .modal-footer form').attr('id', id);
    $('#sync_switch_toggle .modal-footer form input').val(temp_val);
    $('#sync_switch_toggle').modal('show');
    $('#'+id+' button[type="button"]').attr('data-close', thiss.id);
    $('#'+id+' button[type="button"]').attr('data-onoff', temp_val);

}

function toCurrency(amount) {
    amount = amount.toFixed(2);
    amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
    return amount;
}
});

function sweetfb() {
    swal(
      'Done',
      'Success!',
      'success'
    )
}




