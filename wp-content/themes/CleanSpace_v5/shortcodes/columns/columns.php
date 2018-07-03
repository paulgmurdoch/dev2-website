<?php

function cs_column($atts, $content = null, $code) 
{
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}

function cs_column_last($atts, $content = null, $code) 
{
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clearboth"></div>';
}

// Normal Columns

add_shortcode('one_half', 'cs_column'); // 
add_shortcode('one_third', 'cs_column'); //
add_shortcode('one_fourth', 'cs_column'); //
add_shortcode('one_fifth', 'cs_column'); //
add_shortcode('one_sixth', 'cs_column'); //

add_shortcode('two_third', 'cs_column'); //
add_shortcode('three_fourth', 'cs_column'); //
add_shortcode('two_fifth', 'cs_column'); //
add_shortcode('three_fifth', 'cs_column'); //
add_shortcode('four_fifth', 'cs_column'); //
add_shortcode('five_sixth', 'cs_column'); //

// Last Columns

add_shortcode('one_half_last', 'cs_column_last'); //
add_shortcode('one_third_last', 'cs_column_last'); //
add_shortcode('one_fourth_last', 'cs_column_last'); //
add_shortcode('one_fifth_last', 'cs_column_last'); //
add_shortcode('one_sixth_last', 'cs_column_last'); //

add_shortcode('two_third_last', 'cs_column_last'); //
add_shortcode('three_fourth_last', 'cs_column_last'); //
add_shortcode('two_fifth_last', 'cs_column_last'); //
add_shortcode('three_fifth_last', 'cs_column_last'); //
add_shortcode('four_fifth_last', 'cs_column_last'); //
add_shortcode('five_sixth_last', 'cs_column_last'); //

?>