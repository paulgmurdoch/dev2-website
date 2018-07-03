<?php

// Enqueue the GMAP Script


function cs_like($atts, $content = null, $code) 
{
	extract(shortcode_atts(array(
		"url" => '',
		"width" => '450',
		"height" => '60',
	), $atts));
	
		return <<<HTML
[raw]
<iframe src="http://www.facebook.com/plugins/like.php?href=$url&amp;layout=standard&amp;show_faces=true&amp;width=$width&amp;action=like&amp;colorscheme=light&amp;locale=en_US"  style="border: none;  width: {$width}px; height: {$height}px;"></iframe>
[/raw]
HTML;

}

add_shortcode('like','cs_like');