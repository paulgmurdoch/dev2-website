<?php
/*
Plugin Name: 5sec Search Autocomplete
Plugin URI: http://5sec-search-autocomplete.webfactoryltd.com/
Description: Adds autocomplete functionality to native WordPress search fields. Autocomplete suggestions are generated from previous search queries - local and from search engines (Google, Bing, Yahoo, Lycos, Altavista).
Author: Web factory Ltd
Version: 1.0
Author URI: http://www.webfactoryltd.com/
*/

// **********************************
// !! DO NOT TOUCH BELOW THIS LINE !!
// **********************************

  require dirname( __FILE__ ) . '/wf-sa-class.php';

  // hook our thing
  register_activation_hook(__FILE__, array('wf_sa', 'activate'));
  add_action('init', array('wf_sa', 'init'));
?>