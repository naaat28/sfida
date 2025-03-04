<?php

add_action('wp_enqueue_scripts', 'add_styles');

function add_styles()
{


  // CSS
  // Reset style
  wp_enqueue_style(
    'reset_css',
    get_template_directory_uri() . '/src/css/reset.css',
    array(),
    '1.0'
  );

  // Main style
  wp_enqueue_style(
    'main_css',
    get_template_directory_uri() . '/src/css/main.css',
    array('reset_css'),
    '1.0'
  );

  // Swiper style
  wp_enqueue_style(
    'swiper_style',
    'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
    array(),
    '1.0'
  );

  // JavaScript
  wp_enqueue_script('swiper_js', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array(), '8.0', true);
  wp_enqueue_script('main-script', get_template_directory_uri() . '/src/js/main.js', array('swiper_js'), '1.0', true);


  if (is_page('contact')) {
    wp_enqueue_script('privacy_mail_script', get_template_directory_uri() . '/src/js/contact.js', array(), '1.0', true);
  }
  if (is_page('404')) {
    wp_enqueue_script('privacy_line_script', get_template_directory_uri() . '/src/js/404.js', array(), '1.0', true);
  }
}
?>


<!-- svg -->
<?php
function custom_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');
?>


<?php
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false() {
return false;
}
?>