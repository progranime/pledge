var JD = JD || {};

(function ($) {
	"use strict";

	JD.confirmation = {

		init: function () {

			// there must different type of confirmation dialog
			// 1. Prompt to know if need to delete a file
			// 2. Update

			this.domCache();
			this.eventListener();
		},

		domCache: function () {

			this.$deleteConfirmationModal = $(".delete-confirmation-modal");
			this.$btnConfirm			  = $("#confirmation-modal");

		},

		eventListener: function () {
			var self;

			self = JD.confirmation;

			this.$deleteConfirmationModal.on("click", function (e) {
				console.log("delete confirmation modal");
				self.showConfirmationModal({
					"modal": "#confirmation-modal",
					"title": "Delete",
					"content": "Are you sure you want to delete?",
					"data": {
						"id": $(this).data("id")
					}
				});

				// e.preventDefault();
			});

			this.$btnConfirm.on("click", ".btn-confirm", function (e) {
				var id, rootFolder;
				id = $(this).parents(".modal").find(".id").val();
				/*rootFolder = location.pathname.split('/')[1];

				if (JD.tools.checkHost() == "localhost") {
					window.location = window.location.origin + "/" + rootFolder + "/home/delete/" + id;
				} else {
					window.location = window.location.origin + "/home/delete/" + id;
				}*/

				window.location = JD.tools.getUrl() + "/division/deleteJd/" + id;
			});

		},

		showConfirmationModal: function (obj) {
			// basically IE11 and Bootstrap 4 have some issue on the Object.key because the parameter that is pass is not an object
			// to have a parameter that an object pass {} to read it as an object
			// work around for the modal to work on IE 
			$(obj.modal).modal({});
			// change title
			$(obj.modal).find(".modal-title").text(obj.title);
			// change description
			$(obj.modal).find(".modal-body .content").text(obj.content);
			// add the value
			$(obj.modal).find(".id").val(obj.data.id);
			// show the modal
			// $(obj.modal).modal("show");
			console.log("delete confirmation modal 2");

		}

	}

	$(function () {
		JD.confirmation.init();
	});



})(jQuery);