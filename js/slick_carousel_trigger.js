$(document).ready(function(){
	$('.present-carousel').slick({
		autoplay: true,
		autoplaySpeed: 8000,
		// rows: 2,
		draggable: false,
		swipeToSlide: false,
		touchMove: false,
		swipe: false,
		slidesToShow: 5, // default desktop values
		slidesToScroll: 1,
		rows: 2,
		dots: true,
		arrows: true,
		responsive: [
			{
				breakpoint: 980, // tablet breakpoint
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 480, // mobile breakpoint
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
		]
	});
});

