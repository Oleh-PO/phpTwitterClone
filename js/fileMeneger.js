const copy = function(link) {
	navigator.clipboard.writeText(link); //copy in clipboard
}
const edit = function(p) { //edit switch
	let textarea = document.querySelector("#" + p.id + " textarea");
	let submit	 = document.querySelector("#" + p.id + " input");

	textarea.disabled = !textarea.disabled;

	if (submit.style.display) {
		submit.style.display = "";
	} else {
		submit.style.display = "none";
	}
}