/*
 *  Project: security.js
 *  Description: Object-Oriented Approach in Php Security
 *  Author: @dumerz
 *  License: Freeware
 */

 var security = {

 		xhr : {

 			result : " ",

 			create : function() {

				try { return new XMLHttpRequest(); } catch(e) {}
				try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); } catch (e) {}
				try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); } catch (e) {}
				try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {}
				try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
				alert("XMLHttpRequest not supported");
				return null;
 			},

 			sendRequest : function( method,url ) {

 				var xhr = security.xhr.create();
					if (xhr) {
						xhr.open(method,url,true);
						xhr.onreadystatechange = function(){var result = security.xhr.handleResponse(xhr)};
						xhr.send(null);
					}
 			},

 			handleResponse : function(xhr) {

 				if (xhr.readyState == 4 && xhr.status == 200) {
					 var parsedResponse = xhr.responseXML;
					 var result = parsedResponse.getElementsByTagName("result")[0].firstChild.nodeValue;
					 security.xhr.result = result;
				}
 			}

 		},

 		check : {

 			email : function(x) {

 				var error = [];
 					var pattern = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
 						if (x=='') {error.push("")}
	 					if (!pattern.test(x)) {error.push("<span class=\"error-res\">Email Address is not valid</span>")}
	 						var url = "http://localhost/AGILE_SCRUM/security/xhr/xhr2.php?email=" + x;
	 						security.xhr.sendRequest("GET",url);
	 							if(security.xhr.result == 1) {error.push("<span class=\"error-res\">Email address already exist</span>")}
	 							if(security.xhr.result == 0) {error.push("<span class=\"valid-res\">Email address is valid</span>")}
 							return error;
 			},

 			username : function(x) {

 				var error = [];
 					if (x=='') {error.push("")}
 					if (x.length < 6) {error.push("<span class=\"error-res\">Minimum for username of 6 characters</span>")}
 					if (x.length > 15) {error.push("<span class=\"error-res\">Maximum for username of 15 characters</span>")}
	 					var pattern = /[A-Z]/;
	 					 	if (pattern.test(x)) {error.push("<span class=\"error-res\">Username must not contains capital letters</span>")}
	 					var pattern = /[a-z]/;
	 						if (!pattern.test(x)) {error.push("<span class=\"error-res\">Username must contains letters</span>")}
	 					var pattern = /[0-9]/;
	 						if (!pattern.test(x)) {error.push("<span class=\"error-res\">Username must contains numbers</span>")}
				 				var pattern = /^[a-z0-9_]{6,15}$/;
				 					if (!pattern.test(x)) {error.push("<span class=\"error-res\">Username contains special characters</span>")}
				 						var url1 = "http://localhost/AGILE_SCRUM/security/xhr/xhr.php?username=" + x;
				 						security.xhr.sendRequest("GET",url1);
				 							if(security.xhr.result == 1) {error.push("<span class=\"error-res\">Username already exist</span>")}
				 							if(security.xhr.result == 0) {error.push("<span class=\"valid-res\">Username is valid</span>")}
 											return error;
 			},

 			password : function(x) {

 				var error = [];
 				 	if (x=='') {error.push("")}
 					if (x.length < 6) {error.push("<span class=\"error-res\">Minimum for password of 6 characters</span>")}
			 			var pattern = /[A-Z]/;
			 			if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password must contain capital letters</span>")}
				 			var pattern = /[0-9]/;
				 			if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password must a contain number</span>")}
					 			var pattern = /^[A-z0-9_]{6,20}$/;
					 				if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password contains special characters</span>")}
						 			if (pattern.test(x)) {error.push("<span class=\"valid-res\">Password is valid</span>")}
						 				return error;
 			}

 		}

 	}
 	var user = document.getElementById("username");
  	var pass = document.getElementById("password");
  	var old_pass = document.getElementById("old_password");
 	var email = document.getElementById("email");
 	var image = document.getElementById("image");
 	var res_usr = document.getElementById("res_username");
 	var res_pass = document.getElementById("res_password");
 	var res_old_pass = document.getElementById("res_old_password");
 	var res_email = document.getElementById("res_email");
 	var res_image = document.getElementById("res_image");

 	function blur_usr() {
 		var result = security.check.username(user.value);
 		res_usr.innerHTML = result[0];
 	}

 	function blur_pass() {
 		blur_usr()
 		blur_email()
 		result = security.check.password(pass.value);
 		res_pass.innerHTML = result[0];
 	}

 	function blur_old_pass() {
 		blur_usr()
 		blur_email()
 		result = security.check.password(old_pass.value);
 		res_old_pass.innerHTML = result[0];
 	}

  	function blur_email() {
 		result = security.check.email(email.value);
 		res_email.innerHTML = result[0];
 	}

 	window.addEventListener("keyup",function(){blur_usr();blur_email();blur_pass();blur_old_pass()},false) 
