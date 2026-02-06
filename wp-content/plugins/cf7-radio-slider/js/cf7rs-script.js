(function($) {
    'use strict';

    $(document).ready(function() {
        // Transform CF7 radio groups into sliders
        // Target: .wpcf7-radio.cf7rs-target
        
        function initRadioSliders() {
            var processed = {};
            
            $('.wpcf7-radio.cf7rs-target').each(function() {
                var $radioGroup = $(this);
                var radioName = $radioGroup.find('input[type="radio"]').attr('name');
                
                if (!radioName || processed[radioName]) {
                    return;
                }
                processed[radioName] = true;
                
                var $inputs = $radioGroup.find('input[type="radio"]');
                if ($inputs.length === 0) {
                    return;
                }
                
                // Create slider wrapper
                var $sliderWrapper = $('<div class="cf7rs-radio-slider-wrapper"></div>');
                var $carousel = $('<div class="cf7rs-radio-carousel"></div>');
                
                // Create slides from each radio option
                $inputs.each(function(index) {
                    var $input = $(this);
                    var $label = $input.closest('label');
                    var labelText = $label.find('.wpcf7-list-item-label').text() || $label.text().trim();
                    var value = $input.val();
                    var inputId = radioName + '_cf7rs_' + index;
                    
                    var $slide = $('<div class="cf7rs-radio-slide"></div>');
                    var $titleEl = $('<h2 class="cf7rs-post-title"></h2>').text(labelText);
                    // radio input visible label text fixed to 'I want this house'
                    var $option = $('<label class="cf7rs-radio-label"><input type="radio" class="cf7rs-radio-option" name="cf7rs_' + radioName + '" value="' + value + '" data-value="' + value + '"> <span>I want this house</span></label>');

                    $slide.append($titleEl);
                    $slide.append($option);
                    $carousel.append($slide);

                    // Request featured image for this option (post title matches labelText in category 'Standalone')
                    if (typeof cf7rs_ajax !== 'undefined' && cf7rs_ajax.ajax_url) {
                        $.post(cf7rs_ajax.ajax_url, {
                            action: 'cf7rs_get_image',
                            title: labelText,
                            _ajax_nonce: cf7rs_ajax.nonce
                        }).done(function(resp) {
                            if (resp && resp.success && resp.data) {
                                    // If image exists, prepend it
                                    if (resp.data.url) {
                                        var $img = $('<img class="cf7rs-featured-image" alt="' + labelText + '">').attr('src', resp.data.url);
                                        $slide.prepend($img);
                                    }

                                    // If server returned a title, use it (otherwise labelText remains)
                                    if (resp.data.title) {
                                        $titleEl.text(resp.data.title);
                                    }

                                    // If excerpt HTML was returned, append it below the title
                                    if (resp.data.excerpt_html) {
                                        var $excerptWrap = $('<div class="cf7rs-excerpt"></div>').html(resp.data.excerpt_html);
                                        // insert after title
                                        $titleEl.after($excerptWrap);
                                    }

                                    // refresh slick height if initialized
                                    if ($carousel.hasClass('slick-initialized')) {
                                        $carousel.slick('setPosition');
                                    }
                                }
                        });
                    }
                });
                
                // Insert slider before radio group and hide original
                $radioGroup.after($sliderWrapper.append($carousel));
                $radioGroup.addClass('cf7rs-target');
                
                // Initialize Slick carousel
                $carousel.slick({
                    dots: true,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    adaptiveHeight: true
                });
                
                // Update radio when option clicked
                $carousel.on('change', '.cf7rs-radio-option', function() {
                    var value = $(this).val();
                    $inputs.prop('checked', false);
                    $inputs.filter('[value="' + value + '"]').prop('checked', true).change();
                    
                    // Move to correct slide
                    var slideIndex = $(this).closest('.cf7rs-radio-slide').index();
                    $carousel.slick('slickGoTo', slideIndex);
                    
                    // Update active state
                    $carousel.find('.cf7rs-radio-label').removeClass('active');
                    $(this).closest('.cf7rs-radio-label').addClass('active');
                });
                
                // Update active state on slide change
                $carousel.on('afterChange', function(event, slick, currentSlide) {
                    $carousel.find('.cf7rs-radio-label').removeClass('active');
                    $carousel.find('.cf7rs-radio-slide').eq(currentSlide).find('.cf7rs-radio-label').addClass('active');
                });
                
                // Update active state when radio changes
                $carousel.on('change', '.cf7rs-radio-option', function() {
                    $carousel.find('.cf7rs-radio-label').removeClass('active');
                    $(this).closest('.cf7rs-radio-label').addClass('active');
                });
                
                // Set initial active state based on which radio is checked
                var $checkedSliderRadio = $carousel.find('.cf7rs-radio-option:checked');
                if ($checkedSliderRadio.length) {
                    $checkedSliderRadio.closest('.cf7rs-radio-label').addClass('active');
                } else {
                    // Default: first slide is active visually, but no radio selected
                    $carousel.find('.cf7rs-radio-label').first().addClass('active');
                }
                
                // Keep slider in sync visually if CF7 value is set externally
                // But only move slide - don't select via dots
                var updateSlidePosition = function() {
                    var checkedCF7 = $inputs.filter(':checked');
                    if (checkedCF7.length) {
                        var value = checkedCF7.val();
                        var $matchingSliderRadio = $carousel.find('.cf7rs-radio-option[value="' + value + '"]');
                        if ($matchingSliderRadio.length) {
                            var slideIdx = $matchingSliderRadio.closest('.cf7rs-radio-slide').index();
                            $carousel.slick('slickGoTo', slideIdx);
                        }
                    }
                };
                
                // Sync if CF7 hidden radio value changes externally
                $inputs.on('change', updateSlidePosition);
            });
        }
        
        // Initialize on ready
        initRadioSliders();
        
        // Reinitialize after AJAX (for dynamic content)
        $(document).on('wpcf7submit', function() {
            setTimeout(function() {
                initRadioSliders();
            }, 500);
        });
    });

})(jQuery);
