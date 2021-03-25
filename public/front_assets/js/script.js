function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
  }


$(document).on('click', '.btn-unlock-action', function () {

      var icon = $(this).find('img');

      if (icon.attr('src') === 'images/lock-box.png') {

            icon.attr('src', 'images/unlock-box.png');
            $(this).after($('#unlock-msg').html());

      }

});



$(document).ready(function () {

            $("#owl-demo_2").owlCarousel({
                  navigation: true, // Show next and prev buttons
                  slideSpeed: 300,
                  paginationSpeed: 400,
                  singleItem: true
            });
});

$(document).on('click', '.custom-m-arrow .fa-plus-square-o', function () {

      var root = $(this).parent().parent();

      if (root.hasClass('self')) {

            $(this).removeClass('fa-plus-square-o').addClass('fa-check-circle');

            root.find('.profile-message').html('Added');

            root.removeClass('self').addClass('self-added');
            root.find('.profile-message-section').html('You added Yourself<br><span class="profile-message"></span>');
      }

      if ($('.user-part .m-border-blue-top-bottom .self').length === $('.user-part .m-border-blue-top-bottom .self .fa-check-circle').length) {
            $('.enable-extra-saving').removeClass('label-default').addClass('label-orange');
      } else {
            $('.enable-extra-saving').removeClass('label-orange').addClass('label-default');
      }

});

var activeIndex = 1;

setInterval(function () {

      $('.sec-2-animation span > span').hide();
      i = activeIndex;
      for (i; i > 0; i--) {
            $('.sec-2-animation span > span:nth-child(' + i + ')').show();
      }
      activeIndex++;

      if (activeIndex > $('.sec-2-animation span').length) {
            activeIndex = 1;
      }

}, 1000);

/*
$(document).on('click', '.web-deal-detail .sec2 .category span img', function () {
     
}); */

$(document).on('click', '.web-deal-detail .sec2 .category span img', function () {

      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {
                        //$this.append('<div class="dot" style="top:50%;left:50%;"></div>');

                  }, 900);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                              $this.parent().find('small').fadeIn(250);
                              $this.css('background', '#ccc');
                              $this.parent().css('background', '#999999');
                              $this.parent().parent().find('.unlckd').html('<i class="fa fa-check-square-o"></i> Unlocked');
                        }
                  }, 600);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }
                  }, 300);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }

                  }, 0);
                  setTimeout(function () {
                        $this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }

});

$(document).on('click', '.insurance-detail .sec2 .category span img', function () {

      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {

                  }, 900);
                  setTimeout(function () {
                        $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        $this.parent().find('small').fadeIn(250);
                  }, 600);
                  setTimeout(function () {
                        $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                  }, 300);
                  setTimeout(function () {
                        $this.append('<div class="dot" style="top:50%;left:50%;"></div>');

                  }, 0);
                  setTimeout(function () {
                        $this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }

});

$(document).on('click', '.city-whoop .sec2 .category span img.tap', function () {

      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {
                  }, 900);
                  setTimeout(function () {
                        $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        $this.find('.city-whoop-img').attr('src','images/whoop-btn-b.png');
                        $('#Modal_info').modal('show');
                  }, 600);
                  setTimeout(function () {
                        $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                  }, 300);
                  setTimeout(function () {
                        $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                  }, 0);
                  setTimeout(function () {
                        $this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }

});

$(document).on('click', '.moving-home-detail .sec2 .category span img', function () {
      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {
                        //$this.append('<div class="dot" style="top:50%;left:50%;"></div>');

                  }, 900);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                              $this.parent().find('small').fadeIn(250);
                              $this.css('background', '#ccc');
                              $this.parent().css('background', '#999999');
                              $this.parent().parent().find('.unlckd').html('<i class="fa fa-check-square-o"></i> Unlocked');
                        }
                  }, 600);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }
                  }, 300);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }

                  }, 0);
                  setTimeout(function () {
                        $this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }
});

$(document).on('click', '.tradeperson-detail .sec2 .category span img', function () {
      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {
                        //$this.append('<div class="dot" style="top:50%;left:50%;"></div>');

                  }, 900);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                              $this.parent().find('small').fadeIn(250);
                              $this.css('background', '#ccc');
                              $this.parent().css('background', '#999999');
                              $this.parent().parent().find('.unlckd').html('<i class="fa fa-check-square-o"></i> Unlocked');
                        }
                  }, 600);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }
                  }, 300);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }

                  }, 0);
                  setTimeout(function () {
                        $this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }
});

$(document).on('click', '.tradespeople-deal .sec2 .category span img', function () {

      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {

                  }, 900);
                  setTimeout(function () {
                        $this.append('<div class="dot1" style=""></div>');
                        $this.parent().find('small').fadeIn(250);
                  }, 600);
                  setTimeout(function () {
                        $this.append('<div class="dot1" style=""></div>');
                  }, 300);
                  setTimeout(function () {
                        $this.append('<div class="dot1" style=""></div>');

                  }, 0);
                  setTimeout(function () {
                        $this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }
});

$(document).on('click', '.moving-home-deal .sec2 .category span img', function () {

      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {

                  }, 900);
                  setTimeout(function () {
                        $this.append('<div class="dot1" style=""></div>');
                        $this.parent().find('small').fadeIn(250);
                  }, 600);
                  setTimeout(function () {
                        $this.append('<div class="dot1" style=""></div>');
                  }, 300);
                  setTimeout(function () {
                        $this.append('<div class="dot1" style=""></div>');

                  }, 0);
                  setTimeout(function () {
                        //$this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }
});

$(document).on('click', '.vehicle-detail .sec2 .category span img', function () {
      var attr = $(this).attr('data-r');

      var $this = $(this).parent();

      if (!$this.hasClass('one-time-done')) {

            $this.addClass('one-time-done');

            setTimeout(function () {
                  setTimeout(function () {
                        //$this.append('<div class="dot" style="top:50%;left:50%;"></div>');

                  }, 900);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                              $this.parent().find('small').fadeIn(250);
                              $this.css('background', '#ccc');
                              $this.parent().css('background', '#999999');
                              $this.parent().parent().find('.unlckd').html('<i class="fa fa-check-square-o"></i> Unlocked');
                        }
                  }, 600);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }
                  }, 300);
                  setTimeout(function () {
                        if (typeof attr !== typeof undefined && attr !== false) {
                        } else {
                              $this.append('<div class="dot" style="top:50%;left:50%;"></div>');
                        }

                  }, 0);
                  setTimeout(function () {
                        $this.find('.dot').remove();
                  }, 2500);
            }, 0);
      }
});