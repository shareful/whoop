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

<body>

    <div class="container web-deal-detail">
        <div class="row">
            <div class="col-sm-12 rm-p0 dataload" >
                
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
                                <img src="{!! URL::asset('front_assets/images/first_page_img.png') !!}">
                            </div>
                            <div class="btn_popup">
                                <p>Every home has 1 insurance deal in each category waiting to be unlocked. Big insurance brands
                                    can't wait to Whoop! You Happy with an exclusive price </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="main_caption second">
                        <div class="caption">
                            <div class="img_bg">
                                <img src="{!! URL::asset('front_assets/images/second_page_img.png') !!}">
                            </div>
                            <div class="btn_popup">
                                <p>To unlock your home's deal just tap the lock.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="main_caption third">
                        <div class="caption">
                            <div class="img_bg">
                                <img src="{!! URL::asset('front_assets/images/third_page_img.png') !!}">
                            </div>
                            <div class="btn_popup">
                                <p>When everyone you live with adds themselves you’ll unlock an extra discount </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="main_caption fourth">
                        <div class="caption">
                            <div class="img_bg">
                                <img src="{!! URL::asset('front_assets/images/fourth_page_img.png') !!}">
                            </div>
                            <div class="btn_popup">
                                <p>Well known insurers can't wait to Whoop! You Happy. To redeem your exclusive deal just tap
                                    your insurance brand’s Whoop! Button to lower the prices on their site</p>
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
    <script src="{!! URL::asset('front_assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/owlcarousel/owl.carousel.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/prefixfree.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/script.js') !!}"></script>
    <script>
            $("#web-deal-detail-info").owlCarousel({
                navigation: true, // Show next and prev buttons
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true,
                items: 1
            });
        </script>

    <script type="text/javascript">
        $(document).ready(function(){
            
        url = API_BASE_URL+"category/{{$category_id}}/deals_locked/list";

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
            $html = '';
            $html += "<div class='header'>";
            $html += "<div class='center-logo'>";
            $html += "<img src='"+record.category.image+"'>";
            $html += "</div>";
                    $html += "<a id='info-icon' class='info-icon' href='#popup5'>";
                        $html += "<i class='fa fa-info-circle'></i>";
                    $html += "</a>";
                $html += "</div>";
                $html += "<div class='sec1'>";
                    $html += "<h1 class='font'>"+record.category.name+"</h1>";
                    $html += "<p class='font'>"+record.category.description+"</p>";
                $html += "</div>";

                $html +="<div class='sec2'>";
                $html +="<div class='category'>";
                $html +="<div class='row'>";
                deal_length = record.locked_deals.length;
                //alert('length:'+deal_length); 
                for (var j = 0; j<deal_length; j++) {
                    // alert(record.locked_deals[0].id);
                    console.log('V:'+data.data.locked_deals[j].name);
                    //$html +="";

                     $html +="<div class='col-12 col-sm-4 text-center'>";
                         $html +="<div class='outer-main'>";
                             $html +="<div class='header'>";
                                 $html +="<span>";
                                     $html +="<img src='"+record.locked_deals[j].image+"' deal_id='"+record.locked_deals[j].id+"' class='unlock_deal'>";
                                 $html +="</span>";
                             $html +="</div>";
                             $html +="<p class='font'>"+record.locked_deals[j].name+"</p>";
                             $html +="<div class='inner-text'>";
                                 $html +="<p class='font credit'>Tap to unlock</p>";
                                 $html +="<p class='description'>"+record.locked_deals[j].description+"</p>";
                             $html +="</div>";
                             $html +="<div class='unlckd'>";
                                 $html +="Locked";
                             $html +="</div>";
                         $html +="</div>";
                     $html +="</div>";
                }
                $html +="</div>";
                $html +="</div>";
                $html +="</div>";
                
            $(".dataload").html($html);

        }).error(function(error){

            //alert("No Record Found");
            $(".dataload").html("<h1>No Record Found.</h1>")
        });


        });

        $(document).on('click','.unlock_deal',function(){
            
            deal_id = $(this).attr('deal_id');
            url = API_BASE_URL+"deal/unlock";
            $.ajax({
            url: url,
            type: "POST",
            headers: { 'Authorization': 'Bearer <?php echo Auth::user()->api_token;?>'},
            data:{deal_id:deal_id}
        }).success(function(data){
            //alert("success");
            }).error(function(error){
                var array = $.map(error, function(value, index) {
                    return [value];
                });
                if(error.responseJSON.status=="Error") {
                    alert(error.responseJSON.message);
                    //window.location.href = window.location.href;
                }
                 //alert("error");
            });

        });
    </script>
</body>

</html>