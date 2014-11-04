<?php
Moodular::getInstance()
  ->addControl('buttons', __('Arrows', 'moodular'))
  ->addControl('pagination', __('Pagination', 'moodular'))
  ->addEffect('fade', __('Fading', 'moodular'))
  ->addEffect('left', __('Left movement', 'moodular'))
  ->addEffect('top', __('Top movement', 'moodular'))
  ->addDisplay('moodular-images', __('Just images', 'moodular'))
  ->addDisplay('moodular-images_title', __('Images + Titles', 'moodular'))
  ->addDisplay('moodular-full', __('Full', 'moodular'))
;
