// preload ------------------
jQuery(window).load(function() {
    "use strict";
    jQuery(".loader").fadeOut(500, function() {
        jQuery("#main").animate({
            opacity: "1"
        }, 500);
        contanimshow();
    });
});

jQuery("body").append('<div class="l-line"><span></span></div>');
// all functions ------------------
function initDogma() {
    "use strict";
    if (jQuery(".content").hasClass("home-content")) {
		jQuery("header").animate({
            top: "-62px"
        }, 500);
		jQuery("header , footer").animate({
            bottom: "-50px"
        }, 500);
	}
	else
	{
		jQuery("header").animate({
            top: "0"
        }, 500);
		jQuery("header , footer").animate({
            bottom: "0"
        }, 500);
	}
// magnificPopup ------------------
    jQuery(".image-popup").magnificPopup({
        type: "image",
        closeOnContentClick: false,
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom",
        image: {
            verticalFit: false
        }
    });
    jQuery(".popup-youtube, .popup-vimeo , .show-map").magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 600,
        mainClass: "my-mfp-slide-bottom"
    });
    jQuery(".popup-gallery").magnificPopup({
        delegate: "a",
        type: "image",
        fixedContentPos: true,
        fixedBgPos: true,
        tLoading: "Loading image #%curr%...",
        removalDelay: 600,
        closeBtnInside: true,
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [ 0, 1 ]
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });
// bg video ------------------
    var l = jQuery(".background-video").data("vid");
    var m = jQuery(".background-video").data("mv");
    jQuery(".background-video").YTPlayer({
        fitToBackground: true,
        videoId: l,
        pauseOnScroll: true,
        mute: m,
        callback: function() {
            var a = jQuery(".background-video").data("ytPlayer").player;
        }
    });
// Isotope  ------------------
    jQuery(".hide-column").bind("click", function() {
        jQuery(".not-vis-column").animate({
            right: "-100%"
        }, 500);
    });
    jQuery(".show-info").bind("click", function() {
        jQuery(".not-vis-column").animate({
            right: "0"
        }, 500);
    });
    function n() {
        if (jQuery(".gallery-items").length) {
            var a = jQuery(".gallery-items").isotope({
                singleMode: true,
                columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                transformsEnabled: true,
                transitionDuration: "700ms"
            });
            a.imagesLoaded(function() {
                a.isotope("layout");
            });
            jQuery(".gallery-filters").on("click", "a.gallery-filter", function(b) {
                b.preventDefault();
                var c = jQuery(this).attr("data-filter");
                a.isotope({
                    filter: c
                });
                jQuery(".gallery-filters a.gallery-filter").removeClass("gallery-filter-active");
                jQuery(this).addClass("gallery-filter-active");
                return false;
            });
        }
    }
    n();
    function d() {
        var a = document.querySelectorAll(".intense");
        Intense(a);
    }
    d();
// Owl carousel ------------------
    var heroslides = jQuery(".hero-slider");
    heroslides.each(function(index) {
        var auttime = eval(jQuery(this).data("attime"));
        var rtlt = eval(jQuery(this).data("rtlt"));
        jQuery(this).owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: auttime,
            autoplayHoverPause: false,
            autoplaySpeed: 1600,
            rtl: rtlt,
            dots: false
        });
    });
    var sync1 = jQuery(".synh-slider"), sync2 = jQuery(".synh-wrap"), flag = false, duration = 300;
    sync1.owlCarousel({
        loop: false,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        animateOut: "fadeOut",
        animateIn: "fadeIn"
    }).on("changed.owl.carousel", function(a) {
        if (!flag) {
            flag = true;
            sync2.trigger("to.owl.carousel", [ a.item.index, duration, true ]);
            flag = false;
        }
    });
    sync2.owlCarousel({
        loop: false,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        smartSpeed: 1200,
        autoHeight: true,
    }).on("changed.owl.carousel", function(a) {
        if (!flag) {
            flag = true;
            sync1.trigger("to.owl.carousel", [ a.item.index, duration, true ]);
            flag = false;
        }
    });
    jQuery(".customNavigation.fhsln a.next-slide").on("click", function() {
        sync2.trigger("next.owl.carousel");
		return false;
    });
    jQuery(".customNavigation.fhsln a.prev-slide").on("click", function() {
        sync2.trigger("prev.owl.carousel");
		return false;
    });
    var whs = jQuery(".full-width-slider");
    whs.owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        smartSpeed: 1200
    });
    jQuery(".full-width-slider-holder a.next-slide").on("click", function() {
        jQuery(this).closest(".full-width-slider-holder").find(whs).trigger("next.owl.carousel");
		return false;
    });
    jQuery(".full-width-slider-holder a.prev-slide").on("click", function() {
        jQuery(this).closest(".full-width-slider-holder").find(whs).trigger("prev.owl.carousel");
		return false;
    });
    whs.on("mousewheel", ".owl-stage", function(a) {
        if (a.deltaY < 0) whs.trigger("next.owl"); else whs.trigger("prev.owl");
        a.preventDefault();
    });
    var csi = jQuery(".custom-slider");
    csi.owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        smartSpeed: 1200
    });
    jQuery(".custom-slider-holder a.next-slide").on("click", function() {
        jQuery(this).closest(".custom-slider-holder").find(csi).trigger("next.owl.carousel");
		return false;
    });
    jQuery(".custom-sliderr-holder a.prev-slide").on("click", function() {
        jQuery(this).closest(".custom-slider-holder").find(csi).trigger("prev.owl.carousel");
		return false;
    });
    var slsl = jQuery(".slideshow-item");
    slsl.owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: false,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        autoplay: true,
        autoplayTimeout: 4e3,
        autoplayHoverPause: false,
        autoplaySpeed: 3600
    });
    var gR = jQuery(".gallery_horizontal"), w = jQuery(window);
    function initGalleryhorizontal() {
        var a = jQuery(window).height(), b = jQuery("header").outerHeight(), c = jQuery("footer").outerHeight(), d = jQuery("#gallery_horizontal");
        d.find("img").css("height", a - b - c);
        d.find("iframe").css("height", a - b - c);
        d.find("iframe").css("width", w - 350);
        if (gR.find(".owl-stage-outer").length) {
            gR.trigger("destroy.owl.carousel");
            gR.find(".horizontal_item").unwrap();
        }
        if (w.width() > 1036) gR.owlCarousel({
            autoWidth: true,
            margin: 10,
            items: 3,
            smartSpeed: 1300,
            loop: true,
            nav: false,
            dots: false,
            onInitialized: function() {
                gR.find(".owl-stage").css({
                    height: a - b - c,
                    overflow: "hidden"
                });
            }
        });
    }
    if (gR.length) {
        initGalleryhorizontal();
        w.on("resize.destroyhorizontal", function() {
            setTimeout(initGalleryhorizontal, 150);
        });
    }
    gR.on("mousewheel", ".owl-stage", function(a) {
        if (a.deltaY < 0) gR.trigger("next.owl"); else gR.trigger("prev.owl");
        a.preventDefault();
    });
    jQuery(".resize-carousel-holder a.next-slide").on("click", function() {
        jQuery(this).closest(".resize-carousel-holder").find(gR).trigger("next.owl.carousel");
		return false;
    });
    jQuery(".resize-carousel-holder a.prev-slide").on("click", function() {
        jQuery(this).closest(".resize-carousel-holder").find(gR).trigger("prev.owl.carousel");
		return false;
    });
// Nice scroll  ------------------
    var b = {
        touchbehavior: true,
        cursoropacitymax: 1,
        cursorborderradius: "0",
        background: "#eee",
        cursorwidth: "10px",
        cursorborder: "0px",
        cursorcolor: "#fff",
        autohidemode: false,
        bouncescroll: false,
        scrollspeed: 120,
        mousescrollstep: 90,
        grabcursorenabled: false,
        horizrailenabled: true
    };
    jQuery(".nav-inner , .fixed-info-container").niceScroll(b);
    var wn = {
        touchbehavior: true,
        cursoropacitymax: 1,
        cursorborderradius: "0",
        background: "#fff",
        cursorwidth: "6px",
        cursorborder: "0px",
        cursorcolor: "#ccc",
        autohidemode: true,
        bouncescroll: false,
        scrollspeed: 120,
        mousescrollstep: 90,
        grabcursorenabled: false,
        horizrailenabled: true,
		preservenativescrolling: true,
        cursordragontouch: true,
    };
    jQuery("#wrapper").niceScroll(wn);

//  Contact form ------------------
    jQuery("#contactform").submit(function() {
        var a = jQuery(this).attr("action");
        jQuery("#message").slideUp(750, function() {
            jQuery("#message").hide();
            jQuery("#submit").attr("disabled", "disabled");
            jQuery.post(a, {
                name: jQuery("#name").val(),
                email: jQuery("#email").val(),
                comments: jQuery("#comments").val()
            }, function(a) {
                document.getElementById("message").innerHTML = a;
                jQuery("#message").slideDown("slow");
                jQuery("#submit").removeAttr("disabled");
                if (null != a.match("success")) jQuery("#contactform").slideDown("slow");
            });
        });
        return false;
    });
    jQuery("#contactform input, #contactform textarea").keyup(function() {
        jQuery("#message").slideUp(1500);
    });
    jQuery(".close-contact").on("click", function() {
        jQuery(".contact-form-holder").removeClass("visform");
		return false;
    });
    jQuery(".showform").on("click", function(a) {
        a.preventDefault();
        jQuery(".contact-form-holder").addClass("visform");
		return false;
    });
// header functions +  menu  ------------------
    var cm = jQuery(".nav-button");
    var nh = jQuery(".nav-inner");
    var no = jQuery(".nav-overlay , .close-share");
    function showmenu() {
        setTimeout(function() {
            nh.addClass("vismen");
        }, 120);
        cm.addClass("cmenu");
        nh.removeClass("isDown");
        no.addClass("visover");
    }
    function hidemenu() {
        nh.addClass("isDown");
        cm.removeClass("cmenu");
        nh.removeClass("vismen");
        no.removeClass("visover");
    }
    cm.on("click", function() {
		if (nh.hasClass("isDown")) {
			showmenu();
		}
		else {
		hidemenu();
        hideShare();
		}
		return false;
    });
    no.on("click", function() {
        hidemenu();
        hideShare();
		return false;
    });
	jQuery(".nav-button").attr("onclick","return true");
    jQuery("nav li.subnav ").append('<i class="fa fa-angle-double-down subnavicon"></i>');
    jQuery(".nav-inner nav li").on("mouseenter", function() {
        jQuery(this).find("ul").stop().slideDown();
        jQuery(".nav-inner").addClass("menhov");
    });
    jQuery(".nav-inner nav li").on("mouseleave", function() {
        jQuery(this).find("ul").stop().slideUp();
        jQuery(".nav-inner").removeClass("menhov");
    });
    function hideShare() {
        jQuery(".share-inner").removeClass("visshare");
        jQuery(".show-share").addClass("isShare");
        jQuery(".share-container ").removeClass("vissc");
    }
    function showShare() {
        no.addClass("visover");
        jQuery(".share-inner").addClass("visshare");
        jQuery(".show-share").removeClass("isShare");
        setTimeout(function() {
            jQuery(".share-container ").addClass("vissc");
        }, 400);
    }
    jQuery(".show-share").on("click", function(a) {
        hidemenu();
        showShare();
    });
    function showFilter() {
        jQuery(".filter-button").addClass("filvisb");
        setTimeout(function() {
            jQuery(".filter-nvis-column").addClass("fnc");
        }, 400);
        jQuery(".filter-button").removeClass("vis-fc");
    }
    function hideFilter() {
        jQuery(".filter-nvis-column").removeClass("fnc");
        setTimeout(function() {
            jQuery(".filter-button").removeClass("filvisb");
        }, 400);
        jQuery(".filter-button").addClass("vis-fc");
    }
    jQuery(".filter-button").on("click", function() {
        if (jQuery(this).hasClass("vis-fc")) showFilter(); else hideFilter();
    });
    function showHidDes() {
        jQuery(".show-hid-content").removeClass("ishid");
        jQuery(".hidden-column").animate({
            left: "0",
            opacity: 1
        }, 500);
        jQuery(".anim-holder").animate({
            left: "350px"
        }, 500);
    }
    function hideHidDes() {
        jQuery(".show-hid-content").addClass("ishid");
        jQuery(".hidden-column").animate({
            left: "-350px",
            opacity: 0
        }, 500);
        jQuery(".anim-holder").animate({
            left: "0"
        }, 500);
    }
    jQuery(".show-hid-content").on("click", function() {
        if (jQuery(this).hasClass("ishid")) showHidDes(); else hideHidDes();
    });
// share  ------------------
    var shs = eval(jQuery(".share-container").attr("data-share"));
    jQuery(".share-container").share({
        networks: shs
    });
    function ac() {
        jQuery(".slideshow-item .item").css({
            height: jQuery(".slideshow-item ").outerHeight(true)
        });
        jQuery(".share-container").css({
            "margin-left": -jQuery(".share-container").width() / 2 + "px"
        });
        /*jQuery(".wh-info-box-inner").css({
            "margin-top": -1 * jQuery(".wh-info-box-inner").height() / 2 + "px"
        });*/
        jQuery(".filter-vis-column .gallery-filters").css({
            "margin-top": -1 * jQuery(".filter-vis-column .gallery-filters").height() / 2 + "px"
        });
        jQuery(".mm").css({
            "padding-top": jQuery("header").outerHeight(true)
        });
        jQuery(".synh-slider .item").css({
            height: jQuery(".synh-slider").outerHeight(true)
        });
        jQuery(".full-width-slider .item").css({
            height: jQuery(".full-width-slider").outerHeight(true)
        });
        jQuery(".synh-wrap").css({
            "margin-top": -1 * jQuery(".synh-wrap").height() / 5 + "px"
        });
        jQuery(".align-content").css({
            "margin-top": -1 * jQuery(".align-content").height() / 2 + "px"
        });
        jQuery(".enter-wrap-holder").css({
            "margin-top": -1 * jQuery(".enter-wrap-holder").height() / 2 + "px"
        });
        jQuery(".hero-grid .item").css({
            height: jQuery(".hero-grid").outerHeight(true)
        });
        jQuery(".small-column .item").css({
            height: jQuery(".small-column").outerHeight(true)
        });
        jQuery(".filter-nvis-column .gallery-filters").css({
            "margin-top": -1 * jQuery(".filter-nvis-column .gallery-filters").height() / 2 + "px"
        });

    }
    ac();
    jQuery(window).resize(function() {
        ac();
    });
// Init your functions here ------------------
jQuery('#s').attr('placeholder','Type and hit enter...');
jQuery('.wr-contact .full_section_inner > *').unwrap();
jQuery('.wr-contact .wpb_row > *').unwrap();
jQuery('.wr-contact .wpb_column > *').unwrap();
jQuery('.wr-contact .wpb_wrapper > *').unwrap();
jQuery('.wr-contact .wpb_content_element > *').unwrap();
jQuery('.wr-contact .vc_column-inner > *').unwrap();
jQuery('.wr-contact .row > *').unwrap();
jQuery('title').text(function(index,text){
    return text.replace('&#8211;','-');
});

}

function initvideo() {
    var a = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        }
    };
    trueMobile = a.any();
	if (trueMobile) {
		jQuery(".background-video").remove();

	}

}

// show hide content  ------------------
function contanimshow() {
    setTimeout(function() {
    	jQuery(".elem").removeClass("scale-bg2");
    }, 450);
    var a = window.location.href;
    var b = jQuery(".dynamic-title").text();
    jQuery(".header-title a").attr("href", a);
    jQuery(".header-title a").html(b);
}

function contanimhide() {
    setTimeout(function() {
        jQuery(".elem").addClass("scale-bg2");
    }, 650);
    jQuery(".show-share").addClass("isShare");
}
// Init core  ------------------
jQuery(function() {
    jQuery.coretemp({
        reloadbox: "#wrapper",
        loadErrorMessage: "<h2>404</h2> <br> page not found.",
        loadErrorBacklinkText: "Back to the last page",
        outDuration: 250,
        inDuration: 150
    });
    readyFunctions();
    jQuery(document).on({
        ksctbCallback: function() {
            readyFunctions();
        }
    });
});
function initmap () {
}
function initajaxload () {
}

// Init all functions  ------------------
function readyFunctions() {
    initDogma();
    initvideo();
    initmap ();
    initajaxload ();
}
