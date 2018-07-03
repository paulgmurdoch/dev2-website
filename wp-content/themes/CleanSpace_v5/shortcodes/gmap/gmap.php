<?php

//Google Maps Shortcode

function gsm_google_static_map_shortcode($atts){

  $args = shortcode_atts(array(

    'center' => '41.88,-87.63',
    'zoom' => '14',
    'size' => '240x370',
    'scale' => '1',
    'sensor' => 'false',
    'maptype' => 'roadmap',
    'format' => 'png',
    'markers' => $atts['center']    

  ), $atts );

  $map_url = '<img src="http://maps.googleapis.com/maps/api/staticmap?';

  foreach($args as $arg => $value){

    $map_url .= $arg . '=' . urlencode($value) . '&';

  }

  $map_url .= '"/>';

 
return '<div class="map-frame">' . $map_url . '</div>';
}

add_shortcode('gmap', 'gsm_google_static_map_shortcode');  
?>