<?php
Moodular::getInstance()
  ->addEffect('fade', __('Fading', 'moodular'))
  ->addEffect('left', __('Left movement', 'moodular'))
  ->addEffect('top', __('Top movement', 'moodular'))
  ->addControl('buttons', __('Arrows', 'moodular'),
    '<a class="moodular-btnLeft"></a><a class="moodular-btnRight"></a>',
    'buttonPrev : $(".moodular-btnLeft", $moodular), buttonNext: $(".moodular-btnRight", $moodular)'
  )
  ->addControl('pagination', __('Pagination', 'moodular'),
    '<ul class="moodular-pagination"></ul>',
    'pagination: $(".moodular-pagination", $moodular)'
  )
  ->addDisplay('moodular-images', __('Just images', 'moodular'), function($p) {
    return get_the_post_thumbnail($p->ID, 'full');
  })
  ->addDisplay('moodular-images_title', __('Images + Titles', 'moodular'), function($p) {
    return get_the_post_thumbnail($p->ID, 'full')
      . '<span class="moodular-title">' . $p->post_title . '</span>';
  })
  ->addDisplay('moodular-full', __('Full', 'moodular'), function($p) {
    return get_the_post_thumbnail($p->ID, 'full')
      . '<span class="moodular-title">' . $p->post_title . '</span>'
      . '<div class="moodular-description">' . $p->post_content . '</div>';
  })
;
