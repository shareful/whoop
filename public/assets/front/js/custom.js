(function($) {
  // Site title
  // wp.customize('blognameOne', function(value) {
  //   value.bind(function(to) {
  //     $('.brand').text(to);
  //   });
  // });


})(jQuery);

// Dropdown
function DropDown(el) {
  this.dd = el;
  this.placeholder = this.dd.children('span');
  this.opts = this.dd.find('ul.dropdown > li.item');
  this.val = '';
  this.index = -1;
  this.initEvents();
}


$(document).ready(function(){

  $("#hamburger").click(function(){
    if ($(".nav-mobile ul").hasClass("expanded")) {
      $(".nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
      $(this).removeClass("close");
    } else {
      $(".nav-mobile ul").addClass("expanded").slideDown(250);
      $(this).addClass("close");
    }
  });
});

function loadMoreData(page){
      $.ajax({
        url: '?page=' + page,
        type: "GET",
        beforeSend: function() {
          $('.ajax-load').show();
        }
      }).done(function(data) {
        if(data.html==""){
          $(".nomoreposts").show()
          $(".loadmoreposts").hide();
          return;
        }
        $('.ajax-load').hide();

        if ($(".recent")[0]){
          $(".recent").hide();
          $(".recent").append(data.html);
          $(".recent").fadeIn();
        } else {
          $(".related").hide();
          $(".related").append(data.html);
          $(".related").fadeIn();
        }

      });
}

$(document).ready(function(){


  var page = 1;
  $(".loadmoreposts").click(function() {
      page++;
      loadMoreData(page);
  });


  

  $(".home-read").click(function () {
    $("body, html").animate({
      scrollTop: $( $(".features") ).offset().top + 100
    }, 600);
  });

  //Step1 Validations
  $("#frmSolarProcess").validate({
    rules: {
      address: "required",
      billamount: "required number"
    },
    invalidHandler: function(form, validator) {
      var errors = validator.numberOfInvalids();
      if (errors) {
        validator.errorList[0].element.focus();
      }
    },
    highlight: function (element) {
      $(element).parent().addClass('error')
    },
    unhighlight: function (element) {
      $(element).parent().removeClass('error')
    },
    errorPlacement: function(error,element) {
      return true;
    }
  });

  $('#hamburger').click(function(){
    $(this).toggleClass('open');
  });
});
$('input,textarea').focus(function(){
  $(this).data('placeholder',$(this).attr('placeholder'))
      .attr('placeholder','');
}).blur(function(){
  $(this).attr('placeholder',$(this).data('placeholder'));
});

// Slider range
var rangeSlider = function(){
  var slider = $('.range-slider'),
      range = $('.range-slider__range'),
      value = $('.range-slider__value');

  slider.each(function(){

    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });

    range.on('input', function(){
      $(this).next(value).html(this.value);
    });
  });
};
rangeSlider();


//-+ bill amount - step2
$(".desktop .fa-plus").click(function () {
  var slider = $('.desktop .range-slider'),
      range = $('.desktop .range-slider__range'),
      value = $('.desktop .range-slider__value');
      var newval = parseInt($('.desktop .range-slider__value').html());
      var maxval = parseInt($(".desktop .range-slider__range").attr('max'));

      if(newval<maxval){
        value = newval+1;
      } else {
        value = maxval;
      }
      $(".range-slider__value").html(value);
});

$(".desktop .fa-minus").click(function () {
  var slider = $('.desktop .range-slider'),
      range = $('.desktop .range-slider__range'),
      value = $('.desktop .range-slider__value');
  var newval = parseInt($('.desktop .range-slider__value').html());
  var rangeval = parseInt($('.desktop .range-slider__range').val());
  if(newval>0){
    value = newval-1;
  } else {
    value=0;
  }
  $(".range-slider__value").html(value);
});
//-+ bill amount - step2

DropDown.prototype = {
  initEvents : function() {
    var obj = this;

    obj.dd.on('click', function(event){
      $(this).toggleClass('active');
      return false;
    });
    obj.opts.on('click',function(){
      var opt = $(this);
      obj.val = opt.text();
      obj.index = opt.index();
      obj.placeholder.text(obj.val);
    });
  },
  getValue : function() {
    return this.val;
  },
  getIndex : function() {
    return this.index;
  }
}


// Get 'answer' values
$(".selection").click(function(){
  var answer1 = $(this).attr('data-value');
  $("#select1").val(answer1);
  $("#select2").val(answer2);
  $("#select3").val(answer3);
  $("#select4").val(answer4);
});

// Accordion - Service Providers
$(document).ready(function (){

  var dd = new DropDown( $('.dropdown #dd') );
  $(document).click(function() {
    // all dropdowns
    $('.wrapper-dropdown').removeClass('active');
  });

  $('.profile').on('click', function(event){
    event.preventDefault();
    // create variables
    var accordion = $(this);
    var viewContent = accordion.next('.view-content');
    // toggle accordion link open class
    accordion.toggleClass("open");
    // toggle accordion content
    viewContent.slideToggle(250);
    // $('.btn-view').toggleClass("btn-close");
    $(this).find('.btn-view').toggleClass('btn-close');
    // $(this).toggleClass('profile-bg');
  });
});
// Accordion - Mobile functionality
$('input:checkbox').change(function(){
  if($(this).is(":checked")) {
    $(this).parent().siblings(".profile").addClass("profile-bg");
  } else {
    $(this).parent().siblings(".profile").removeClass("profile-bg");
  }
});

var autocomplete;
function TxtOverlay(pos, txt, cls, map) {

  // Now initialize all properties.
  this.pos = pos;
  this.txt_ = txt;
  this.cls_ = cls;
  this.map_ = map;

  // We define a property to hold the image's
  // div. We'll actually create this div
  // upon receipt of the add() method so we'll
  // leave it null for now.
  this.div_ = null;

  // Explicitly call setMap() on this overlay
  this.setMap(map);
}

TxtOverlay.prototype = new google.maps.OverlayView();



TxtOverlay.prototype.onAdd = function() {

  // Note: an overlay's receipt of onAdd() indicates that
  // the map's panes are now available for attaching
  // the overlay to the map via the DOM.

  // Create the DIV and set some basic attributes.
  var div = document.createElement('DIV');
  div.className = this.cls_;

  div.innerHTML = this.txt_;

  // Set the overlay's div_ property to this DIV
  this.div_ = div;
  var overlayProjection = this.getProjection();
  var position = overlayProjection.fromLatLngToDivPixel(this.pos);
  div.style.left = position.x + 'px';
  div.style.top = position.y + 'px';
  // We add an overlay to a map via one of the map's panes.

  var panes = this.getPanes();
  panes.floatPane.appendChild(div);
}
TxtOverlay.prototype.draw = function() {


  var overlayProjection = this.getProjection();

  // Retrieve the southwest and northeast coordinates of this overlay
  // in latlngs and convert them to pixels coordinates.
  // We'll use these coordinates to resize the DIV.
  var position = overlayProjection.fromLatLngToDivPixel(this.pos);


  var div = this.div_;
  div.style.left = position.x + 'px';
  div.style.top = position.y + 'px';



}
//Optional: helper methods for removing and toggling the text overlay.
TxtOverlay.prototype.onRemove = function() {
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
}
TxtOverlay.prototype.hide = function() {
  if (this.div_) {
    this.div_.style.visibility = "hidden";
  }
}

TxtOverlay.prototype.show = function() {
  if (this.div_) {
    this.div_.style.visibility = "visible";
  }
}

TxtOverlay.prototype.toggle = function() {
  if (this.div_) {
    if (this.div_.style.visibility == "hidden") {
      this.show();
    } else {
      this.hide();
    }
  }
}

TxtOverlay.prototype.toggleDOM = function() {
  if (this.getMap()) {
    this.setMap(null);
  } else {
    this.setMap(this.map_);
  }
}

var map;
function init() {

  //For autocomplete address on Step1
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('homegoogleaddress')),
      {types: ['geocode']});


  //For Map on Step2
  var iconBase = base_url+'/assets/front/images/icon-marker.png';
  var geocoder = new google.maps.Geocoder();
  var address = document.getElementById("hdnAddress").value;
  geocoder.geocode({ 'address': address }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var latitude = results[0].geometry.location.lat();
      var longitude = results[0].geometry.location.lng();

      var latlng = new google.maps.LatLng(latitude, longitude);

      var myOptions = {
        zoom: 18,
        center: latlng,
        mapTypeId: 'satellite',
        disableDefaultUI: true
      };

      map = new google.maps.Map(document.getElementById("map"), myOptions);

      var marker = new google.maps.Marker({
        position: {lat: latitude, lng: longitude},
        map: map,
        icon: iconBase
      });

      // var latlng = new google.maps.LatLng(-24.397, 140.644);
      // marker.setPosition(latlng);

      customTxt = "<div><div class='coordinates'>"+latitude+' '+longitude+"</div>"+address+"</div>";
      txt = new TxtOverlay(latlng, customTxt, "customBox", map)
    }

  });

}