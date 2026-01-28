// top sticky
var headerHeight = $(".top-navbar").height();
$(window).scroll(function () {
    var scrollPos = $(this).scrollTop();

    if (scrollPos >= headerHeight) {
        $("header").addClass("sticky");
    } else {
        $("header").removeClass("sticky");
    }
});

// Client Testimonial
$('#clientTestimonial').owlCarousel({
    nav: false,
    dots: true,
    items: 1,
    loop: true,
    margin: 70,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplaySpeed: 5000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 1
        },
        1200: {
            items: 1
        }
    }
});

// what they says
$('#whatThetSays').owlCarousel({
    nav: false,
    dots: true,
    items: 1,
    loop: true,
    margin: 70,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplaySpeed: 5000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 1
        },
        1200: {
            items: 1
        }
    }
});

// Our blog slider
$('#ourBlogItem').owlCarousel({
    nav: true,
    dots: false,
    items: 1,
    loop: true,
    margin: 70,
    autoplay: false,
    autoplayTimeout: 4500,
    autoplaySpeed: 4500,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,
        },
        1000: {
            items: 2
        },
        1200: {
            items: 2
        }
    }
});

// Accordian js
$(document).ready(function () {
    $(".accordion-list > li > .answer").hide();

    $(".accordion-list > li:first").addClass("active").find(".answer").show();

    $(".accordion-list > li").click(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active").find(".answer").slideUp();
        } else {
            $(".accordion-list > li.active .answer").slideUp();
            $(".accordion-list > li.active").removeClass("active");
            $(this).addClass("active").find(".answer").slideDown();
        }
        return false;
    });
});