function formatTime(time) {
	var m = Math.floor(time/60),
	    s = Math.floor(time - m * 60 ),
	    t;

	if (s < 10) {
        t = "0" + m + ":" + "0" + s;
	} else {
		t = "0" + m + ":" + s;
	}
	return t;
}

module.exports = formatTime;