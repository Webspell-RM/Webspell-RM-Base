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
