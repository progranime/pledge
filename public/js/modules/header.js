var JD = JD || {};

(function ($) {
	"use strict";

	JD.header = {

		init: function () {

			this.domCache();
			this.eventHandler();

		},

		domCache: function () {

			this.$overlay = $(".header-overlay");

			this.$gh = $(".global-header");
			this.$ghMenu = this.$gh.find(".global-header__menu");
			this.$ghLists = this.$gh.find(".global-header__lists");

		},

		eventHandler: function () {
			var self;
			self = JD.header;

			this.$ghMenu.on("click", function () {
				// $("body").toggleClass("position-relative");
				self.$ghMenu.toggleClass("is-active");
				// toggle the header lists
				self.$ghLists.toggleClass("is-visible");
				self.$overlay.toggleClass("is-visible");

			});

		}

	}

	$(function () {
		JD.header.init();
	});



})(jQuery);