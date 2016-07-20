function statusCheck() {
	$.getJSON('RF.php?token=' + $_GET('token'), function (data) {
		var elementDisable, elementEnable;
		for (i = 1; i <= 7; i++) {
			if (data[i] == 0) {
				elementDisable = document.getElementById(i + "on");
				elementEnable = document.getElementById(i + "off");
			}
			else if (data[i] == 1) {
				elementDisable = document.getElementById(i + "off");
				elementEnable = document.getElementById(i + "on");
			}
			if (elementDisable.classList.contains("btn-primary")) {
				elementDisable.classList.remove("btn-primary");
				if (!elementDisable.classList.contains("btn-default")) {
					elementDisable.classList.add("btn-default");
				}
			}
			if (elementEnable.classList.contains("btn-default")) {
				elementEnable.classList.remove("btn-default");
				if (!elementEnable.classList.contains("btn-primary")) {
					elementEnable.classList.add("btn-primary");
				}
			}
		}
	});
	setTimeout(function () {
		statusCheck();
	}, 5000);
}

function $_GET(name, url) {
	"use strict";
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)")
		, results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
}
var toggleOutlet = function (buttonClicked) {
	var id = buttonClicked.attr('data-outletId');
	var powerStatus = buttonClicked.attr('data-outletStatus');
	$.get('RF.php', {
		outletId: id
		, outletStatus: powerStatus
		, token: $_GET('token')
	}, function (data, status) {
		statusCheck()
	});
};
$(function () {
	$('.toggleOutlet').click(function () {
		toggleOutlet($(this));
	});
});