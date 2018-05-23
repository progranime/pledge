var JD = JD || {};

(function ($) {
	'use strict';

	JD.filter = {

		init: function () {
			// used the following code if this class exists
			if (!$('.jd-table__container').length) { return ; }

			this.domCache();
			this.eventHandler();
			this.onloadWindow();
		},

		domCache: function () {

			this.$jdTableOptions 		= $('.jd-table__options');
			this.$jdFilter 		 		= this.$jdTableOptions.find('.jd-filter');
			this.$dataTableSearch 		= $('#dataTableSearch');
			this.$tableState			= $('.table-state');
			this.$pageData				= $('.page-data');

		},

		eventHandler: function () {
			var self;
			self = JD.filter;

			this.$jdFilter.on('change', function (e) {
				// determine what table will be shown depends on the selected filter
				self.tableToggleVisibility({
					self: this
				});

			});

			// seraching between two tables (Leader and Contributor)
			this.$dataTableSearch.on('keyup', function () {
				var dTables = JD.dataTables.dTables;
			    dTables.search(this.value).draw();
			});

			// clicking the view in dashboard
			this.$tableState.on('click', function () {
				// will save the state of the data tables
				self.dataTableState();

			});

		},

		tableToggleVisibility: function (obj) {
			var dTables, dTablesPageLength, value;


			// get the data tables from the module of dataTables.js
			dTables = JD.dataTables.dTables;
			// get the length of the data table
			dTablesPageLength = JD.dataTables.dTablesPageLength;
			// get the value of the selected filter
			value = $(obj.self).val();

			// hide the table depends on the filter selected
			if (value == 'leader' ) {
				$('[data-role=leader]').show();
				$('[data-role=contributor]').hide();
			} else if (value == 'contributor') {
				$('[data-role=contributor]').show();
				$('[data-role=leader]').hide();
			} else {
				$('[data-role=leader]').show();
				$('[data-role=contributor]').show();
			}

			if (value == 'all') { // show pagination when all tables show
				dTables.page.len(dTablesPageLength).draw();
				$('.dataTables_paginate').show();
			} else { // show all items and hide the pagination numbers
				dTables.page.len(10000).draw();
				$('.dataTables_paginate').hide();
			}

		},

		dataTableState: function () {
			var self, sampleState, division, dTables;

			self 		= JD.filter;
			dTables 	= JD.dataTables.dTables;

			// geting the division of the page
			division 	= self.$pageData.data('division');

			// this will be dynamic and will retrieve when user tries to save the state
			sampleState = {
				'searchState': self.$dataTableSearch.val(),
				'filterSelectState': self.$jdFilter.val(),
				// 'paginationNumberState': 'page'
				'table': {
					'leader': {
						'paginationNumberState': 1
					},
					'contributor': {
						'paginationNumberState': 1
					}
				}
			};

			// setting the session per division
			// reminder that session storage will be deleted once the browser is closed
			sessionStorage.setItem(division, JSON.stringify(sampleState));

		},

		onloadWindow: function () {
			
			JD.filter.dataTableLatestAction();
			
		},

		dataTableLatestAction: function () {

			var self, division, parseState;
			self 		= JD.filter;

			// based on the division we will get the state of it
			division 	= self.$pageData.data('division');
			
			// check first if there is a session storage in this page
			// if have proceed apply the recent behaviour
			if (sessionStorage[division] !== undefined) {

				parseState = $.parseJSON(sessionStorage[division]);

				console.log(parseState);
				// selecting the recent filter used
				self.$jdFilter.find("[value='" + parseState.filterSelectState + "']").attr('selected', 'selected');

				// determine what table will be shown depends on the selected filter
				self.tableToggleVisibility({
					self: self.$jdFilter
				});

				// applying the latest search
				self.dataTableLatestSearch({
					value: parseState.searchState
				});
			}

		},

		dataTableLatestSearch: function (obj) {
			var self, dTables;
			self 		= JD.filter; 
			dTables 	= JD.dataTables.dTables;

			// applying the latest search to the search field
			self.$dataTableSearch.val(obj.value);
			// rendering the data tables based on the latest search
			dTables.search(obj.value).draw();
		}
	}


	$(function () {
		JD.filter.init();
	});




})(jQuery);