var JD = JD || {};

(function ($) {
	"use strict";

	JD.dataTables = {

		init: function () {
			// initialize data tables
			this.initDataTables();
		},

		initDataTables: function () {
			var base, rootFolder;
			this.dTablesPageLength = 5;

			// check if localhost if not the directory will change
			if (JD.tools.checkHost() == "localhost") {
				rootFolder = location.pathname.split('/')[1];
				base = window.location.origin + "/" + rootFolder + "/";
			} else {
				base = window.location.origin + "/";
			}

			this.dTables = $(".jd-table").DataTable({
				"responsive" : true,
				"pageLength" : this.dTablesPageLength,
				"bLengthChange" : false,
				"oLanguage": {
				   "sSearch": "",
				   "oPaginate" : {
		              "sPrevious" : "<img src='" + base + "public/images/icons/pagination-arrow-left.png' alt='' /> Prev",
		              "sNext"     : "Next <img src='" + base + "public/images/icons/pagination-arrow-right.png' alt='' /></i>",
		              "sFirst"    : "<img src='" + base + "public/images/icons/pagination-arrow-left-2.png' alt='' />",
		              "sLast"     : "<img src='" + base + "public/images/icons/pagination-arrow-right-2.png' alt='' />"
		            }
				},
				"order": [],
				"bInfo": false
			});

			$('.jd-table').find('input[type="search"]').addClass('form-control');
		}

	}


	$(function () {
		JD.dataTables.init();
	});




})(jQuery);