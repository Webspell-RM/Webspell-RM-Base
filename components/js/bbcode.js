 /* jshint ignore:start */
// jscs:disable

function MM_confirm(msg, url) { // v1.0
	if (confirm(msg)) location.replace(url);
}

function MM_jumpMenu(targ, selObj, restore) { //v3.0
	eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
	if (restore) selObj.selectedIndex = 0;
}

function MM_findObj(n, d) { //v4.01
	var p, i, x;
	if (!d) d = document;
	if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
		d = parent.frames[n.substring(p + 1)].document;
		n = n.substring(0, p);
	}
	if (!(x = d[n]) && d.all) x = d.all[n];
	for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
	for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
	if (!x && d.getElementById) x = d.getElementById(n);
	return x;
}

function MM_jumpMenuGo(selName, targ, restore) { //v3.0
	var selObj = MM_findObj(selName);
	if (selObj) MM_jumpMenu(targ, selObj, restore);
}
// jscs:enable
/* jshint ignore:end */


//Fehler anzeigen bei falscher Mail oder Passwort bei der Anmeldung!
// Initialize javascript language array
window.languageArray = {};

function loadLanguageModule(module) {
	"use strict";
	window.languageArray[module] = [];
	if (typeof window.calledfrom === "undefined") {
		fetch("getlang.php?modul=" + module + "&mode=array", "none", "execute", "event");
	} else if (window.calledfrom === "admin") {
		fetch("../getlang.php?modul=" + module + "&mode=array", "none", "execute", "event");
	}
}
$(document).ready(function() {
	"use strict";
	$("form[name=login]").submit(function(e) {
		var $this = $(this),
			$body = $("body"),
			postData = $this.serializeArray(),
			formURL = $this.attr("action"),
			$loginAlert = $("#ws-login-alert");
		e.preventDefault();
		$body.css("cursor", "progress");
		$.ajax({
			url: formURL,
			type: "POST",
			data: postData,
			success: function(data, textStatus, jqXHR) {
				$body.css("cursor", "default");
				// Data: return data from server
				if (data.state === "success") {
					$loginAlert.addClass("alert-success").removeClass("hidden").html(data.message);
					window.location.reload();
				} else {
					$loginAlert.addClass("alert-warning").removeClass("hidden").html(data.message);
					// Always clear password
					$this.find("input[name=password]").val("").focus();
					// Username wrong?
					if (data.code === "no_user") {
						$this.find("input[name=ws_user]").val("").focus();
					}
					window.setTimeout(

					function() {
						$loginAlert.addClass("hidden").removeClass("alert-warning");
					}, 5000);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$body.css("cursor", "default");
			}
		});
	});
	if ($("#shoutbox").length) {
		fetch("shoutbox_content.php", "shoutbox", "replace", "time", window.SHOUTBOX_REFRESH_TIME);
	}
});
