var JD = JD || {};

(function ($) {
	"use strict";

	JD.tools = {

		init: function () {

			this.domCache();
			this.eventHandler();
			this.checkHost();
			this.timeout(".flash-message");

		},

		domCache: function () {
			this.$jdTable = $(document).find(".jd-table");
			this.$copy = this.$jdTable.find(".copy");
			this.$goBack = $(document).find(".go-back");
			this.$goNext = $(document).find(".go-next");
		},

		eventHandler: function () {
			var self;

			self = JD.tools;

			this.$jdTable.on("click", ".copy", function() {
				// select the input to be copied
				$(this).find(".copy-text").select();
				// trigger the copy command
				document.execCommand("copy");
			});

			this.$goBack.on("click", self.goBack);
			this.$goNext.on("click", self.goNext);

		},

		goBack: function () {
			window.history.back();
		},

		goNext: function () {
			window.history.go(1);
		},

		// check if localhost or not
		checkHost: function () {
			var host;
			host = window.location.host;

			if (host == "https://pledges.musictri.be" || host == "pledges.musictri.be") {
				return "live";
			}

			return "localhost";
		
		},

		getUrl: function () {
			var rootFolder;

			if (JD.tools.checkHost() == "localhost") {
				rootFolder = location.pathname.split('/')[1];
				return window.location.origin + "/" + rootFolder;
			}

			return window.location.origin;

		},

		timeout: function (elem) {

			if ($(elem).hasClass("is-active")) {
				setTimeout(function () {
					$(elem).removeClass("is-active");
				}, 1500);
			}

		}

	}

	$(function () {
		JD.tools.init();
	});

})(jQuery);