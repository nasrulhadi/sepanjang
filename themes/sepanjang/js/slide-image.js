/*
* Author:      Marco Kuiper (http://www.marcofolio.net/)
*/

// Speed of the automatic slideshow
var slideshowSpeed = 600000;

// Variable to store the images we need to set as background
// which also includes some text and url's.
var photos = [ {
		"author" : "UcenBang",
		"image" : "stump.jpg",
		"title" : "Duri Memecah Kharisma",
		"imageFrom" : "Sepanjang"
	}, {
		"author" : "UcenBang",
		"image" : "stump1.jpg",
		"title" : "Belahan Pohon Asmara",
		"imageFrom" : "Hutan Caruban?"
	}, {
		"author" : "UcenBang",
		"image" : "stump2.jpg",
		"title" : "Bunga di Sepanjang",
		"imageFrom" : "Sepanjang"
	}, {
		"author" : "UcenBang",
		"image" : "stump3.jpg",
		"title" : "Sunday Morning in Pabean",
		"imageFrom" : "Pabean Megapolitan"
	}, {
		"author" : "UcenBang",
		"image" : "stump4.jpg",
		"title" : "Bapak lagi Mancing",
		"imageFrom" : "Danau Juanda"
	}, {
		"author" : "UcenBang",
		"image" : "stump5.jpg",
		"title" : "Tempat Nembak Janda",
		"imageFrom" : "Danau Kenjhi"
	}, {
		"author" : "UcenBang",
		"image" : "stump6.jpg",
		"title" : "Kapal Bapak",
		"imageFrom" : "Pantai Ria Kenjhi"
	}, {
		"author" : "UcenBang",
		"image" : "stump7.jpg",
		"title" : "Cakrawala Membahana",
		"imageFrom" : "Langit Gusthi Allah SWT"
	}
];



$(document).ready(function() {
		
	// Backwards navigation
	$("#back").click(function() {
		stopAnimation();
		navigate("back");
	});
	
	// Forward navigation
	$("#next").click(function() {
		stopAnimation();
		navigate("next");
	});
	
	var interval;
	$("#control").toggle(function(){
		stopAnimation();
	}, function() {
		// Change the background image to "pause"
		//$(this).css({ "background-image" : "url(images/btn_pause.png)" });
		
		// Show the next image
		navigate("next");
		
		// Start playing the animation
		interval = setInterval(function() {
			navigate("next");
		}, slideshowSpeed);
	});
	
	
	var activeContainer = 1;	
	var currentImg = 0;
	var animating = false;
	var firstImg;
	var navigate = function(direction) {
		// Check if no animation is running. If it is, prevent the action
		if(animating) {
			return;
		}
		
		// Check which current image we need to show
		if(direction == "next") {
			currentImg++;
			if(currentImg == photos.length + 1) {
				currentImg = 1;
				firstImg = photos[currentImg - 1];
				var setStringFirst = firstImg.title + "<br> <em> @ " + firstImg.author + " / " + firstImg.imageFrom + " </em>";
				$(".get-popover-bg").attr('data-content',setStringFirst);
			}
		} else {
			currentImg--;
			if(currentImg == 0) {
				currentImg = photos.length;
			}
		}
		
		// Check which container we need to use
		var currentContainer = activeContainer;
		if(activeContainer == 1) {
			activeContainer = 2;
		} else {
			activeContainer = 1;
		}
		
		showImage(photos[currentImg - 1], currentContainer, activeContainer);
		
	};
	
	var currentZindex = -1;
	var showImage = function(photoObject, currentContainer, activeContainer) {
		animating = true;
		
		// Make sure the new container is always on the background
		currentZindex--;
		
		// Set the background image of the new active container
		$("#headerimg" + activeContainer).css({
			"background-image" : "url("+window.location.pathname+"themes/sepanjang/img/" + photoObject.image + ")",
			"display" : "block",
			"z-index" : currentZindex
		});
		
		// Hide the header text
		//$("#headertxt").css({"display" : "none"});
		
		// Set the new header text
		var setString = photoObject.title + "<br> <em> @ " + photoObject.author + " / " + photoObject.imageFrom + " </em>";
		$(".get-popover-bg").attr('data-content',setString);
		
		
		// Fade out the current container
		// and display the header text when animation is complete
		$("#headerimg" + currentContainer).fadeOut(function() {
			setTimeout(function() {
				$("#headertxt").css({"display" : "block"});
				animating = false;
			}, 500);
		});
	};
	
	var stopAnimation = function() {
		// Change the background image to "play"
		//$("#control").css({ "background-image" : "url(img/btn_play.png)" });
		
		// Clear the interval
		clearInterval(interval);
	};
	
	// We should statically set the first image
	navigate("next");
	
	// Start playing the animation
	interval = setInterval(function() {
		navigate("next");
	}, slideshowSpeed);
	
});