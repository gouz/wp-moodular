/**
 * Moodular - Effect / Pongy
 * Copyright (c) 2014 Sylvain "GouZ" Gougouzian (sylvain@gougouzian.fr)
 * MIT (http://www.opensource.org/licenses/mit-license.php) licensed.
 * GNU GPL (http://www.gnu.org/licenses/gpl.html) licensed.
 */
(function($) {
	$.extend($.fn.moodular.effects, {
		pongy: function(m) {
			var addItems = function(indexFrom, indexTo, $to) {
					$('.pongied', $to).remove();
					$to.append(m.items.eq(indexFrom).clone().css({
						'opacity' : 1,
						'z-index' : 2
					}).addClass('pongied'))
					   .append(m.items.eq(indexTo).clone().css({
						'opacity' : 0,
						'z-index' : 1
					}).addClass('pongied'));
				},
				animIn = function($element) {
					$('.pongied',$element).eq(0).stop().animate({
						opacity: 0
					}, {
						duration : m.opts.speed,
						easing : m.opts.easing,
						queue : m.opts.queue,
						complete : function() {
							$(this).remove;
						}
					});
				},
				animOut = function($element) {
					$('.pongied', $element).eq(1).stop().animate({
						opacity: 1
					}, {
						duration : m.opts.speed,
						easing : m.opts.easing,
						queue : m.opts.queue,
						complete : function() {
							$(this).remove;
						}
					});
				};
			addItems(m.current - 1, m.current, m.opts.pongyLeft);
			addItems(m.current + 1, m.current + 2, m.opts.pongyRight);
			m.$element.on('moodular.prev moodular.next', function() {
				addItems((m.current - 1) % m.nbItems, (m.next - 1) % m.nbItems, m.opts.pongyLeft);
				addItems((m.current + 1) % m.nbItems, (m.next + 1) % m.nbItems, m.opts.pongyRight);
				animIn(m.opts.pongyLeft);
				animIn(m.opts.pongyRight);
				animOut(m.opts.pongyLeft);
				animOut(m.opts.pongyRight);
			});
		}
	});
})(window.jQuery);
