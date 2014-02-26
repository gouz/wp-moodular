<?php
/**
 * Plugin Name: Moodular
 * Plugin URI: http://www.gougouzian.fr/projects/jquery/moodular/
 * Description: Moodular
 * Version: 0.1
 * Author: Gouz
 * Author URI: http://www.gougouzian.fr/
 * License: MIT
 */


function add_moodular_button() {
	$popup_url = 'moodular-popup';
	$title = 'Insérer un diaporama dans la page';

	$bt = "<a title='{$title}' href='#TB_inline?width=640&height=650&inlineId={$popup_url}' class='thickbox button add_media' style='padding-left: 0px; padding-right: 0px;' title='{$title}'> <img src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjIwcHgiIGhlaWdodD0iMjBweCIgdmlld0JveD0iMCAwIDIwIDIwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMCAyMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGcgaWQ9IkNhbHF1ZV8xIj48cmVjdCB4PSI2IiB5PSI3IiBmaWxsPSJub25lIiBzdHJva2U9IiMwMDAwMDAiIHN0cm9rZS13aWR0aD0iMS43MzA3IiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHdpZHRoPSI4IiBoZWlnaHQ9IjYiLz48L2c+PGcgaWQ9IkNhbHF1ZV8yIj48cG9seWdvbiBwb2ludHM9IjMuNywxMi42IDEsOS45IDMuNyw3LjMgIi8+PHBvbHlnb24gcG9pbnRzPSIxNi4zLDEyLjYgMTksOS45IDE2LjMsNy4zICIvPjwvZz48L3N2Zz4=' style='height: 20px; position: relative; top: -2px;'></a>";

	echo $bt;
}
add_action('media_buttons', 'add_moodular_button', 11);



function moodular_popup() {
	include('moodular-popup.php');
}
add_action('admin_footer', 'moodular_popup');
