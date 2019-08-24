$(document).ready(function(){
	$('.present-carousel').slick({
		infinite: false,
		autoplay: true,
		autoplaySpeed: 8000,
		slidesToShow: 5,
		slidesToScroll: 1,
		rows: 2,
		responsive: [
		  {
			breakpoint: 1024,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  infinite: true,
			}
		  },
		  {
			breakpoint: 600,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1,
			  infinite: true,
			}
		  },
		  {
			breakpoint: 480,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		  // You can unslick at a given breakpoint now by adding:
		  // settings: "unslick"
		  // instead of a settings object
		]
	  });
	
	
	// .slick({
	// 	autoplay: true,
	// 	autoplaySpeed: 8000,
	// 	draggable: false,
	// 	swipeToSlide: false,
	// 	touchMove: false,
	// 	swipe: false,
	// 	// slidesToShow: 5, // default desktop values
	// 	// slidesToScroll: 1,
	// 	rows: 2,
	// 	responsive: [
	// 		{
	// 			breakpoint: 1000, // tablet breakpoint
	// 			settings: {
	// 				slidesToShow: 5,
	// 				slidesToScroll: 1
	// 			}
	// 		},
	// 		{
	// 			breakpoint: 980, // tablet breakpoint
	// 			settings: {
	// 				slidesToShow: 3,
	// 				slidesToScroll: 1
	// 			}
	// 		},
	// 		{
	// 			breakpoint: 670, // mobile breakpoint
	// 			settings: {
	// 				slidesToShow: 1,
	// 				slidesToScroll: 1
	// 			}
	// 		}
	// 	]
	// });
});

