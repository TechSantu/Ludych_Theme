(function ($) {
	"use strict";

	$(document).ready(
		function () {
			var headerHeight = $(".top-navbar").outerHeight();

			$(window).on(
				"scroll",
				function () {
					var scrollPos = $(this).scrollTop();

					if (scrollPos >= headerHeight) {
						$("header").addClass("sticky");
					} else {
						$("header").removeClass("sticky");
					}
				}
			);

			$("#clientTestimonial").owlCarousel(
				{
					nav: false,
					dots: true,
					items: 1,
					loop: true,
					margin: 70,
					autoplay: true,
					autoplayTimeout: 5000,
					autoplaySpeed: 5000,
					autoplayHoverPause: true
				}
			);

			$("#whatThetSays").owlCarousel(
				{
					nav: false,
					dots: true,
					items: 1,
					loop: true,
					margin: 70,
					autoplay: true,
					autoplayTimeout: 5000,
					autoplaySpeed: 5000,
					autoplayHoverPause: true
				}
			);

			$("#ourBlogItem").owlCarousel(
				{
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
						},
						1200: {
							items: 3
						}
					}
				}
			);

			$(".accordion-list > li > .answer").hide();

			$(".accordion-list > li:first")
				.addClass("active")
				.find(".answer")
				.show();

			$(".accordion-list > li").on(
				"click",
				function (e) {
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
				}
			);

			$("#load-more-services").on(
				"click",
				function (e) {
					e.preventDefault();

					var button   = $(this);
					var page     = button.data("page");
					var maxPage  = button.data("max-pages");
					var postType = button.data("post-type");
					var nextPage = page + 1;

					$.ajax(
						{
							url: ludych_ajax_obj.ajax_url,
							type: "post",
							data: {
								action: "load_more_services",
								page: nextPage,
								post_type: postType
							},
							beforeSend: function () {
								button.find("span").html('Loading... <i class="fa-solid fa-spinner fa-spin"></i>');
							},
							success: function (response) {
								if (response) {
									$("#services-container").append(response);
									button.data("page", nextPage);
									button.find("span").html('Show more  <i class="fa-solid fa-arrow-right-long"></i>');

									if (nextPage === maxPage) {
										button.fadeOut();
									}
								} else {
									button.fadeOut();
								}
							}
						}
					);
				}
			);

			// Input Restrictions
			$('input[name="phone"]').on(
				'input',
				function () {
					this.value = this.value.replace(/[^\d\s+\-()]/g, '');
				}
			);

			$('input[name="name"]').on(
				'input',
				function () {
					this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
				}
			);

			$('input[name="email"]').on(
				'input',
				function () {
					this.value = this.value.replace(/\s/g, '');
				}
			);

			$('input[name="company"]').on(
				'input',
				function () {
					this.value = this.value.replace(/[^a-zA-Z0-9\s.\-&]/g, '');
				}
			);

			// Contact Form AJAX
			$("#ludych-contact-form").on(
				"submit",
				function (e) {
					e.preventDefault();

					var form            = $(this);
					var messageBox      = form.find(".form-message");
					var submitBtn       = form.find("button[type='submit']");
					var originalBtnText = submitBtn.find("span").text();

					$.ajax(
						{
							url: ludych_ajax_obj.ajax_url,
							type: "post",
							data: form.serialize(),
							beforeSend: function () {
								submitBtn.prop("disabled", true);
								submitBtn.find("span").html('Sending... <i class="fa-solid fa-spinner fa-spin"></i>');
								messageBox.removeClass("alert alert-success alert-danger").html("");
							},
							success: function (response) {
								if (response.success) {
									messageBox.addClass("alert alert-success").html(response.data.message);
									form[0].reset();

									// Redirect after 2 seconds
									setTimeout(function () {
										window.location.href = response.data.redirect_url;
									}, 2000);
								} else {
									submitBtn.prop("disabled", false);
									submitBtn.find("span").text(originalBtnText);
									messageBox.addClass("alert alert-danger").html(response.data.message);
								}
							},
							error: function () {
								submitBtn.prop("disabled", false);
								submitBtn.find("span").text(originalBtnText);
								messageBox.addClass("alert alert-danger").html("An error occurred. Please try again.");
							}
						}
					);
				}
			);
		}
	);
})(jQuery);
