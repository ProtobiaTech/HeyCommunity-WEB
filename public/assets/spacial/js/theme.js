$(function () {
  navbar.init();

  pricing_charts.init();

  global_notifications.init();

  ecommerce.init();
  
  retina.init();

  zoomerang.init();

  animation.init();
});

var animation = {
  lastScrollY: 0,
  ticking: false,
  _this: null,
  elements: null,

  init: function () {
    _this = this;
    _this.elements = $('[data-animate]');

    window.addEventListener('scroll', _this.onScroll, false);
    _this.update();
  },
  
  onScroll: function () {
    _this.lastScrollY = window.scrollY;
    _this.requestTick();
  },

  requestTick: function () {
    if(!_this.ticking) {
      requestAnimationFrame(_this.update);
      _this.ticking = true;
    }
  },

  update: function () {
    for (var i = _this.elements.length - 1; i >= 0; i--) {
      var $el = $(_this.elements[i])

      if ($el.hasClass($el.data("animate"))) {
        continue;
      }

      if (_this.isInViewport($el)) {
        _this.triggerAnimate($el);
      }
    }

    // allow further rAFs to be called
    _this.ticking = false;
  },

  isInViewport: function ($element) {
    var top_of_element = $element.offset().top;
    var bottom_of_element = $element.offset().top + $element.outerHeight();
    var bottom_of_screen = $(window).scrollTop() + $(window).height();
    var top_of_screen = $(window).scrollTop();

    return ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element));
  },

  triggerAnimate: function ($element) {
    var effect = $element.data("animate");
    var infinite = $element.data("animate-infinite") || null;
    var delay = $element.data("animate-delay") || null;
    var duration = $element.data("animate-duration") || null;
    
    if (infinite !== null) {
      $element.addClass("infinite");
    }

    if (delay !== null) {
      $element.css({
        "-webkit-animation-delay": delay + "s",
        "-moz-animation-delay": delay + "s",
        "animation-delay": delay + "s"
      })
    }

    if (duration !== null) {
      $element.css({
        "-webkit-animation-duration": duration + "s",
        "-moz-animation-duration": duration + "s",
        "animation-duration": duration + "s"
      })
    }

    $element.addClass("animated " + effect)
    .one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
      $element.addClass("animated-end")
    });
  }
};

var navbar = {
  init: function () {
    if (!window.utils.isMobile()) {
      this.dropdownHover()
      this.transparentFixed()
    }

    // prevent dropdown link click to hide dropdown
    $('.navbar-nav .dropdown-item').click(function (e) {
      e.stopPropagation()
    })

    // toggle for dropdown submenus
    $('.dropdown-submenu .dropdown-toggle').click(function (e) {
      e.preventDefault()
      $(this).parent().toggleClass('show')
    })

    this.fixedBottom()
  },

  dropdownHover: function () {
    var $dropdowns = $('.navbar-nav .dropdown')
    $dropdowns.each(function (index, item) {
      var $item = $(this)

      $item.hover(function () {
        $item.addClass('show')
      }, function () {
        $item.removeClass('show')
      })
    })
  },

  transparentFixed: function () {
    var $navbar = $('.navbar')

    if ($navbar.hasClass('bg-transparent fixed-top')) {
      var navbarTop = $navbar.offset().top + 1

      var scrollingFn = function () {
        var offsetTop = window.scrollY || window.pageYOffset

        if (offsetTop >= navbarTop && $navbar.hasClass('bg-transparent')) {
          $navbar.removeClass('bg-transparent')
        } else if (offsetTop < navbarTop && !$navbar.hasClass('bg-transparent')) {
          $navbar.addClass('bg-transparent')
        }
      }
      
      $(window).scroll(scrollingFn)
    }
  },

  fixedBottom: function () {
    $navbar = $('.navbar')

    if ($navbar.hasClass('navbar-fixed-bottom')) {
      var navbarTop = $navbar.offset().top + 1

      var scrollingFn = function () {
        var offsetTop = window.scrollY || window.pageYOffset

        if (offsetTop >= navbarTop && !$navbar.hasClass('navbar-fixed-bottom--stick')) {
          $navbar.addClass('navbar-fixed-bottom--stick')
        } else if (offsetTop < navbarTop && $navbar.hasClass('navbar-fixed-bottom--stick')) {
          $navbar.removeClass('navbar-fixed-bottom--stick')
        }
      }
    }
    
    $(window).scroll(scrollingFn)
  }
};

var zoomerang = {
  init: function () {
    Zoomerang.config({
      maxHeight: 730,
      maxWidth: 900
    }).listen('[data-trigger="zoomerang"]')
  }
};

var ecommerce = {
  init: function () {
    this.displayCart()
    this.search()
  },

  displayCart: function () {
    var $cart = $(".store-navbar .cart"),
        $modal = $("#cart-modal"),
        timeout;

    var showModal = function () {
      $modal.addClass("visible");

      clearTimeout(timeout);
      timeout = null;
    };

    var hideModal = function () {
      timeout = setTimeout(function() {
        $modal.removeClass("visible");
      }, 400);
    };

    $cart.hover(showModal, hideModal);
    $modal.hover(showModal, hideModal);
  },

  search: function () {
    var $searchField = $('.store-navbar .search-field')
    var $searchInput = $searchField.find('.input-search')

    $searchInput.focus(function () {
      $searchField.addClass('focus')
    })

    $searchInput.blur(function () {
      $searchField.removeClass('focus')
    })
  }
};

var global_notifications = {
  init: function () {
    setTimeout(function () {
      $(".global-notification").removeClass("uber-notification").addClass("uber-notification-remove");
    }, 5000);
  }
};

var pricing_charts = {
  init: function () {
    var tabs = $(".pricing-charts-tabs .tab"),
        prices = $(".pricing-charts .chart header .price");

    tabs.click(function () {
      tabs.removeClass("active");
      $(this).addClass("active");

      var period = $(this).data("tab");
      var price_out = prices.filter(":not(."+ period +")");
      price_out.addClass("go-out");
      prices.filter("." + period + "").addClass("active");

      setTimeout(function () {
        price_out.removeClass("go-out").removeClass("active");
      }, 250);
    });
  }
};

var retina = {
  init: function () {
    if(window.devicePixelRatio >= 1.2){
      $("[data-2x]").each(function(){
        if(this.tagName == "IMG"){
          $(this).attr("src",$(this).attr("data-2x"));
        } else {
          $(this).css({"background-image":"url("+$(this).attr("data-2x")+")"});
        }
      });
    }
  }
};

window.utils = {
  isFirefox: function () {
    return navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
  },

  isSafari: function () {
    return navigator.userAgent.toLowerCase().indexOf('safari') > -1;
  },

  // Returns a function, that, as long as it continues to be invoked, will not
  // be triggered. The function will be called after it stops being called for
  // N milliseconds. If `immediate` is passed, trigger the function on the
  // leading edge, instead of the trailing.
  debounce: function (func, wait, immediate) {
    var timeout;
    return function() {
      var context = this, args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  },

  isMobile: function () {
    if (window.innerWidth <= 1024) {
      return true
    } else {
      return false
    }
  },

  parallax_text: function ($selector, extra_top) {
    extra_top = typeof extra_top !== 'undefined' ? extra_top : 0;
    var lastScrollY = 0;
    var ticking = false;

    window.addEventListener('scroll', onScroll, false);

    function onScroll () {
      lastScrollY = window.scrollY;
      requestTick();
    }

    function requestTick () {
      if(!ticking) {
        requestAnimationFrame(update);
        ticking = true;
      }
    }

    function update () {
      var scroll = lastScrollY, 
        slowScroll = scroll/1.4,
        slowBg = (extra_top + slowScroll) + "px",
        opacity,
        transform = "transform" in document.body.style ? "transform" : "-webkit-transform";

      if (scroll > 0) {
        opacity = (1000 - (scroll*2.7)) / 1000;
      } else {
        opacity = 1;
      }

      $selector.css({
        "position": "relative",
        "top": slowBg,
        "opacity": opacity
      });

      ticking = false;
    }
  }
};
