(function($) {
    'use strict';

    $(document).ready(function() {
        $('.crs-carousel').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    });

})(jQuery);