var JD = JD || {};

(function ($) {
	"use strict";

	JD.login = {

		init: function () {

			this.autoLogin();

		},

		autoLogin: function () {
			var urlString, url, email, password, dEmail, dPassword;
			
			// u=amVyZW15LmVzcGlub3Nh&p=cGFzc3dvcmQ=

			urlString 	= window.location.href; // get the url path
			url 	  	= new URL(urlString);
			email  		= url.searchParams.get("u"); // get the parameter u or the username
			password  	= url.searchParams.get("p"); // get the parameter p or the password

			// decrpyt the encode data
			dEmail    	= window.atob(email);
			dPassword 	= window.atob(password);

			// after getting the parameters value
			// call the controller

			if (email != null && password != null) { // check if the user name and password is not null
				// passing the data to the controller
				$.ajax({
					url: JD.tools.getUrl() + "/login/autoLogin",
					type: "POST",
					data: {
						email: email,
						password: password
					},
					success: function (data) {
						// redirect to the home / division page if successfully login 
						if (data == "success") {
							window.location = JD.tools.getUrl() + "/division";
						}

					}
				});

			}

		}



	}

	$(function () {
		JD.login.init();
	});



})(jQuery);