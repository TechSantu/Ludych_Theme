(function ($) {
    "use strict";

    $(document).ready(function () {
        var headerHeight = $(".top-navbar").outerHeight();

        $(window).on("scroll", function () {
            var scrollPos = $(this).scrollTop();

            if (scrollPos >= headerHeight) {
                $("header").addClass("sticky");
            } else {
                $("header").removeClass("sticky");
            }
        });

        $("#clientTestimonial").owlCarousel({
            nav: false,
            dots: true,
            items: 1,
            loop: true,
            margin: 70,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 5000,
            autoplayHoverPause: true
        });

        $("#whatThetSays").owlCarousel({
            nav: false,
            dots: true,
            items: 1,
            loop: true,
            margin: 70,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 5000,
            autoplayHoverPause: true
        });

        $("#ourBlogItem").owlCarousel({
            nav: true,
            dots: false,
            loop: true,
            margin: 70,
            autoplay: false,
            autoplayTimeout: 4500,
            autoplaySpeed: 4500,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        });

        $(".accordion-list > li > .answer").hide();

        $(".accordion-list > li:first")
            .addClass("active")
            .find(".answer")
            .show();

        $(".accordion-list > li").on("click", function (e) {
            e.preventDefault();

            if ($(this).hasClass("active")) {
                $(this)
                    .removeClass("active")
                    .find(".answer")
                    .slideUp();
            } else {
                $(".accordion-list > li.active")
                    .removeClass("active")
                    .find(".answer")
                    .slideUp();

                $(this)
                    .addClass("active")
                    .find(".answer")
                    .slideDown();
            }
        });
    });
})(jQuery);
