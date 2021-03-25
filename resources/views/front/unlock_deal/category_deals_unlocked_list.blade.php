<!DOCTYPE html>
<html lang="en">

<head>
    <title>WhoopMe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/responsive.css') !!}">
     <link rel="stylesheet" href="{!! URL::asset('front_assets/owlcarousel/assets/owl.carousel.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/owlcarousel/assets/owl.theme.default.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/style.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/style_custom.css') !!}">
    <script type="text/javascript">
        API_BASE_URL = "{!! URL::to('/') !!}/api/";
        BASE_URL = "{!! URL::to('/') !!}";
        URL = "{!! URL::to('/') !!}";
      </script>
</head>
<!-- NAVBAR
================================================== -->

<body>
    

    <div class="container unlocked-deal">
        <h1 class="font">Use a deal you've unlocked</h1>
        <p class="head-description">If you have Whoop! Me Happy code you can boost your savings &nbsp;&nbsp;
            <a href="#popup5">
                <i class="fa fa-info-circle"></i>
            </a>
        </p>
        <div class="row dataload">
            
        </div>
    </div>

    <div class="modal" id="boostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>To boost your savings enter your</p>
                    <h2>Whoop! Me Happier Code</h2>
                    <input type="text" class="boost-code form-control">
                    <p>
                        <a href="#" class="code">See your codes</a>
                    </p>
                    <hr>
                    <a href="#" class="use-code">USE CODE</a>
                </div>
            </div>
        </div>
    </div>

    <div id="popup5" class="overlay">
        <div class="popup">
            <a id="close" class="close" href="#">&times;</a>
            <div id="web-deal-detail-info" class="owl-carousel owl-theme">

                <div class="item first">
                    <div class="main_caption first">
                        <div class="caption">
                            <div class="img_bg">
                                <img src="{!! URL::asset('front_assets/images/boost-icon.png') !!}">
                            </div>
                            <div class="btn_popup">
                                <h2 class="font boost" >Boost Icon</h2>
                                <p>You can boost your savings on some deals. Just look out for this icon. Swipe for more info</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="main_caption second">
                        <div class="caption">
                            <div class="img_bg">
                                <img src="{!! URL::asset('front_assets/images/boost-icon.png') !!}">
                            </div>
                            <div class="btn_popup">
                                <h2 class="font boost" >Whoop! Me Happy Code </h2>
                                <p>Tap the icon and enter a Whoop! Me Happier Code if you have one </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="main_caption third">
                        <div class="caption">
                            <div class="img_bg">
                                <img src="{!! URL::asset('front_assets/images/boost-icon.png') !!}">
                            </div>
                            <div class="btn_popup">
                                    <h2 class="font boost" >Boost</h2>
                                    <p>If your code is valid the deal will change to orange to show that you've boosted the deal. Use it by expiry </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
             <div class="content">
                <div class="btn_popup">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="personal-whoops.html">
                                <div class="orange-btn">Start Unlocking</div>
                            </a>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
    </div>


    <script src="{!! URL::asset('front_assets/js/jquery.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/popper.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/owl.carousel.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/bootstrap.min.js') !!}"></script>
     <script src="{!! URL::asset('front_assets/js/jquery.marquee.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/script.js') !!}"></script>
   
    <script src="{!! URL::asset('front_assets/js/jquery.validate.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/custom_validation.js') !!}"></script>

   
    <script>

        var boostedDeal = getParameterByName('first');

        $('[data-target="#boostModal"]').click(function () {
            $('#boostModal').removeClass('code-selected');
            $('#boostModal input').val('');
            $('#boostModal').find('.modal-body p a.code').attr('clicked', $(this).data('value'));

        });

        $('#boostModal').on('shown.bs.modal', function (e) {


        });

        $(document).on('click', '#boostModal .modal-body p a.code', function (e) {

            //if(boostedDeal === null || boostedDeal !== $(this).data('clicked') ){
            window.location.href = 'code-screen.html?first=' + $(this).attr('clicked');
            //}else{
            //   console.log('Yes');
            // }
            // e.preventDefault();
            // return false;
        });

        $(document).on('click', '#boostModal .modal-body .use-code', function (e) {
            e.preventDefault();

            $('#boostModal').modal('hide');
            var done = null;
            if (boostedDeal === 'travel') {
                done = 'deal1';
            } else if (boostedDeal === 'travel-medical') {
                done = 'deal2';
            } else if (boostedDeal === 'car') {
                done = 'deal3';
            }

            var $this = $('.' + done + ' .header .deal-icon');

            setTimeout(function () {
                setTimeout(function () {
                    //  $this.append('<div class="dot-blue" style="top:50%;left:50%;"></div>');

                }, 900);
                setTimeout(function () {
                    if (typeof attr !== typeof undefined && attr !== false) {
                    } else {
                        $this.append('<div class="dot-blue" style="top:50%;left:50%;"></div>');
                    }
                }, 600);
                setTimeout(function () {
                    if (typeof attr !== typeof undefined && attr !== false) {
                    } else {
                        $this.append('<div class="dot-blue" style="top:50%;left:50%;"></div>');
                    }
                }, 300);
                setTimeout(function () {
                    if (typeof attr !== typeof undefined && attr !== false) {
                    } else {
                        $this.append('<div class="dot-blue" style="top:50%;left:50%;"></div>');
                    }

                }, 0);
                setTimeout(function () {
                    $this.find('.dot').remove();
                    $('.' + done).addClass('boosted');
                }, 2000);
            }, 0);

            return false;
        });

        /* Manage boosted deal */

        $(document).ready(function () {

            $("#web-deal-detail-info").owlCarousel({
                navigation: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true,
                items: 1
            });

            if (boostedDeal !== null) {

                $(this).find('.modal-body a').attr('done', boostedDeal);

                $('#boostModal').addClass('code-selected');
                $('#boostModal').modal('show');

                var selectedCode = getParameterByName('code');

                if (selectedCode !== null) {
                    $('#boostModal input').val(selectedCode);
                }

            }
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            
        url = API_BASE_URL+"category/{{$category_id}}/deals_unlocked/list";

        //alert(url);return false;
        $.ajax({
            url: url,
            headers: { 'Authorization': 'Bearer <?php echo Auth::user()->api_token;?>'}
        }).success(function(data){
            var array = $.map(data, function(value, index) {
                return [value];
            });
            length = data.data.total;

            record = data.data;
            //console.log(record.locked_deals[0].name);
            //alert(data.data.locked_deals.length);
            $html = "";

            unlocked_deal_lenght = record.unlocked_deals.length;
            current_user_name = "<?php echo Auth::user()->firstname.' '.Auth::user()->lastname;?>";
            if(unlocked_deal_lenght>0) {
                for (var j = 0; j<unlocked_deal_lenght; j++) {

                    var date1 = new Date("<?php echo date('Y-m-d H:i:s')?>");
                    var date2 = new Date(record.unlocked_deals[j].end_date);
                    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                    //alert(date1+":"+date2);

                    if(date1<=date2) {
                        diffDays = "Expires in "+diffDays+" days";
                    } else {
                        diffDays = "Expired";
                    }
                    $html+="<div class='col-sm-12'>";
                    $html+="<div class='deal deal1'>";
                    $html+="<div class='header '>";
                    $html+="<div class='deal-icon'>";
                    $html+="<img src='"+record.unlocked_deals[j].image+"'>";
                    $html+="</div>";
                    $html+="<i class='boost-icon fa fa-chevron-circle-up' data-value='travel' data-class='deal1' data-toggle='modal' data-target='#boostModal'></i>";
                    $html+="</div>";
                    $html+="<div class='unlocked-by font'>";
                    $html+=" <span>Unlocked by</span>";
                    $html+="<br> "+current_user_name;
                    $html+="</div>";
                    $html+="<div class='title font'>"+record.unlocked_deals[j].name+"</div>";
                    $html+=" <div class='font credit'>"+diffDays+"</div>";
                    $html+="<p class='font info'>"+record.unlocked_deals[j].description+"</p>";
                    $html+="<hr class='dotted-hr'>";
                    $html+="<p class='deal-boosted'>Deal Boosted</p>";
                    $html+="<p class='font get-qoute'>";
                    $html+="<a href='javascript:void(0)'>Get a quotes</a>";
                    $html+="</p>";
                    $html+="</div>";
                    $html+="</div>";
                }
               
            } else {
                 $html = "<div class='col-sm-12'><h1 class='text-center'>No Record Found.</h1></div>";
            }
            $(".dataload").html($html);

        }).error(function(error){

            //alert("No Record Found");
            $(".dataload").html("<h1>No Record Found.</h1>")
        });


        });
    </script>

</body>

</html>