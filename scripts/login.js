function _(element) {
	return document.getElementById(element);
}

var loginButton = document.getElementById("btn-submit-login");
loginButton.addEventListener("click", collectData);

function collectData() {
    var myform = document.getElementById("login-form");
	var inputs = myform.getElementsByTagName("INPUT");
	var data = {};

	for (var i = inputs.length - 1; i >= 0; i--) {
		var key = inputs[i].name;

		switch(key) {
			case "username":
			data.username = inputs[i].value;
			break;
			
			case "password":
			data.password = inputs[i].value;
			break;
		}
	}

	sendData(data);
}// End collectData

function sendData(data) {
    
}// End sendData