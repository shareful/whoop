<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$title}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/responsive.css') !!}">
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
     <section class="web-deal-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sec1">
                        <h1 class="font home_section">Personal Button</h1>
                        <p class="font"><!-- You have unlocked these deals. If you have a
Whoop! Me Happier boat code you can use it 
to boost your savings  

                            need to--></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="web-deal-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class=" m-border-buttom sec2">
                        <h1 class="font">Personal Button</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="web-deal-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class=" sec2">
                       <h1 class="font mobile text_mobile"><!-- You have unlocked these deals. If you have a
                        Whoop! Me Happier boat code you can use it 
                        to boost your savings  -->
                        </h1> 

                         <h1 class="font mobile text_mobile_unlocked"><u><strong>Your personal button is loaded with these deals </strong></u></h1>
                        <!-- <h1 class="font mobile text_mobile_unlocked"><u><strong>Unlocked deals</strong></u></h1> -->
                        <div class="dataload">
                        
                        </div>
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
        $(document).ready(function(){
            
        url = API_BASE_URL+"category/list/with/deals_locked/count";

      //   $.get(url, {
      //   headers: {
      //       "Authorization": 'Bearer <?php echo Auth::user()->api_token;?>'
      //   }
      // }).success(function(response){
      //   console.log(response)
      // }).error(function(error) {
      //       var array = $.map(error, function(value, index) {
      //           return [value];
      //       });
      //       //console.log(error.responseJSON.status);
      //       //alert(error.status);
      //       if(error.responseJSON.status=="Error") {
      //           //window.location.href = window.location.href;
      //       }
      //   });

    //     $.ajax('url':url,dataType:'json',headers:"{'Authorization': 'Bearer <?php echo Auth::user()->api_token;?>'}",success: function(data) {
    //         alert(data);
    //         },error: function(e) {
    // console.log("ERROR: ", e);
    // display(e);
    // });

        $.ajax({
            url: url,
            headers: { 'Authorization': 'Bearer <?php echo Auth::user()->api_token;?>'}
        }).success(function(data){
            var array = $.map(data, function(value, index) {
                return [value];
            });
            length = data.data.total;

            record = data.data.categories;
            console.log(length);
            $html = "";
            if(length>0) {
                $html = "<div class='category text_mobile_unlocked'>";
                $html += "<div class='row'>";

                for (var i = 0; i<length; i++) {
                    $html +="<div class='col-4 m_t_10 m_b_10 rm-p0 text-center'><div class='pull-right number_sec'><span class='number_font'>"+record[i].locked_deals_count+"</span></div><span><a href='"+URL+"/user/category/"+record[i].id+"/deals_locked/list'><img src='"+record[i].image+"'></a></span><p class='font'>"+record[i].name+"</p></div>";
                }
                $html += "</div></div>";
                
            } else {
                $html = "<h1>No Category Found.</h1>";
            }
            $(".dataload").html($html);

        }).error(function(error){
            var array = $.map(error, function(value, index) {
                return [value];
            });
            if(error.responseJSON.status=="Error") {
                alert(error.responseJSON.message);
                //window.location.href = window.location.href;
            }

        });

        });
    </script>
</body>

</html>