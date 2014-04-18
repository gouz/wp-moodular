/**
 * Moodular - Effect / Resize
 * Copyright (c) 2014 Sylvain "GouZ" Gougouzian (sylvain@gougouzian.fr)
 * MIT (http://www.opensource.org/licenses/mit-license.php) licensed.
 * GNU GPL (http://www.gnu.org/licenses/gpl.html) licensed.
 */
(function($){
	$.extend($.fn.moodular.effects, {
		resize: function (m) {
			if (typeof m.opts.ratio === 'undefined')
				m.opts.ratio = 0;
			if (m.opts.ratio)
				$(window).on('resize.moodular', function () {
					m.$element.height(parseInt(m.$element.width()) / m.opts.ratio);
				}).trigger('resize.moodular');
		}
	});
})(window.jQuery);
