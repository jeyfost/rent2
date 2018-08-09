function pointHover(line, text, action) {
	if(action === 1) {
		$("#" + line).css("background-color", "#ffca00");
		$("#" + text).css("color", "#ffca00");
	} else {
        $("#" + line).css("background-color", "transparent");
        $("#" + text).css("color", "#fff");
	}
}