<?php

class Moodular
{
  private $_version = 4.5;
  private $_effects = array();
  private $_controls = array();
  private $_displays = array();
  static public $instance = null;

  static public function getInstance()
  {
    if (self::$instance === null)
      self::$instance = new Moodular();
    return self::$instance;
  }

  public function __construct()
  {
      add_action('wp_enqueue_scripts', array($this, 'script'));
      add_action('media_buttons', array($this, 'adminMediaButton'), 11);
      add_action('admin_footer', array($this, 'adminPopup'));
      add_shortcode('moodular', array($this, 'shortCode'));
  }

  private function _add($type, $code, $label, $function = null, $js = null)
  {
    $this->{'_' . $type}[$code] = array(
      'moodular' => $code,
      'label' => $label,
      'function' => $function == null ? function($p) {} : $function,
      'js' => $js == null ? '' : $js
    );
    return $this;
  }

  public function get($type)
  {
    if (in_array($type, array('effects', 'controls', 'displays')))
      return $this->{'_' . $type};
    return false;
  }

  public function addEffect($code, $label)
  {
    return $this->_add('effects', $code, $label);
  }

  public function addControl($code, $label, $function, $js)
  {
    return $this->_add('controls', $code, $label, $function, $js);
  }

  public function addDisplay($code, $label, $function = null)
  {
    return $this->_add('displays', $code, $label, $function);
  }

  public function script()
  {
    global $post;
    if (!$post
      || !($post instanceof WP_Post)
      || strpos($post->post_content, '[moodular') === false
    )
      return;
    wp_enqueue_style('moodular', plugins_url('wp-moodular') . '/assets/css/moodular.min.css', array(), $this->_version);
    wp_enqueue_script('moodular', plugins_url('wp-moodular') . '/assets/js/moodular.min.js', array('jquery'), $this->_version);
  }

  public function adminMediaButton()
  {
    global $post;
    if (!$post || $post->post_type == 'moodular')
      return;
    $title = __('Insert slider', 'moodular');
    echo "<a title='{$title}'
      href='#TB_inline?width=640&height=500&inlineId=moodularPopup'
      class='thickbox button add_media'>
        <span class='dashicons dashicons-format-gallery'
          style='vertical-align: text-top; color: #888;'></span> $title</a>";
  }

  public function adminPopup()
  {
    include_once __DIR__ . '/popup.php';
  }

  public function shortCode($atts)
  {
    extract(shortcode_atts(array(
      'id'         => -1,
      'v'          => '500',
      'transition' => 1,
      'ctrl'       => 1,
      'aff'        => 1,
      'random'     => 0
    ), $atts));
    return $this->generate($id, $v, $transition, $ctrl, $aff, $random);
  }

  public function generate($id, $v = 5000, $transition = 1, $ctrl = 1, $aff = 1, $random = 0)
  {
    $elements = '';
    $moodular_id = 'moodular_' . uniqid();
    $ordre = $random ? 'rand' : 'menu_order';
    $myposts = get_posts(array(
      'post_type' => 'moodular',
      'orderby' => $ordre,
      'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => 'moodular_category',
          'field' => 'id',
          'terms' => $id
        )
      )
    ));
    foreach ($myposts as $post)
    {
      $attributes = array();
      $attributes = apply_filters('moodular_item_attributes', $attributes, $post);
      $attributes_string = '';
      if (is_array($attributes))
        foreach ($attributes as $attribute_key => $attribute_value)
          $attributes_string .= ' ' . $attribute_key . '="' . esc_attr($attribute_value) . '"';
      if (isset($this->_displays[$aff]))
        $elements .= '<li'.$attributes_string.'>' . $this->_displays[$aff]['function']($post) . '</li>';
    }
    wp_reset_postdata();
    return '
      <div id="' . $moodular_id . '" class="moodular ' . $aff . '">
        <ul class="moodular-wrapper">' . $elements . '</ul>
        ' . $this->_controls[$ctrl]['function'] . '
      </div>
      <script>
        (function($) {
          $(document).ready(function(){
            var $moodular = $("#' . $moodular_id . '");
            $(".moodular-wrapper", $moodular).moodular({
              effects: "' . $transition . ' resize",
              controls: "' . $ctrl . '",
              speed: 500,
              timer: ' . (int) $v . ',
              ' . trim($this->_controls[$ctrl]['js'], ',') . ',
              calcHeight: true
            });
          });
        })(window.jQuery);
      </script>
    ';
  }
}
