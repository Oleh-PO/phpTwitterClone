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

	observer.observe(document.querySelector(".bottom"));//observer fires when scrold to bottom -> load new posts
	document.documentElement.scrollTop = 0;
});
