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

			$("#clientLogos").owlCarousel(
				{
					nav: false,
					dots: false,
					loop: true,
					margin: 30,
					autoplay: true,
					autoplayTimeout: 3000,
					autoplaySpeed: 1500,
					autoplayHoverPause: true,
					responsive: {
						0: {
							items: 2
						},
						576: {
							items: 3
						},
						768: {
							items: 4
						},
						992: {
							items: 5
						},
						1200: {
							items: 6
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

			$('input[name="name"], input[name="first_name"], input[name="last_name"]').on(
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

					var form             = $(this);
					var messageBox       = form.find(".form-message");
					var submitBtn        = form.find("button[type='submit']");
					var originalBtnText  = submitBtn.find("span").text();
					var recaptchaEnabled = form.data("recaptcha-enabled") === 1 || form.data("recaptcha-enabled") === "1";
					var recaptchaSiteKey = form.data("recaptcha-sitekey");

					function sendAjax() {
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

					if (recaptchaEnabled && recaptchaSiteKey && window.grecaptcha) {
						grecaptcha.ready(function () {
							grecaptcha.execute(recaptchaSiteKey, { action: "contact_form" })
								.then(function (token) {
									form.find('input[name="recaptcha_token"]').val(token);
									sendAjax();
								})
								.catch(function () {
									messageBox.addClass("alert alert-danger").html("reCAPTCHA failed. Please try again.");
									submitBtn.prop("disabled", false);
									submitBtn.find("span").text(originalBtnText);
								});
						});
					} else {
						sendAjax();
					}
				}
			);

			// Mobile Menu Dropdown Toggle
			$('.navbar-nav .dropdown > a').on('click', function (e) {
				if ($(window).width() < 992) {
					var $el     = $(this);
					var $parent = $el.parent('.dropdown');
					var $menu   = $el.next('.dropdown-menu');

					// Check if this is a top-level item or a nested one
					var isNested = $parent.hasClass('dropdown-submenu');

					// Case 1: If the menu is already open, CLOSE it on the second click
					if ($parent.hasClass('show')) {
						e.preventDefault(); // Stop navigation
						$parent.removeClass('show');
						$menu.removeClass('show');
						$el.attr('aria-expanded', 'false');
					}
					// Case 2: If the menu is closed, OPEN it
					else {
						e.preventDefault();
						e.stopPropagation();

						// Only close OTHER menus if it's a top-level dropdown
						if ( ! isNested) {
							$('.navbar-nav .dropdown, .navbar-nav .dropdown-menu').not($parent).not($parent.parents('.dropdown')).removeClass('show');
						} else {
							// For nested menus, only close sibling nested menus
							$parent.siblings('.dropdown-submenu').removeClass('show').find('.dropdown-menu').removeClass('show');
						}

						$parent.addClass('show');
						$menu.addClass('show');
						$el.attr('aria-expanded', 'true');
					}
				}
			});

			function loadBlogPosts(page, layout) {
				var container  = $('#blog-posts-container');
				var pagination = $('#blog-pagination-container');

				var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;

				$.ajax({
					url: ludych_ajax_obj.ajax_url,
					type: 'post',
					data: {
						action: 'ludych_ajax_blog_filter',
						paged: page,
						layout: layout,
						base_url: baseUrl
					},
					beforeSend: function () {
						container.css('opacity', '0.5');
					},
					success: function (response) {
						container.css('opacity', '1');
						if (response) {
							if (response.content) {
								container.html(response.content);
							}
							if (response.pagination !== undefined) {
								pagination.html(response.pagination);
							}

							var params = new URLSearchParams(window.location.search);
							params.set('layout', layout);
							if (page > 1) {
								params.set('paged', page);
							} else {
								params.delete('paged');
							}
							var newUrl = baseUrl + "?" + params.toString();
							window.history.pushState({ path: newUrl }, '', newUrl);
						}
					},
					error: function () {
						container.css('opacity', '1');
						console.log('Error loading posts');
					}
				});
			}

			$(document).on('click', '.switcher-btn', function (e) {
				e.preventDefault();
				var btn    = $(this);
				var layout = btn.data('type');

				$('.switcher-btn').removeClass('btn-secondary').addClass('btn-light');
				btn.removeClass('btn-light').addClass('btn-secondary');

				var params = new URLSearchParams(window.location.search);
				var page   = params.get('paged') || 1;

				loadBlogPosts(page, layout);
			});

			$(document).on('click', '#blog-pagination-container a', function (e) {
				e.preventDefault();
				var url = $(this).attr('href');

				var page  = 1;
				var match = url.match(/\/page\/(\d+)/);
				if (match) {
					page = match[1];
				} else {
					match = url.match(/[?&]paged=(\d+)/);
					if (match) {
						page = match[1];
					}
				}

				var layout = $('.switcher-btn.btn-secondary').data('type') || 'grid';

				loadBlogPosts(page, layout);

				$('html, body').animate({
					scrollTop: $(".our-blog").offset().top - 100
				}, 500);
			});

			// Case Studies AJAX Filter & Pagination
			var csContainer         = $('#case-studies-container');
			var csLoadMoreBtn       = $('#load-more-case-studies');
			var csLoadMoreContainer = $('.case-studies-load-more');

			function loadCaseStudies(term, page, append) {
				$.ajax({
					url: ludych_ajax_obj.ajax_url,
					type: 'post',
					data: {
						action: 'ludych_ajax_case_studies_filter',
						term: term,
						paged: page
					},
					beforeSend: function () {
						if ( ! append) {
							csContainer.css('opacity', '0.5');
						} else {
							csLoadMoreBtn.addClass('disabled').find('span').html('Loading... <i class="fa-solid fa-spinner fa-spin"></i>');
						}
					},
					success: function (response) {
						if ( ! append) {
							csContainer.css('opacity', '1');
							if (response && response.content !== undefined) {
								csContainer.html(response.content);
							}
						} else {
							csLoadMoreBtn.removeClass('disabled').find('span').html('Load More <i class="fa-solid fa-arrow-right-long"></i>');
							if (response && response.content !== undefined) {
								csContainer.append(response.content);
							}
						}

						// Update pagination state
						if (response) {
							var maxPages    = response.max_pages || 1;
							var currentPage = response.current_page || 1;

							csLoadMoreBtn.data('max-pages', maxPages);
							csLoadMoreBtn.data('paged', currentPage);

							if (currentPage >= maxPages) {
								csLoadMoreContainer.hide();
							} else {
								csLoadMoreContainer.show();
							}
						}

						// Update URL
						var params = new URLSearchParams(window.location.search);
						if (term) {
							params.set('case-study-category', term);
						} else {
							params.delete('case-study-category');
						}

						var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
						var newUrl  = baseUrl + (params.toString() ? "?" + params.toString() : "");
						window.history.pushState({ path: newUrl }, '', newUrl);
					},
					error: function () {
						csContainer.css('opacity', '1');
						csLoadMoreBtn.removeClass('disabled').find('span').html('Load More <i class="fa-solid fa-arrow-right-long"></i>');
						console.log('Error loading case studies');
					}
				});
			}

			$(document).on('click', '.cs-tabs a', function (e) {
				e.preventDefault();
				var link = $(this);
				var term = link.data('term') || '';

				$('.cs-tabs a').removeClass('active');
				link.addClass('active');

				// Reset pagination on tab change
				loadCaseStudies(term, 1, false);
			});

			$(document).on('click', '#load-more-case-studies', function (e) {
				e.preventDefault();
				var btn = $(this);
				if (btn.hasClass('disabled')) {
					return;
				}

				var term        = $('.cs-tabs a.active').data('term') || '';
				var currentPage = parseInt(btn.data('paged')) || 1;
				var nextPage    = currentPage + 1;

				loadCaseStudies(term, nextPage, true);
			});

			// Case Study Detail Tabs
			$(document).on('click', '[data-case-study-tabs] .case-study-tabs__btn', function () {
				var btn      = $(this);
				var targetId = btn.data('tab-target');
				var tabs     = btn.closest('[data-case-study-tabs]');
				if ( ! targetId || ! tabs.length) {
					return;
				}

				tabs.find('.case-study-tabs__btn').removeClass('is-active').attr('aria-selected', 'false');
				btn.addClass('is-active').attr('aria-selected', 'true');

				tabs.find('.case-study-tabs__panel').removeClass('is-active');
				tabs.find('#' + targetId).addClass('is-active');
			});

			// Case Study Solution Tabs (Searchbloom-style)
			$(document).on('click', '.cs-sol-section .nav-link[data-tab]', function () {
				var btn       = $(this);
				var tabId     = btn.data('tab');
				var container = btn.closest('.cs-sol-section');
				if ( ! tabId || ! container.length) {
					return;
				}
				container.find('.nav-link').removeClass('active');
				btn.addClass('active');
				container.find('.tab-pane').removeClass('active');
				container.find('#' + tabId).addClass('active');
			});

			// Case Study Solution Accordion (mobile)
			$(document).on('click', '.cs-sol-section [data-toggle="collapse"] .point-title', function () {
				var item   = $(this).closest('[data-toggle="collapse"]');
				var target = item.data('target');
				if ( ! target) {
					return;
				}
				var panel = $(target);
				if (panel.hasClass('show')) {
					panel.removeClass('show');
					item.attr('aria-expanded', 'false');
				} else {
					var container = item.closest('#tabContentCS');
					if (container.length) {
						container.find('.collapse').removeClass('show');
						container.find('[data-toggle="collapse"]').attr('aria-expanded', 'false');
					}
					panel.addClass('show');
					item.attr('aria-expanded', 'true');
				}
			});

			// Case Study Gallery Lightbox
			var csGallery  = $('[data-case-study-gallery]');
			var csLightbox = $('[data-case-study-lightbox]');
			if (csGallery.length && csLightbox.length) {
				var csItems              = csGallery.find('.case-study-gallery-item');
				var csImage              = csLightbox.find('[data-gallery-image]');
				var csCaption            = csLightbox.find('[data-gallery-caption]');
				var csCloseButtons       = csLightbox.find('[data-gallery-close]');
				var csPrev               = csLightbox.find('[data-gallery-prev]');
				var csNext               = csLightbox.find('[data-gallery-next]');
				var csCurrentIndex       = 0;
				var csLastFocusedElement = null;

				function csOpenLightbox(index) {
					csLastFocusedElement = document.activeElement;
					csUpdateSlide(index);
					csLightbox.addClass('is-open').attr('aria-hidden', 'false');
					$('body').addClass('case-study-lightbox-open');
					csCloseButtons.first().trigger('focus');
				}

				function csCloseLightbox() {
					csLightbox.removeClass('is-open').attr('aria-hidden', 'true');
					$('body').removeClass('case-study-lightbox-open');
					if (csLastFocusedElement && typeof csLastFocusedElement.focus === 'function') {
						csLastFocusedElement.focus();
					}
				}

				function csUpdateSlide(index) {
					if ( ! csItems.length) {
						return;
					}

					csCurrentIndex = index;
					if (csCurrentIndex < 0) {
						csCurrentIndex = csItems.length - 1;
					}
					if (csCurrentIndex >= csItems.length) {
						csCurrentIndex = 0;
					}

					var currentItem = csItems.eq(csCurrentIndex);
					var src         = currentItem.attr('data-gallery-src') || '';
					var alt         = currentItem.attr('data-gallery-alt') || '';
					var caption     = currentItem.attr('data-gallery-caption') || '';

					csImage.attr('src', src);
					csImage.attr('alt', alt);
					csCaption.text(caption);
				}

				csItems.on('click', function () {
					csOpenLightbox(csItems.index(this));
				});

				csPrev.on('click', function () {
					csUpdateSlide(csCurrentIndex - 1);
				});

				csNext.on('click', function () {
					csUpdateSlide(csCurrentIndex + 1);
				});

				csCloseButtons.on('click', function () {
					csCloseLightbox();
				});

				$(document).on('keydown.caseStudyGallery', function (e) {
					if ( ! csLightbox.hasClass('is-open')) {
						return;
					}
					if (e.key === 'Escape') {
						csCloseLightbox();
					}
					if (e.key === 'ArrowLeft') {
						csUpdateSlide(csCurrentIndex - 1);
					}
					if (e.key === 'ArrowRight') {
						csUpdateSlide(csCurrentIndex + 1);
					}
				});
			}
		}
	);
})(jQuery);
