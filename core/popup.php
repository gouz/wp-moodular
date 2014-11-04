<script>
  (function($) {
    $(document).ready(function() {
      $(".insert-moo").on('click', function() {
        var vitesse = parseFloat($('#vitesse').val().replace(',', '.')) * 1000,
          aleatoire = $('#moodular-random:checked').length ? ' random="1"' : '',
          shortcode_moodular = '[moodular id="'
            + $('#s-moodular').val()
            + '" v="' + vitesse
            + '" transition="' + $('#s-transition').val()
            + '" ctrl="' + $('#s-ctrl').val()
            + '" aff="' + $('#s-aff').val() + '" '
            + aleatoire + ']',
          winmoo = window.dialogArguments || opener || parent || top;
        winmoo.send_to_editor(shortcode_moodular);
      });
    });
  })(window.jQuery);
</script>
<div style="display:none;" id="moodularPopup">
  <div id="moodular-help">
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th width="20%" scope="row">
            <?php _e('Sélectionnez votre slider', 'moodular'); ?>
          </th>
          <td>
            <select id="s-moodular">
              <?php
                $moodulars = get_categories( array(
                  'taxonomy' => 'moodular_category'
                ) );
                if (!empty($moodulars))
                  foreach ($moodulars as $moodular)
                    echo '<option value="' . $moodular->term_id . '">'
                      . $moodular->name
                      . ' (' . $moodular->count . ' images)</option>';
                wp_reset_postdata();
              ?>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th width="20%" scope="row"><?php _e('Vitesse', 'moodular'); ?></th>
          <td>
            <input id="vitesse" type="text" class="small-text" value="4" />
            <?php _e('seconde(s) (0 pour fonctionnement manuel)', 'moodular'); ?>
          </td>
        </tr>
        <tr valign="top">
          <th width="20%" scope="row"><?php _e('Transition', 'moodular'); ?></th>
          <td>
            <select id="s-transition">
              <?php
                $effects = Moodular::getInstance()->get('effects');
                foreach ($effects as $k => $v)
                  echo '<option value="' . $k . '">' . $v['label'] . '</option>';
              ?>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th width="20%" scope="row"><?php _e('Contrôles', 'moodular'); ?></th>
          <td>
            <select id="s-ctrl">
              <?php
                $controls = Moodular::getInstance()->get('controls');
                foreach ($controls as $k => $v)
                  echo '<option value="' . $k . '">' . $v['label'] . '</option>';
              ?>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th width="20%" scope="row"><?php _e('Affichage', 'moodular'); ?></th>
          <td>
            <select id="s-aff">
              <?php
                $displays = Moodular::getInstance()->get('displays');
                foreach ($displays as $k => $v)
                  echo '<option value="' . $k . '">' . $v['label'] . '</option>';
              ?>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th width="33%" scope="row"><?php _e('Ordre', 'moodular'); ?></th>
          <td>
            <label for="moodular-random"><input type="checkbox" value="1" id="moodular-random"> aléatoire</label>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit">
      <button class="button button-primary button-large insert-moo"><?php _e('Insérer le slider', 'moodular'); ?></button>
    </p>
  </div>
</div>
