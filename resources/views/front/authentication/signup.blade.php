<!DOCTYPE html>
<html lang="en">
   <head>
      <title>WhoopMe</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="{!! URL::asset('front_assets/css/bootstrap.min.css') !!}">
      <link rel="stylesheet" href="{!! URL::asset('front_assets/css/font-awesome.min.css') !!}">
      <link rel="stylesheet" href="{!! URL::asset('front_assets/css/responsive.css') !!}">
      <link rel="stylesheet" href="{!! URL::asset('front_assets/css/style.css') !!}">
      <link rel="stylesheet" href="{!! URL::asset('front_assets/css/style_custom.css') !!}">

      <link rel="stylesheet" href="{!! URL::asset('front_assets/css/responsive.css') !!}">
      <link rel="stylesheet" href="{!! URL::asset('front_assets/owlcarousel/assets/owl.carousel.css') !!}">
      <link rel="stylesheet" href="{!! URL::asset('front_assets/owlcarousel/assets/owl.theme.default.min.css') !!}">
      <script type="text/javascript">
          API_BASE_URL = "{!! URL::to('/') !!}/api/";
          BASE_URL = "{!! URL::to('/') !!}";
          URL = "{!! URL::to('/') !!}";
        </script>
   </head>
   <!-- NAVBAR
      ================================================== -->
   <body>
      <div class="clearfix"></div>
      <section id="demos2" class="bg_color unlock-to-join-wapper fixed_section">
         <div class="container">
          <div class="alert alert-danger" id="email_alredy_registered" style="display: none">
            error
          </div>
            <div class="row" id="section1">
              <form name="frmSignupStep1" id="frmSignupStep1" method="post" action="" class="m0 p0 col-md-12">
               <div class="col-sm-12">
                  <div class="getting_ready_icon text-left">
                     <p class="vtitle"> <img src="front_assets/images/face-transparent.png" class="face_img_v"/> Find Your Address </p>
                     <div class="form form_with_icon ">
                        <form class="p0">
                           <div class="form-group col-md-12 p0 input_with_icon">
                              <i class="fa fa-map-marker form_main_icon text_orange p0"></i>
                              <input type="text" class="form-control" placeholder="W1 1AA" name="search" id="search">
                           </div>
                        </form>
                     </div>
                     <p class="text_white">Your Address</p>
                     <p class="text_white" id="your_address_text">
                     </p>
                     <!-- <a href="sign_in_create_account.html" class="btn btn-default white_bg fix_bottom" > Proceed to the final step </a> -->

                     <button class="btn btn-default white_bg fix_bottom" type="submit">
                       Proceed to the final step
                     </button>
                  </div>
               </div>
             </form>
            </div>

             <div class="row" id="section2" style="display: none">
                <div class="col-sm-12">
                    <div class="getting_ready_icon text-left">
                      <p class="vtitle"> <img src="front_assets/images/face-transparent.png" class="face_img_v"/> Create New Account</p>
                       
                         
                         <div class="form form_with_icon ">
                          <form class="p0" name="frmSignupStep2" id="frmSignupStep2">
                            <div class="row m0 justify-content-center align-self-center">
                            <div class="form-group col-11 m0  p0 input_with_icon">
                                <i class="fa fa-map-marker form_main_icon text_orange"></i>
                                <input type="text" class="form-control" value="W1 1AA" readonly="" id="search1">
                            </div>
                            <div class="col-1 text-center p0">
                              <a href="javascript:void(0)" class="  text_white" id="reselecte_address"><i class="fa fa-exchange  swap_icon_address"></i></a>
                            </div>
                            </div>
                            <div class="form-group col-12 m0  p0 input_with_icon">
                                <i class="fa fa-user form_main_icon text_orange"></i>
                                <input type="text" class="form-control" placeholder="First Name" name="firstname">
                            </div>
                            <div class="form-group col-12  m0 p0 input_with_icon">
                                <i class="fa fa-user form_main_icon text_orange"></i>
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                            </div>
                            <div class="form-group col-12 m0  p0 input_with_icon">
                                <i class="fa fa-envelope form_main_icon text_orange"></i>
                                <input type="text" class="form-control" placeholder="Email" name="email">
                            </div>
                            <div class="form-group col-12 m0  p0 input_with_icon">
                                <i class="fa fa-lock form_main_icon text_orange"></i>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            </div>
                            <div class="form-group col-12 m0   p0 input_with_icon">
                                <i class="fa fa-lock form_main_icon text_orange"></i>
                                <input type="password" class="form-control" placeholder="Verify Password" name="password_confirmation">
                            </div>
                            <input type="hidden" name="country" id="step2_country">
                            <input type="hidden" name="city" id="step2_city">
                            <input type="hidden" name="zipcode" id="step2_zipcode">
                            <input type="hidden" name="address" id="step2_address">
                           
                           
                         </div>
             
                         <!--  <a href="sign_in_verify_account.html" class="btn btn-default white_bg fix_bottom" > Create New Account </a> -->

                          <button class="btn btn-default white_bg fix_bottom" type="submit">
                           Create New Account
                         </button>

                         </form>
                    </div>
                </div>
                
            </div>
         </div>
      </section>

      <script src="{!! URL::asset('front_assets/js/jquery.min.js') !!}"></script>
      <script src="{!! URL::asset('front_assets/js/popper.min.js') !!}"></script>
      <script src="{!! URL::asset('front_assets/js/owl.carousel.js') !!}"></script>
      <script src="{!! URL::asset('front_assets/js/bootstrap.min.js') !!}"></script>
      <script src="{!! URL::asset('front_assets/js/script.js') !!}"></script>
      <script src="https://cc-cdn.com/generic/scripts/v1/cc_c2a.min.js"></script>
      <script src="{!! URL::asset('front_assets/js/jquery.marquee.min.js') !!}"></script>
      <script src="{!! URL::asset('front_assets/js/jquery.validate.js') !!}"></script>
      <script src="{!! URL::asset('front_assets/js/custom_validation.js') !!}"></script>
        <script type="text/javascript">
           $(window).on('load',function(){
               $('#myModal').modal('show');
           });
        </script>
      
      <script>
         jQuery(document).ready(function ($) {
         
             $('#products-slider2').owlCarousel({
                 items: 1,
                 animateOut: 'fadeOut',
                 loop: true,
                 margin: 0,
         
             });
        
         });

         new clickToAddress({
            accessToken: 'a5d88-580fa-f7ff0-02703',
            dom: {
              search:   'search',
              town:   'town',
              postcode: 'zipcode',
              county:   'county',
              country:  'country',
              line_1:   'addr_line_1',
              line_2:   'addr_line_2'
            },
            onResultSelected: function(object, dom, result){
              var hidden_elements = document.getElementsByClassName('hidden');
              while(hidden_elements.length > 0){
                hidden_elements[0].className = 'form-control';
              }
              if(result.country.code != 'gbr'){
                province = (result.province_name == '' ? result.province : result.province_name);
              }

              result_data_array = [];

               step2_address  = '';

              if(result.line_1!="") {
                result_data_array.push(result.line_1);
                step2_address+=result.line_1+' ';
              }

              if(result.line_2!="") {
                result_data_array.push(result.line_2);
                step2_address+=result.line_2+' ';
              }

              if(result.locality!="") {
                result_data_array.push(result.locality);
                step2_address+=result.locality+' ';
              }

              if(province!="") {
                result_data_array.push(province);
              }

              if(result.country.country_name!="") {
                result_data_array.push(result.country.country_name);
              }

              if(result.postal_code!="") {
                result_data_array.push(result.postal_code);
              }
              // result_data = result.line_1+','+result.line_2+' '+result.locality+' '+province+' '+result.country.country_name;
              //alert(result_data);

              step2_country  = result.country.country_name;
              step2_city  = result.locality;
              step2_zipcode  = result.postal_code;
             
              $("#step2_country").val(step2_country);
              $("#step2_city").val(step2_city);
              $("#step2_zipcode").val(step2_zipcode);
              $("#step2_address").val(step2_address);
              result_data = result_data_array.join(" ");
              //alert(result_data);
              $("#your_address_text").html(result_data);
              search = $("#search").val(); 
              $("#search1").val(search);

            },
            onError: function(code, message){
              
              if(code == "8003"){
                // $('#form-example').html('You reached your daily demo limit of 500.<br/>Please get in touch if you want to do some further testing.');

                alert("Some error occur. please enter your address manually..");
              } else {
                alert("Some error occur. please enter your address manually.");
              }
            },
            onSearchFocus: function(c2a, elements){
              console.log('foc');
            },
            gfxMode: 1,
          });
      </script>
   </body>
</html>