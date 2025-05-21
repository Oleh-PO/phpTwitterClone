let loadPost;
let changeOrder;

document.addEventListener("DOMContentLoaded", function(event) { 
	const postContainer = document.querySelector(".postContainer");
	const xhttp     		= new XMLHttpRequest();

	let order = false;
	let ty 		= 0;

	changeOrder = function() {//chang list order(new > old)
		postContainer.innerHTML = "";
		document.querySelector(".sortButton").classList.toggle("sortTrue");

		order = !order;
		ty 		= 0;
	}

	loadPost = function(entries) {
		if (entries[0].isIntersecting) {
			const xhttp = new XMLHttpRequest();

			xhttp.onload = function() {
				if (xhttp.response) {
					postContainer.innerHTML += xhttp.response;
					ty++;
				}
			}

			xhttp.open("GET", "/php/feed.php/?offset="+ty+"&order="+order+"&"+userId);
			xhttp.send(); //ajax recuest to feed.php, respond whit post. chang post via postTemplate.php
		}
	}

	const options = {
		root: null,
		rootMargin: "0px",
		threshold: 1,
	};

	const observer = new IntersectionObserver(loadPost, options);

	// observer.observe(document.querySelector(".bottom"));//observer fires when scrold to bottom -> load new posts
	document.documentElement.scrollTop = 0;
});

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

	fetch("/php/edit.php", {
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
	fetch("/php/delete.php", {
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

const r = document.querySelector(':root');

const toggleTheme = function(toggle) {
  if (toggle) {
    r.style.setProperty('--themeWhite', '#201c25');
    r.style.setProperty('--textColor', '#ececec');
    r.style.setProperty('--mainColor', '#2e2c4b');
  } else {
    r.style.removeProperty('--themeWhite');
    r.style.removeProperty('--textColor');
    r.style.removeProperty('--mainColor');
  }
  fetch("/php/theme.php/?toggleTheme="+toggle);
}
// document.addEventListener("DOMContentLoaded", function(event) {
//   toggleTheme(theme.checked);
// });
