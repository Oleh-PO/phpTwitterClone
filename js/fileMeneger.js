const copy = function(link) {
	if (window.location.protocol === 'https:') {
		navigator.clipboard.writeText(link); //copy in clipboard
	} else {
		alert("use https!");
	}
};

const edit = function(p) { //edit switch
	const textarea = document.querySelector("#" + p.id + " textarea");
	const submit	 = document.querySelector("#" + p.id + " button");

	textarea.disabled = !textarea.disabled;

	if (submit.style.display) {
		submit.style.display = "";
	} else {
		submit.style.display = "none";
	}
};

const editRecuest = function(p) {//make fatch recuest to edit.php
	const textData = document.querySelector("#" + p.id + " textarea").value;

	fetch("/php/user/edit.php", {
	  method: "POST",
	  headers: {
			"Content-Type": "application/json",
	  },
	  body: JSON.stringify({
	  	id: p.id,
	  	content: textData,
	  }),
	});

	edit(p);
};

const deletePost = function(p) {
	fetch("/php/user/delete.php", {
	  method: "POST",
	  headers: {
			"Content-Type": "application/json",
	  },
	  body: JSON.stringify({
	  	id: p,
	  }),
	});

	document.querySelector("#p" + p).parentNode.style.display = "none";
};
