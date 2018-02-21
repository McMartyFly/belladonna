

	$(document).ready(function () {
		$(document).on("scroll", onScroll);

		$('a[href^="#"]').on('click', function (e) {
			e.preventDefault();
			$(document).off("scroll");

			$('a').each(function () {
				$(this).removeClass('navactive');
			})
			$(this).addClass('navactive');

			var target = this.hash;
			$target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top+2
			}, 500, 'swing', function () {
				window.location.hash = target;
				$(document).on("scroll", onScroll);
			});
		});

		$('.atg-button').on('click', function(){
			console.log('nerpl');
		});

		$(function() {
			//----- OPEN
			$('[data-popup-open]').on('click', function(e)  {
			var targeted_popup_class = jQuery(this).attr('data-popup-open');
			$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
			e.preventDefault();
			$('body').addClass('noscroll');
			});
			//----- CLOSE
			$('[data-popup-close]').on('click', function(e)  {
			var targeted_popup_class = jQuery(this).attr('data-popup-close');
			$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
			e.preventDefault();
			$('body').removeClass('noscroll');
			});
		});



	});

	function onScroll(event){
		var scrollPosition = $(document).scrollTop();
		$('.nav li a').each(function () {
			var currentLink = $(this);
			var refElement = $(currentLink.attr("href"));
			if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {
				$('ul.nav li a').removeClass("navactive");
				currentLink.addClass("navactive");
			}
			else{
				currentLink.removeClass("navactive");
			}
		});


        // $(function(){
        //     $('#portfolio').mixitup({
        //         targetSelector: '.item',
        //         transitionSpeed: 350
        //     });
        // });
        //
        //   $(function() {
        //     $( "#datepicker" ).datepicker();
        // });

    };
