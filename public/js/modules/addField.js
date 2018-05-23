var JD = JD || {};

(function ($) {
	"use strict";

	JD.addFields = {

		init: function () {
			
			this.domCache();
			this.eventHandler();
			this.addTextOnCheck();

		},

		domCache: function () {

			this.$dynamicContainer = $(".dynamic-container");
			this.$jdTemplateWrapper = $(".jd-template-wrapper");
		},

		eventHandler: function () {
			var self;

			self = JD.addFields;

			this.$jdTemplateWrapper.on("click", ".btn-add-field", function (e) {

				self.addField({
					self: this,
					container: ".dynamic-container",
					clone: ".dynamic-field",
					listContainer: ".statements-wrap"
				});
				e.stopImmediatePropagation();

			});

			this.$jdTemplateWrapper.on("click", ".btn-remove-field", function (e) {
				
				self.removeField({
					self: this,
					parent: ".dynamic-field"
				});

				e.stopImmediatePropagation();
			});


		},

		addField: function (obj) {
			var $parent, $container, $clone, $listContainer;
			$container 		= $(obj.self).parents(obj.container);
			$clone			= $container.find(obj.listContainer).find(obj.clone).eq(0).clone();
			$listContainer  = $container.find(obj.listContainer);

			// set to default the clone elements
			$clone.find("input").val("");
			$clone.find("input[type='checkbox']").removeAttr("checked");

			// show the minus icon for the user to remove
			$clone.addClass("removeable");

			// add the clone element to the list of fields
			$listContainer.append($clone);

		},

		removeField: function (obj) {
			// removing the field
			$(obj.self).parents(obj.parent).detach();

		},

		addTextOnCheck: function() {
			$(document).on('click', '.statement-status', function() {
				const $this = $(this);
				const $target = $this.parents('.dynamic-field').find('.status-hidden');

				if ($(this).is(':checked')) {
					$target.val('tobeedit');
				} else {
					$target.val('');
				}
			});
		}



	}

	$(function () {
		JD.addFields.init();
	});



})(jQuery);