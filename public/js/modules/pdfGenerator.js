var JD = JD || {};

(function ($) {
	"use strict";

	JD.pdfGnerator = {

		init: function () {
			// check if this class exists if not dont proceed the code
			if (!$("#pdf-container").length) { return ; }

			this.domCache();
			this.eventHandler();
		},

		domCache: function () {
			this.$btnGeneratePdf = $(".btn-generate-pdf");
			this.$pdfData 		 = $('.pdf-data');
		},

		eventHandler: function () {
			var self;

			self = JD.pdfGnerator;

			this.$btnGeneratePdf.on("click", function (e) {
				// getting the file name
				// var pdfName = $(".division").val() + "_" + $(".ijt").val() + "_" + $(".location").val();
				var pdfName = self.$pdfData.data('division') + '_' + self.$pdfData.data('ijt') + '_' + self.$pdfData.data('location');
				// call the class to generate the pdf
				self.generatePdf("#pdf-container", pdfName + ".pdf");
				
				e.preventDefault();
			});
		},

		generatePdf: function (container, filename) {

			var doc = new jsPDF('p', 'pt', 'a4');

			$(container).addClass('converting');

			doc.addHTML($(container), function() {
				doc.save(filename);
				$(container).removeClass('converting');
			});

		}

	}

	$(function () {
		JD.pdfGnerator.init();
	});




})(jQuery);