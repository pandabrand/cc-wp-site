/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        window.twttr = (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
          if (d.getElementById(id)) {return t;}
          js = d.createElement(s);
          js.id = id;
          js.src = "https://platform.twitter.com/widgets.js";
          fjs.parentNode.insertBefore(js, fjs);

          t._e = [];
          t.ready = function(f) {
            t._e.push(f);
          };

          return t;
        }(document, "script", "twitter-wjs"));

        window.fbAsyncInit = function() {
          FB.init({
            appId            : '199633970568255',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v2.9'
          });
          FB.AppEvents.logPageView();
        };

        (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));

        // twttr.widgets.load();
        $('.share-fb').click(function() {
          event.preventDefault();
          FB.ui({
           method: 'share',
           display: 'popup',
           href: $(this).attr('href'),
           }, function(response){
             console.dir(response);
           });
        });

        $('.share-tb').click(function() {
          event.preventDefault();
          makepopup($(this));
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
        $('.home__city-guides-block__carousel-block__list').slick({
          infinite: true,
          slidesToShow: 5,
          slidesToScroll: 5,
          responsive: [
            {
              breakpoint: 1025,
              settings: {
                arrows: true,
                dots: false,
                slidesToShow: 4,
                centerMode: true,
              }
            },
            {
              breakpoint: 769,
              settings: {
                arrows: false,
                dots: true,
                slidesToShow: 3,
                centerMode: true,
              }
            },
            {
              breakpoint: 481,
              settings: {
                arrows: false,
                dots: true,
                slidesToShow: 1,
                centerMode: true,
              }
            }
          ]
        });

        $('.related-content__carousel').slick({
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 0,
          dots: false,
          arrows: false,
          responsive: [
            {
              breakpoint: 1025,
              settings: "noslick"
            },
            {
              breakpoint: 769,
              settings: {
                infinite: true,
                arrows: false,
                dots: true,
                slidesToShow: 2,
                slidesToScroll: 2,
              }
            },
            {
              breakpoint: 481,
              settings: {
                infinite: true,
                arrows: false,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
              }
            }
          ]
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
