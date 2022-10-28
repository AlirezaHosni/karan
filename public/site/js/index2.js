
    $(document).ready(function() {


        if ($('.bbb_viewed_slider').length) {
            var viewedSlider = $('.bbb_viewed_slider');

            viewedSlider.owlCarousel({
                loop: true,
                margin: 30,
                autoplay: false,
                autoplayTimeout: 6000,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    575: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    991: {
                        items: 4
                    },
                    1199: {
                        items: 4
                    }
                }
            });

            if ($('.bbb_viewed_prev').length) {
                var prev = $('.bbb_viewed_prev');
                prev.on('click', function() {
                    viewedSlider.trigger('prev.owl.carousel');
                });
            }

            if ($('.bbb_viewed_next').length) {
                var next = $('.bbb_viewed_next');
                next.on('click', function() {
                    viewedSlider.trigger('next.owl.carousel');
                });
            }
        }


    });


    $(document).ready(function() {
        // executes when HTML-Document is loaded and DOM is ready

        // breakpoint and up
        $(window).resize(function() {
            if ($(window).width() >= 980) {

                // when you hover a toggle show its dropdown menu
                $(".navbar .dropdown-toggle").hover(function() {
                    $(this).parent().toggleClass("show");
                    $(this).parent().find(".dropdown-menu").toggleClass("show");
                });

                // hide the menu when the mouse leaves the dropdown
                $(".navbar .dropdown-menu").mouseleave(function() {
                    $(this).removeClass("show");
                });

                // do something here
            }
        });



        // document ready
    });
