
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>App sfasfas</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
        <link href="{!! URL::asset('front_assets/css/bootstrap.css') !!}" rel="stylesheet">
        <link rel="stylesheet" href="{!! URL::asset('front_assets/css/responsive.css') !!}">
        <link rel="stylesheet" href="{!! URL::asset('front_assets/owlcarousel/assets/owl.carousel.css') !!}">
        <link rel="stylesheet" href="{!! URL::asset('front_assets/owlcarousel/assets/owl.theme.default.min.css') !!}">
        <link href="{!! URL::asset('front_assets/css/style.css') !!}" rel="stylesheet">
        <link href="{!! URL::asset('front_assets/css/web-style.css') !!}" rel="stylesheet">
        <link rel="stylesheet" href="{!! URL::asset('front_assets/css/style_custom.css') !!}">
    </head>
    <!-- NAVBAR
        ================================================== -->
    <body>
        <div class="clearfix"></div>
         <div id="mySidenav" class="sidenav">
         <ul class="sideul">
            <li class="navheader">
                <a href="#"><img src="{!! URL::asset('front_assets/images/m-icon1.png') !!}" class="img-menu"> Setting 
                 <span class="closenav" onclick="closeNav()">&times;</span>
            </a>
            </li>
            <li class="sideli">
                <a href="#" class="toggle-custom" data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><img src="{!! URL::asset('front_assets/images/m-icon2.png') !!}" class="img-menu"> Manage your button
                    <span class="fa fa-chevron-down menu-arrow"></span></a>
                <ul class="collapse submenu" id="submenu1" role="menu" aria-labelledby="btn-1">
                    <li><a href="home.html"><img src="{!! URL::asset('front_assets/images/m-icon3.png') !!}"> Your home's button</a></li>
                    <li><a href="personal.html"><img src="{!! URL::asset('front_assets/images/m-icon4.png') !!}"> Your Personal button</a></li>
                </ul>
            </li>
            <li class="sideli">
                <a href="deal_locked.html" ><img src="{!! URL::asset('front_assets/images/m-icon5.png') !!}" class="img-menu"> Deals to unlock</a>
            </li>
             <li class="sideli">
                <a href="deal_unlocked.html"><img src="{!! URL::asset('front_assets/images/m-icon6.png') !!}" class="img-menu"> Unlocked deals</a>
            </li>
            <li class="sideli">
                    <a href="add-deal.html"><img src="{!! URL::asset('front_assets/images/boost-icon.png') !!}" class="img-menu">Super Whoop! Deal</a>
                </li>
             <li class="sideli">
                <a href="#"><img src="{!! URL::asset('front_assets/images/m-icon7.png') !!}" class="img-menu"> Whoop! Me happy Codes</a>
            </li>
             <li class="sideli">
                <a href="search_results.html"><img src="{!! URL::asset('front_assets/images/m-icon9.png') !!}" class="img-menu"> Search for someone's Whoop! Button </a>
            </li>
            <li class="sideli">
                <a href="profile_detail.html"><img src="{!! URL::asset('front_assets/images/m-icon8.png') !!}" class="img-menu"> Profile</a>
            </li>
        </ul>
         </div>
            <header class="container-fluid" style=" padding:10px 0px;   background: #f8f8f8;">
        <div class="container">
            <div class="col-xs-6">
                <div class="m-logo m0 p0">
                    <img src="{!! URL::asset('front_assets/images/msg-logo.jpg') !!}">
                </div> 
            </div>
            <div class="col-xs-6">
                <div class="m-menu p_t_30"><a href="message-list.html"><span class="notifcation-cirle">2</span><img src="{!! URL::asset('front_assets/images/menu-icon-envelope.png') !!}" style="height: 25px;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="openNav()"><img src="{!! URL::asset('front_assets/images/menu-icon.jpg') !!}"></a></div>
            </div>
        </div>
    </header>
        <div class="container-fluid">
            <div class="row">
                <div id="main_carousel_home" class="owl-carousel owl-theme">
                    
                    <!--Section One-->
                    <div class="item first">
                        
                        <section id="demos2" class="bg_color bg_pwhoops">
                            
                            <div class="container">
                                <div class="row">
                                    <div class="large-12 columns m_t_30">
                                        <div class="getting_ready_icon ">
                                            <a href="deal_locked.html"><img src="{!! URL::asset('front_assets/images/personal-whoops.png') !!}"></a>
                                            <ul class="circle_wave home_circle_wave clearfix">
                                               <li>
                                                    <a href="{!! URL::to('user/category/list/with/deals_locked/count') !!}">
                                                        <span> Deal Left </span>
                                                            <span>
                                                            <strong class="small_txt">( to unlock )</strong>
                                                        </span>
                                                        <span class="circle"> 3 </span>
                                                    </a>    
                                                </li>
                                                <li>
                                                    <a href="{!! URL::to('user/category/list/with/deals_unlocked/count') !!}">
                                                        <span> Unlocked</span><span>deals</span>
                                                        <span class="circle">0</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <span>Boost</span><span>Codes</span>
                                                    <span class="circle">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="demos2" class="error_2">
                            <div class="container">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <div class="message-wapper text_orange no_underline">
                                            <!-- <span class="icon"><img src="images/error-1-icon.png"></span> -->
                                            <p class="m0 p10">Your personal button</p>
                                            <p class="m0 p10">You can use your personal button straight away or you can swipe to see your home's button and verify your address
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="demos2" class="verify_address">
                            <div class="container">
                                <div class="row" id="cuts">
                                    <div class="col-md-8 col-xs-8 m_b_10 col-xs-offset-2 text-left">
                                        <ul class="check_lists">
                                            <li>Immediate start </li>
                                            <li>Loaded with 5 deals</li>
                                            <li>Unlock your home's button inside 30 days</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="unlock-icon-bg">
                                            <div class="unlock-icon">
                                                <!--<a href="#">--><img src="{!! URL::asset('front_assets/images/unlock-icon_gray2.png') !!}" alt="" title=""><!--</a>-->
                                            </div>
                                            <div class="unlock-title">Verify
                                                <br>
                                                <span>Verify Address to Unlock Your Button</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="unlock-icon-bg">
                                            <!--  invite -->
                                            <a href="invite.html">
                                                <div class="unlock-icon">
                                                    <span class="count_down_outer"><span class="count_down">30</span> </span>
                                                </div>
                                                <div class="unlock-title">
                                                    <div class="hightlighter_remove">Days Left</div>
                                                    <span>Of Your Trial</span>
                                                </div>
                                            </a>
                                            <div class="invite_popup hidden invite_popup_home_button">
                                                <button class="close"> x </button>
                                                <p>You can now invite the people you live with so they can save too. When everyone you live with joins the button you'll unlock a reward. </p>
                                                <div class="arrow-down arrow-down-home-button"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!--Section Two-->
                    <div class="item">
                        <section id="demos2" class="bg_color bg_pwhoops">
                            <div class="container">
                                <div class="row">
                                    <div class="large-12 columns m_t_30">
                                        <div class="getting_ready_icon ">
                                            <a href="deal_locked.html"><img src="{!! URL::asset('front_assets/images/home-whoops-btn.png') !!}"></a>
                                            <ul class="circle_wave home_circle_wave clearfix">
                                               <li>
                                                    <a href="{!! URL::to('user/category/list/with/deals_locked/count') !!}">
                                                        <span> Deal Left </span>
                                                            <span>
                                                            <strong class="small_txt">( to unlock )</strong>
                                                        </span>
                                                        <span class="circle">3 </span>
                                                    </a>    
                                                </li>
                                                <li>
                                                    <a href="{!! URL::to('user/category/list/with/deals_unlocked/count') !!}">
                                                        <span> Unlocked</span><span>deals</span>
                                                        <span class="circle">0</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <span>Boost</span><span>Codes</span>
                                                    <span class="circle">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="demos2" class="error_1">
                            <div class="container">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <div class="message-wapper">
                                            <a href="home-whoop.html">
                                                <p class="m0 p10">Your home's button</p>
                                                <p class="m0 p10">Verify address to unlock your button<br/>16, Westway, London, SW1 1AW</p>
                                                
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="demos2" class="verify_address">
                            <div class="container">
                                
                                <div class="row" id="cuts">
                                    <div class="col-md-6">
                                        <div class="unlock-icon-bg">
                                            <div class="unlock-icon">
                                                <a href="unlock-to-join.html"><img src="{!! URL::asset('front_assets/images/unlock_orange.png') !!}" alt="" title=""></a>
                                            </div>
                                            <div class="unlock-title">Verify
                                                <br>
                                                <span>Verify Address to Unlock Your Button</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="unlock-icon-bg">
                                            <!--  invite -->
                                            <a href="invite.html">
                                                <div class="unlock-icon">
                                                    <img src="{!! URL::asset('front_assets/images/invite-g.png') !!}" alt="" title="" style="min-width: 43px;">
                                                </div>
                                                <div class="unlock-title">
                                                    <div class="hightlighter_remove">invite</div>
                                                    <span>Invite the people you live with </span>
                                                </div>
                                            </a>
                                            <div class="invite_popup hidden invite_popup_home_button">
                                                <button class="close"> x </button>
                                                <p>You can now invite the people you live with so they can save too. When everyone you live with
                                                    joins the button you'll unlock a reward. 
                                                </p>
                                                <div class="arrow-down arrow-down-home-button"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        
                    </div>
                </div>
            </div>
        </div>
         <div id="popup5" class="overlay invite-popup">
            <div class="popup">
                <a id="close" class="close" href="#">&times;</a>
                <div id="web-deal-detail-info" class="owl-carousel owl-theme">

                    <div class="item first">
                        <div class="main_caption first">
                            <div class="caption">
                                <div class="btn_popup" style="position: unset;">
                                    <p>Welcome</p>
                                </div>
                                <div class="img_bg">
                                    <img src="{!! URL::asset('front_assets/images/box_icon.png') !!}">
                                </div>
                                <div class="btn_popup" style="position: unset;">
                                    <p>Verify your home's button</p>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="btn_popup" style="position: unset;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="font">You're about to see your home's Whoop!
                                        Button for the first time. You'll need to verify your 
                                        address to unlock or join your home's
                                         Whoop! Button</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="main_caption second">
                            <div class="caption">
                                <div class="btn_popup" style="position: unset;">
                                    <p>How to access your...</p>
                                </div>
                                <div class="img_bg">
                                    <img src="{!! URL::asset('front_assets/images/green-monry.png') !!}">
                                </div>
                                <div class="btn_popup" style="position: unset;">
                                    <p>Your home's exclusive deals</p>
                                </div>                            
                            </div>
                        </div>
                        <div class="content">
                            <div class="btn_popup" style="position: unset;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="font">Once you've verified your address you'll be able to unlock all of your home's deals and invite the people you live with. It's easy to verify but we've added 3 deals to your button so you can start straight away,</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 


                </div>
            </div>
         </div>
         <div class="overlay"></div>
    <script src="{!! URL::asset('front_assets/js/jquery.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/popper.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/owlcarousel/owl.carousel.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/script.js') !!}"></script>
        <style type="text/css">
            #popup5.invite-popup .owl-theme .owl-nav.disabled+.owl-dots {
            margin-top: 10px;
            position: absolute;
            border: 0;
            top: 282px;
            width: 100%;
            }
            #popup5.invite-popup .item .main_caption {
                background: #FFF;
                background: linear-gradient(to bottom, #fe9846 0%, #ff6013 100%);
            }
            #popup5.invite-popup .item .content {
                background: linear-gradient(to bottom, #fe9846 0%, #ff6013 100%);
                background: unset;
            }
            #popup5.invite-popup .content p{color: #000;}
            .invite-popup .btn_popup p{color: #fff;}
        </style>

        <script>
             function createCookie(name, value, days) {
                 var expires = "";
                 if (days) {
                     var date = new Date();
                     date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                     expires = "; expires=" + date.toUTCString();
                 }
                 document.cookie = name + "=" + value + expires + "; path=/";
             }

             function readCookie(name) {
                 var nameEQ = name + "=";
                 var ca = document.cookie.split(';');
                 for (var i = 0; i < ca.length; i++) {
                     var c = ca[i];
                     while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                     if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                 }
                 return null;
             }




             var country = getParameterByName('country');



             if (country === 'aus') {
                 $('.verify_address .postcard-text').html('NSW 2000');
             }


             jQuery(document).ready(function($) {
                 $("#web-deal-detail-info").owlCarousel({
                     navigation: true, // Show next and prev buttons
                     slideSpeed: 300,
                     paginationSpeed: 400,
                     singleItem: true,
                     items: 1
                 });

                 $(".invite_popup .close").click(function() {
                     $(".unlock-icon, .hightlighter_remove").removeClass("hightlighter");

                     $(".invite_popup").hide();
                     $(".overlay").hide();
                 });

                 var cookiesv = readCookie('first_visit');
                 //console.log(cookiesv);
                 if (cookiesv == "" || cookiesv == null) {
                     createCookie('first_visit', "Welcome", '1');
                     $("div#popup5").addClass("openpopup");
                     //console.log('first');

                 } else {
                     //console.log(cookiesv);
                     return false;
                 }
                 $("div#popup5").addClass("openpopup");
            });

             $(document).on('click', '#popup5.invite-popup .close', function() {

                 $("div#popup5").removeClass("openpopup");

                
             });
             $("#main_carousel_home").owlCarousel({
                 navigation: true, // Show next and prev buttons
                 slideSpeed: 300,
                 paginationSpeed: 400,
                 singleItem: true,
                 items: 1
             });
             
        </script>
         <script type="text/javascript">
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
            if ($(window).width() > 767){
                document.getElementById("main").style.marginRight = "250px";
            }
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            if ($(window).width() > 767){
                document.getElementById("main").style.marginRight= "0";
            }
        }
        function gotounlock(){
            $('#tab_unlock').trigger('click');
        }
        function gotowmh(){
            $('#tab_wmh').trigger('click');
        }
        </script>
        <script>
        jQuery(document).ready(function($) {
            $('.toggle-custom').on('click', function (e) {
                if($(this).attr('aria-expanded') == "true"){
                    $(this).parent().removeClass('active');
                }else{
                    $(this).parent().addClass('active');
                }
                console.log($(this).attr('aria-expanded'));
            });
        });
        </script>
    </body>
</html>