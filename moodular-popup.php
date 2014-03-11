<script>
(function($){
	$(document).ready(function() {
	    $(".insert-moo").click(function() {
	    	var vitesse = parseFloat($('#vitesse').val().replace(',', '.')) * 1000,
	    		aleatoire = (typeof $('#moodular-random:checked').val() == 'undefined' ? '' : ' random="' + aleatoire + '"'),
	    		shortcode_moodular = '[slider id="'+$('#s-moodular').val()+'" v="'+vitesse+'" transition="'+$('#s-transition').val()+'" ctrl="'+$('#s-ctrl').val()+'" aff="'+$('#s-aff').val()+'" '+aleatoire+']',
				winmoo = window.dialogArguments || opener || parent || top;
			winmoo.send_to_editor(shortcode_moodular);
	    });
	});
})(window.jQuery);
</script>
<div style="display:none;" id="moodular-popup">
    <div id="moodular-help">
    <?php
    	$html = '<table class="form-table"><tbody>';
		$args = array (
			'post_type'      => 'moodular_category',
		);
		
		$moodulars = get_categories(array('taxonomy' => 'moodular_category'));
		$moods = '<select id="s-moodular">';
		if ( !empty($moodulars) )
			foreach ( $moodulars as $moodular )
				$moods .= '<option value="'.$moodular->term_id.'">'.$moodular->name.' ('.$moodular->count.' images)</option>';
		$moods .= '</select>';
		wp_reset_postdata();

    	$html .= '<tr valign="top"><th width="33%" scope="row">Sélectionnez votre slider</th>';
		$html .= '<td>'.$moods.'</td></tr>';
    	
    	$html .= '<tr valign="top"><th width="33%" scope="row">Vitesse</th>';
		$html .= '<td><input id="vitesse" type="text" class="small-text" value="4" /> secondes (0 pour fonctionnement manuel)</td></tr>';
    	
    	$html .= '<tr valign="top"><th width="33%" scope="row">Transition</th>';
		$html .= '<td><select id="s-transition"><option value="1">fondu</option><option value="2">slide à gauche</option></select></td></tr>';
    	
    	$html .= '<tr valign="top"><th width="33%" scope="row">Contrôles</th>';
		$html .= '<td><select id="s-ctrl"><option value="1">Flèches</option><option value="2">Puces</option></select><!-- <option value="3">Miniatures</option> --></td></tr>';
    	
    	$html .= '<tr valign="top"><th width="33%" scope="row">Afficher</th>';
		$html .= '<td><select id="s-aff"><option value="1">Image uniquement</option><option value="2">Image et titre</option><option value="3">Image, titre et texte</option></select></td></tr>';
    	
    	$html .= '<tr valign="top"><th width="33%" scope="row">Ordre</th>';
		$html .= '<td><label for="moodular-random"><input type="checkbox" value="1" id="moodular-random" name="moodular-random"> aléatoire</label></td></tr>';
		
		$html .= '</tbody></table><p class="submit"><button class="button button-primary button-large insert-moo">Insérer le slider</button></p>';
        echo $html;
    ?>
    </div>
</div>