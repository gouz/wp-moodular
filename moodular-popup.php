<script>
jQuery(document).ready(function() {
    jQuery(".insert-moo").click(function() {
    	var vitesse = parseFloat(jQuery('#vitesse').val().replace(',', '.')) * 1000;
    	var aleatoire = jQuery('#moodular-random:checked').val();
    	if( aleatoire==undefined )
    		aleatoire = '';
    	else { aleatoire = ' random="' + aleatoire + '"'; }
    	var shortcode_moodular = '[slider id="'+jQuery('#s-moodular').val()+'" v="'+vitesse+'" transition="'+jQuery('#s-transition').val()+'" ctrl="'+jQuery('#s-ctrl').val()+'" aff="'+jQuery('#s-aff').val()+'" '+aleatoire+']';
		var winmoo = window.dialogArguments || opener || parent || top;
		winmoo.send_to_editor(shortcode_moodular);
    });
});
</script>
<div style="display:none;" id="moodular-popup">
    <div id="moodular-help">
    <?php
    	$html = '<table class="form-table"><tbody>';
		$args = array (
			'post_type'              => 'moodular',
			'post_parent'            => 0,
			'pagination'             => false,
			'posts_per_page'         => '999',
			'orderby'                => 'menu_order',
		);
		$moodular = new WP_Query( $args );
		$moods = '<select id="s-moodular">';
		if ( $moodular->have_posts() ) {
			while ( $moodular->have_posts() ) {
				$moodular->the_post();
				$test = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'moodular'));
				$nb = count($test);
				if( $nb )
					$moods .= '<option value="'.get_the_ID().'">'.get_the_title().' ('.count($test).' images)</option>';
			}
		}
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