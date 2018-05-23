var JD = JD || {};

(function ($) {
	'use strict';

	JD.template = {

		init: function () {
			
			if (!$(".jd-template-wrapper").length) { return ; }

			this.domCache();
			this.eventHandler();
			// this must run to get the data onload
			this.getSelectedFilter();
		},

		domCache: function () {

			this.$jdTemplateWrapper 	= $('.jd-template-wrapper');
			this.$filterSelect			= $('.filter-select');
			this.$filterDivision		= $('.filter-division');
			this.$filterRole			= $('.filter-role');
			this.$userData				= $('.user-data');
			this.$formButtons			= $('.form-buttons');

		},

		eventHandler: function () {

			this.$filterSelect.on('change', function () {
				// hide the form button everytime when select is change
				JD.template.$formButtons.addClass('d-none');
				// get the selected value for different filters
				JD.template.getSelectedFilter();
			});

		},

		getSelectedFilter: function () {
			var self, id, division, role, userDivision = "", userRole = "";

			self = JD.template;

			// get the selected value for both filter
			division 	= self.$filterDivision.val();
			role 		= self.$filterRole.val();

			// get user defined division and role
			id 				= self.$userData.data('id') 	  == undefined ? "" : self.$userData.data('id');
			userDivision 	= self.$userData.data('division') == undefined ? "" : self.$userData.data('division');
			userRole 		= self.$userData.data('role') 	  == undefined ? "" : self.$userData.data('role');

			// check first where the data will be retrieve
			// either the user template or the defined template
			if (userDivision == division && userRole == role) { // use the user template
				// console.log('user template');
				self.requestData({
					id: id,
					url: JD.tools.getUrl() + "/division/getUserTemplate"
				});
			} else {  // it means use the defined template
				// console.log("template", JD.tools.getUrl());
				self.requestData({
					url: JD.tools.getUrl() + "/division/getDefinedTemplate",
					division: division,
					role: role
				});
			}

		},

		requestData: function (obj) {

			$.ajax({
				url: obj.url,
				type: "get",
				data: {
					id: obj.id,
					division: obj.division,
					role: obj.role
				},
				success: function (data) {
					// pass the needed data
					// then render the template using handlebar
					JD.template.renderTemplate({
						data: data,
						parent: '.jd-template-wrapper',
						template: '#jd-template'
					});
				}
			});

		},

		renderTemplate: function (obj) {
			var self, $parent, template, templateScript, parseData, statements, html;

			self 			= JD.template;

			$parent 		= $(obj.parent);
			template 		= $(obj.template).html();
			templateScript 	= Handlebars.compile(template);

			// parse the data to JSON in able to use it
			parseData 		= $.parseJSON(obj.data)[0];

			// collect all the statements in one object
			statements = {
				promises_statement: $.parseJSON(parseData.promises_statement),
				deliveries_statement: $.parseJSON(parseData.deliveries_statement),
				rewards_statement: $.parseJSON(parseData.rewards_statement)
			};

			html = templateScript(statements);

			// then render it
			if($parent.find(".hb-wrapper").length) {
				$parent.find('.hb-wrapper').remove().promise().done(function() {
					$parent.append(html);
					// show the form buttons
					self.$formButtons.removeClass("d-none");
				});
			} else {
				$parent.append(html);
				// show the form buttons
				self.$formButtons.removeClass("d-none");
			}

		}

	}

	$(function () {
		JD.template.init();
	});


})(jQuery);