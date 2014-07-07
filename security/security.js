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
 					 if (x=="") {error.push("<span class=\"error-res\">Please fill up this field</span>")}
 					var pattern = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	 					if (!pattern.test(x)) {error.push("<span class=\"error-res\">Email Address is not valid</span>")}
	 					if (pattern.test(x)) {error.push("<span class=\"valid-res\">Email Address is valid</span>")}
 							return error;
 			},

 			username : function(x) {

 				var error = [];
 					if (x=="") {error.push("<span class=\"error-res\">Please fill up this field</span>")}
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
 										var user = document.getElementById("username");
				 						var url = "http://localhost/AGILE_SCRUM/security/xhr/xhr.php?username=" + user.value;
				 						security.xhr.sendRequest("GET",url);
				 							if(security.xhr.result == 1) {error.push("<span class=\"error-res\">Username already exist</span>")}
				 							if(security.xhr.result == 0) {error.push("<span class=\"valid-res\">Username is valid</span>")}
 											return error;
 			},

 			password : function(x) {

 				var error = [];
 					if (x=="") {error.push("<span class=\"error-res\">Please fill up this field</span>")}
 					if (x.length < 6) {error.push("<span class=\"error-res\">Minimum for password of 6 characters</span>")}
			 			var pattern = /[A-Z]/;
			 			if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password must contain capital letters</span>")}
				 			var pattern = /[0-9]/;
				 			if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password must a contain number</span>")}
					 			var pattern = /^[A-z0-9_]{6,20}$/;
					 				if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password contains special characters</span>")}
						 			if (pattern.test(x)) {error.push("<span class=\"valid-res\">Password is valid</span>")}
						 				return error;
 			},

 			rt_password : function(x, y) {

 				var error = [];
 					if (y=="") {error.push("<span class=\"error-res\">Please fill up the password field</span>")}
 					if (x=="") {error.push("<span class=\"error-res\">Please fill up this field</span>")}
 					if (x.length < 6) {error.push("<span class=\"error-res\">Minimum for password of 6 characters</span>")}
			 			var pattern = /[A-Z]/;
			 			if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password must contain capital letters</span>")}
				 			var pattern = /[0-9]/;
				 			if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password must a contain number</span>")}
					 			var pattern = /^[A-z0-9_]{6,20}$/;
					 				if (!pattern.test(x)) {error.push("<span class=\"error-res\">Password contains special characters</span>")}
 					if (x!=y) {error.push("<span class=\"error-res\">Passwords are not identical</span>")}
 					else {error.push("<span class=\"valid-res\">Passwords are identical</span>")}
					return error;
 			}

 		}

 	}
 	var user = document.getElementById("username");
  	var pass = document.getElementById("password");
  	var rt_pass = document.getElementById("rt_password");
 	var email = document.getElementById("email");
 	var image = document.getElementById("image");
 	var res_usr = document.getElementById("res_username");
 	var res_pass = document.getElementById("res_password");
 	var res_rt_pass = document.getElementById("res_rt_password");
 	var res_email = document.getElementById("res_email");
 	var res_image = document.getElementById("res_image");

 	function blur_usr() {
 		var result = security.check.username(user.value);
 		res_usr.innerHTML = result[0];
 	}

 	function blur_pass() {
 		blur_usr()
 		result = security.check.password(pass.value);
 		res_pass.innerHTML = result[0];
 	}

 	function blur_rt_pass() {
 		blur_usr()
 		result = security.check.rt_password(rt_pass.value, pass.value);
 		res_rt_pass.innerHTML = result[0];
 	}

  	function blur_email() {
  		blur_usr()
 		result = security.check.email(email.value);
 		res_email.innerHTML = result[0];
 	}

 	function handler() {
 		blur_usr();
 		blur_pass();
 		blur_email();
 		blur_rt_pass();
 	}

 	user.addEventListener("blur",blur_usr,false);
 	pass.addEventListener("blur",blur_pass,false);
 	rt_pass.addEventListener("blur",blur_rt_pass,false);
 	email.addEventListener("blur",blur_email,false);

