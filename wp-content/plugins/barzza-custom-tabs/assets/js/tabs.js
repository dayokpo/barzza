/**
 * Barzza Tabs JavaScript
 */

(function($) {
	'use strict';

	$(document).ready(function() {
		// Tab button click handler
		$('.barzza-tab-button').on('click', function(e) {
			e.preventDefault();

			var tabId = $(this).data('tab-id');
			var contentId = 'barzza-tab-content-' + tabId.replace('barzza-tab-', '');

			// Remove active class from all buttons and contents
			$('.barzza-tab-button').removeClass('active').attr('aria-selected', 'false');
			$('.barzza-tab-content').removeClass('active');

			// Add active class to clicked button and corresponding content
			$(this).addClass('active').attr('aria-selected', 'true');
			$('#' + contentId).addClass('active');

			// Optional: Scroll to tabs
			$('html, body').animate({
				scrollTop: $('.barzza-tabs-wrapper').offset().top - 100
			}, 300);
		});

		// Keyboard navigation (arrow keys)
		$('.barzza-tab-button').on('keydown', function(e) {
			var $buttons = $('.barzza-tab-button');
			var currentIndex = $buttons.index(this);
			var $targetButton;

			if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
				e.preventDefault();
				$targetButton = $buttons.eq((currentIndex + 1) % $buttons.length);
			} else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
				e.preventDefault();
				$targetButton = $buttons.eq((currentIndex - 1 + $buttons.length) % $buttons.length);
			}

			if ($targetButton && $targetButton.length) {
				$targetButton.trigger('click').focus();
			}
		});
	});
})(jQuery);
