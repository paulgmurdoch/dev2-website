<?php

	function postrecap($atts, $content = null, $code) {
			return '<blockquote><q><span>'. do_shortcode($content) .'</span></q></blockquote><br/>';
}
add_shortcode('quote', 'postrecap');

?>