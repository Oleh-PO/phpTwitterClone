let loadPost;
let changeOrder;

document.addEventListener("DOMContentLoaded", function(event) { 
	const postContainer = document.querySelector(".postContainer");
	const xhttp     		= new XMLHttpRequest();

	let order = false;
	let ty 		= 0;

	changeOrder = function() {//chang list order(new > old)
		postContainer.innerHTML = "";

		order = !order;
		ty 		= 0;

		loadPost();
		ty++;
	}

	loadPost = function() {
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			postContainer.innerHTML += xhttp.response;
			ty++;
		}

		xhttp.open("GET", "/php/feed.php/?offset="+ty+"&order="+order+"&"+user);
		xhttp.send(); //ajax recuest to feed.php, respond whit post. chang post via postTemplate.php
	}

	const options = {
		root: null,
		rootMargin: "0px",
		threshold: 1.0,
	};

	const observer = new IntersectionObserver(loadPost, options);

	observer.observe(document.querySelector(".bottom"));
	document.documentElement.scrollTop = 0;//observer thet fires when scrold to bottom, load new posts
});
