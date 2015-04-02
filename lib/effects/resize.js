/**
 * Moodular - Effect / Resize
 * Copyright (c) 2014 Sylvain "GouZ" Gougouzian (sylvain@gougouzian.fr)
 * MIT (http://www.opensource.org/licenses/mit-license.php) licensed.
 * GNU GPL (http://www.gnu.org/licenses/gpl.html) licensed.
 */
(function($){
	$.extend($.fn.moodular.effects, {
		resize: function (m) {
			var $img = $('img:first', m.$element);
			if (typeof m.opts.calcHeight != 'undefined' && m.opts.calcHeight)
				m.opts.ratio = parseInt($img.attr('width')) / parseInt($img.attr('height'));
			if (typeof m.opts.ratio == 'undefined')
				m.opts.ratio = 0;
			m.resTimer = null;
			$(window).on('resize.moodular', function () {
				clearTimeout(m.resTimer);
				m.resTimer = setTimeout(function() {
					if (m.opts.ratio) {
						var h = parseInt(m.$element.width()) / m.opts.ratio;
						m.$element.height(h);
						m.items.height(h);
					}
				}, 100);
			}).trigger('resize.moodular');
		}
	});
})(window.jQuery);
