(function($) {
    'use strict';

    $(document).ready(function() {
        $('.crs-carousel').each(function() {
            var $carousel = $(this);
            var slideTitles = [];
            var slideData = $carousel.attr('data-slide-titles');
            
            if (slideData) {
                try {
                    slideTitles = JSON.parse(slideData);
                } catch (e) {
                    console.error('Error parsing slide titles:', e);
                    console.log('Raw data:', slideData);
                    slideTitles = [];
                }
            }
            
            var slickConfig = {
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true
            };
            
            // Add customPaging if we have slide titles
            if (slideTitles.length > 0) {
                slickConfig.customPaging = function(slider, index) {
                    var title = slideTitles[index] || (index + 1);
                    return '<button type="button">' + (title || ('Slide ' + (index + 1))) + '</button>';
                };
            }
            
            $carousel.slick(slickConfig);
        });
    });

})(jQuery);