<!DOCTYPE html>
<html lang="en">
   <head>
      <title>{{$title}}</title>
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
            <div class="row">
               <div class="col-sm-12">
                  <div class="col-sm-12 getting_ready_icon text-left">
                     <p class="vtitle"> <img src="front_assets/images/face-transparent.png" class="face_img_v"/> We've Sent you an Email </p>
                     <p class="vdescription">Click the link in the email to verify your email and log in.
                     </p>
                     <a href="sign_in" class="btn btn-default white_bg fix_bottom"  > OK </a>
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
      </script>
   </body>
</html>