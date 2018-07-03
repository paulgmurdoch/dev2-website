<?php
if(preg_match('@' . basename(__FILE__) . '@', $_SERVER['PHP_SELF'])) {
  die('Don\'t do that!');
}

if(!class_exists('wf_sa')) {
class wf_sa {
  public function init() {   
    // add option to settings - writing and register settings
    if (is_admin()) {
      add_action('admin_menu', array('wf_sa', 'admin_menu'));
      add_action('admin_init', array('wf_sa', 'register_settings'));
      add_action('plugin_action_links_' . basename(dirname(__FILE__)) . '/' . '5sec-search-autocomplete.php', array('wf_sa', 'plugin_action_links'));
    } else {
      add_action('template_redirect', array('wf_sa', 'include_css_js'));
      add_action('wp_footer', array('wf_sa', 'wp_footer'));
    }
    
    // log searches
    add_action('get_header', array('wf_sa', 'log_search'), 99);
  } // init
  
  // add settings link to plugins page
  function plugin_action_links($links) {
    $settings_link = '<a href="options-general.php?page=wf-sa">Settings</a>';
    array_unshift($links, $settings_link);

    return $links;
  } // plugin_action_links
  
  // create the admin menu item
  function admin_menu() {
    add_options_page('5sec Search Autocomplete', '5sec Search Autocomplete', 'manage_options', 'wf-sa', array('wf_sa', 'options_page'));
  } // admin_menu
  
  // all settinga are saved in one option
  function register_settings() {
    register_setting('wf_sa', 'wf_sa', array('wf_sa', 'sanitize_settings'));
  } // register_settings

  // include necessary JS/CSS files in frontend header/footer
  function include_css_js() {
     $options = get_option('wf_sa');
        
    if ($options['theme']) {
      $css_file = plugins_url('/css/' . $options['theme'] . '/jquery-ui-1.8.9.custom.css', __FILE__);
      wp_register_style('wf-sa-ui-css', $css_file, array(), '1.8.9', 'screen');
      wp_enqueue_style('wf-sa-ui-css');
    }
  
    if ($options['include_jquery']) {
      wp_enqueue_script('jquery');
    }
  
    if ($options['include_ui_js']) {
      $js_file = plugins_url('/js/jquery-ui-1.8.9.custom.min-autocomplete.js', __FILE__);
      wp_enqueue_script('wf-sa-ui-js', $js_file, array(), '1.8.9', true);
    }
  } // include_css_js
  
  // autocomplete JS code for footer
  function wp_footer() {
    $options = get_option('wf_sa');
    $ajax_endpoint = str_replace("'", "\\'", plugins_url('wf-sa-ajax.php', __FILE__));
    $input = str_replace("'", "\\'", $options['input_selector']);
    $onselect = '';
    
    if ($options['onselect']) {
      $onselect = "select: function(event, ui) { jQuery(this).val(ui.item.value).closest('form').submit(); },";
    }
    
    echo '<script type="text/javascript">' . "\n";
    echo 'jQuery(document).ready(function() {';
    echo "jQuery('" . $input . "').autocomplete({
              {$onselect}
              source: '" . $ajax_endpoint . "', 
              minLength: " . $options['min_length'] . ",
              html: true,
              delay: " . $options['delay'] . "});";
    echo "\n});";
    echo "\n</script>\n";
  } // wp_footer
  
  // sanitize settings on save
  function sanitize_settings($values) {
    $del_new_keywords = false;
    
    foreach ($values as $key => $value) {
      switch ($key) {
        case 'theme':
        case 'order':
        case 'mask':
        break;
        case 'suggestions_nb':
        case 'delay':
        case 'min_length':
          $values[$key] = (int) $value;
        break;
        case 'input_selector':
          $values[$key] = trim($value);
        break;
        case 'onselect':
        case 'log_local':
        case 'log_se':
        case 'include_jquery':
        case 'include_ui_js':
        case 'include_ui_css':
          $values[$key] = (bool) $value;
        break;
        case 'new_keywords':
          $value = explode("\n", $value);
          foreach ($value as $tmp) {
            $tmp = trim($tmp);
            if ($tmp) {
              self::log_search($tmp);
            }
          }
          $del_new_keywords = true;
        break;
        default:
        break;
      }
    } // foreach
    
    if ($del_new_keywords) {
      unset($values['new_keywords']);
    }
    
    if (isset($_POST['truncate'])) {
       global $wpdb;
       
       $wpdb->query('TRUNCATE TABLE ' . self::get_table_name());
       set_transient('wf-sa-truncate', true, 10);
    }
    
    return $values;
  } // sanitize_settings
  
  // output the whole options page
  function options_page() {
    if (!current_user_can('manage_options'))  {
      wp_die('You do not have sufficient permissions to access this page.');
    }
    
    global $wpdb;
    $options = get_option('wf_sa');
    
    if (get_transient('wf-sa-truncate')) {
      echo '<div id="message" class="error"><p><b>Search log truncated.</b></p></div>';
      delete_transient('wf-sa-truncate');
    }
    
    echo '<div class="wrap">
          <div class="icon32" id="icon-options-general"><br /></div>
          <h2>5sec Search Autocomplete Settings</h2>';

    echo '<form action="options.php" method="post">';
    settings_fields('wf_sa');
    
    echo '<table class="form-table"><tbody>';

    $sorts[] = array('val' => 'term', 'label' => 'Alphabetical, ascending');
    $sorts[] = array('val' => 'quality', 'label' => 'By keyword popularity, descending');

    echo '<tr valign="top">
    <th scope="row"><label for="order">Suggestions Order</label></th>
    <td><select id="order" name="wf_sa[order]">';
    foreach ($sorts as $sort) {
      if ($options['order'] == $sort['val']) {
        echo "<option selected=\"selected\" value=\"{$sort['val']}\">{$sort['label']}&nbsp;</option>\n";
      } else {
        echo "<option value=\"{$sort['val']}\">{$sort['label']}&nbsp;</option>\n";
      }
    }
    echo '</select> Alphabetical ordering is more natural for autocomplete, but ordering by popularity will give your users better suggestions. Default: popularity.</td>
    </tr>';

    $masks[] = array('val' => 'normal', 'label' => 'TERM%');
    $masks[] = array('val' => 'broad', 'label' => '%TERM%');
    echo '<tr valign="top">
    <th scope="row"><label for="mask">Suggestions Matching Mask</label></th>
    <td><select id="mask" name="wf_sa[mask]">';
    foreach ($masks as $mask) {
      if ($options['mask'] == $mask['val']) {
        echo "<option selected=\"selected\" value=\"{$mask['val']}\">{$mask['label']}</option>\n";
      } else {
        echo "<option value=\"{$mask['val']}\">{$mask['label']}</option>\n";
      }
    }
    echo '</select> First option is more natural for autocomplete and puts less strain on the database; but provides less suggestions because it matches only the begging of the word. Second option provides more suggestions. Default: TERM%.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="onselect">Perform Search on Select</label></th>
    <td><input name="wf_sa[onselect]" id="onselect" ' . checked('1', $options['onselect'], false) . ' value="1" type="checkbox"> If checked the search form will be submited imediatelly after user selects a suggestion from autocomplete. If not, he has to click "search" after selecting a suggestion. Default: checked.</td>
    </tr>';

    echo '<tr valign="top">
      <th scope="row"><label for="suggestions_nb">Number of Suggestions</label></th>
    <td><select id="suggestions_nb" name="wf_sa[suggestions_nb]">';
    for ($i=1; $i<=25; $i++) {
      if ($options['suggestions_nb'] == $i) {
        echo "<option selected=\"selected\" value=\"{$i}\">{$i}&nbsp;</option>\n";
      } else {
        echo "<option value=\"{$i}\">{$i}&nbsp;</option>\n";
      } 
    }
    echo '</select>
     Lower numbers produce a more responsive autocomplete and put less strain on the server. Default: 5; as suggested and used by Google.</select>
    </td></tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="min_length">Minimum Length</label></th>
    <td><select id="min_length" name="wf_sa[min_length]">';
    for ($i = 1; $i <= 5; $i++) {
      if ($options['min_length'] == $i) {
        echo "<option selected=\"selected\" value=\"{$i}\">{$i}&nbsp;&nbsp;&nbsp;</option>\n";
      } else {
        echo "<option value=\"{$i}\">{$i}&nbsp;</option>\n";
      }
    }
    echo '</select> Minimum number of characters a user has to type before autocomplete activates. Default: 2.</td>
    </tr>';

    $themes[] = array('val' => 'ui-lightness', 'label' => 'UI lightness');
    $themes[] = array('val' => 'ui-darkness', 'label' => 'UI darkness');
    $themes[] = array('val' => 'smoothness', 'label' => 'Smoothness');
    $themes[] = array('val' => 'start', 'label' => 'Start');
    $themes[] = array('val' => 'redmond', 'label' => 'Redmond');
    $themes[] = array('val' => 'sunny', 'label' => 'Sunny');
    $themes[] = array('val' => 'overcast', 'label' => 'Overcast');
    $themes[] = array('val' => 'le-frog', 'label' => 'Le Frog');
    $themes[] = array('val' => 'flick', 'label' => 'Flick');
    $themes[] = array('val' => 'pepper-grinder', 'label' => 'Pepper Grinder');
    $themes[] = array('val' => 'eggplant', 'label' => 'Eggplant');
    $themes[] = array('val' => 'dark-hive','label' => 'Dark Hive');
    $themes[] = array('val' => 'cupertino', 'label' => 'Cupertino');
    $themes[] = array('val' => 'south-street', 'label' => 'South Street');
    $themes[] = array('val' => 'blitzer', 'label' => 'Blitzer');
    $themes[] = array('val' => 'humanity', 'label' => 'Humanity');
    $themes[] = array('val' => 'hot-sneaks', 'label' => 'Hot Sneaks');
    $themes[] = array('val' => 'excite-bike', 'label' => 'Excite Bike');
    $themes[] = array('val' => 'vader', 'label' => 'Vader');
    $themes[] = array('val' => 'dot-luv', 'label' => 'Dot Luv');
    $themes[] = array('val' => 'mint-choc', 'label' => 'Mint Choc');
    $themes[] = array('val' => 'black-tie', 'label' => 'Black Tie');
    $themes[] = array('val' => 'trontastic', 'label' => 'Trontastic');
    $themes[] = array('val' => 'swanky-purse', 'label' => 'Swanky Purse'); 
    $themes[] = array('val' => '', 'label' => 'No theme');

    echo '<tr valign="top">
    <th scope="row"><label for="theme">Theme</label></th>
    <td><select id="theme" name="wf_sa[theme]">';
    foreach ($themes as $theme) {
      if ($options['theme'] == $theme['val']) {
        echo "<option selected=\"selected\" value=\"{$theme['val']}\">{$theme['label']}&nbsp;</option>\n";
      } else {
        echo "<option value=\"{$theme['val']}\">{$theme['label']}&nbsp;</option>\n";
      }
    }
    echo '</select> If you want to desing your own theme use jQuery\'s <a href="http://jqueryui.com/themeroller/">ThemeRoller</a> or just modify one of the existing CSS files. Default: UI lightness.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="delay">Delay</label></th>
    <td><input name="wf_sa[delay]" id="delay" value="' . $options['delay'] . '" class="small-text" type="text"> Time in milliseconds autocomplete waits after a keystroke to activate itself. A zero-delay makes sense for local data (more responsive), but can produce a lot of load for remote data, while being less responsive. Default: 300.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="input_selector">Input Field(s) to Autocomplete</label></th>
    <td><input name="wf_sa[input_selector]" id="input_selector" value="' . htmlspecialchars($options['input_selector']) . '" class="regular-text code" type="text"> jQuery selector which determines what input fields get the autocomplete enhancement. Default value, <i>input[name=\'s\']</i>, is preferable for most themes.</td>
    </tr>';

    echo '</tbody></table>';
    echo '<p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit"></p>';

    echo '<h3>Search Log</h3>';

    echo '<table class="form-table"><tbody>';
    echo '<tr valign="top">
    <th scope="row"><label for="log_local">Log Locals Searches</label></th>
    <td><input name="wf_sa[log_local]" id="log_local" ' . checked('1', $options['log_local'], false) . ' value="1" type="checkbox"> All searches users make on the site will be anonymously logged in the database. Default: checked.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="log_se">Log Search Engine Keywords</label></th>
    <td><input name="wf_sa[log_se]" id="log_se" ' . checked('1', $options['log_se'], false) . ' value="1" type="checkbox"> All searches that lead users from search engines to this site will be anonymously logged in the database. Default: checked.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="new_keywords">New Keywords</label></th>
    <td>If you want to manually enter many keywords at once to enhance your autocomplete suggestions you can enter them here.<br />
    Please write one keyword per line.
    <p><textarea name="wf_sa[new_keywords]" rows="6" cols="50" id="new_keywords" class="large-text code"></textarea></p>
    </td></tr>';

    $total_unique = number_format($wpdb->get_var('SELECT COUNT(id) FROM ' . self::get_table_name()));
    $total = number_format((int) $wpdb->get_var('SELECT SUM(search_count) FROM ' . self::get_table_name()));
    $oldest = $wpdb->get_row('SELECT * FROM ' . self::get_table_name() . ' ORDER BY last_search ASC LIMIT 1');
    $newest = $wpdb->get_row('SELECT * FROM ' . self::get_table_name() . ' ORDER BY last_search DESC LIMIT 1');
    $popular = $wpdb->get_row('SELECT * FROM ' . self::get_table_name() . ' ORDER BY search_count DESC LIMIT 1');

    echo '<tr valign="top">
    <th scope="row">Statistics</th>';
    echo "<td><ul>
    <li>Total number of unique keywords in log: {$total_unique}.</li>
    <li>Total number of non-unique saved searches: {$total}.</li>";
    if ($newest) {
      echo "<li>Oldest keyword: <i>{$oldest->term}</i> performed at " . date(get_option('date_format') . ' ' . get_option('time_format'), strtotime($oldest->last_search)) . ".</li>
      <li>Newest keyword: <i>{$newest->term}</i> performed at " . date(get_option('date_format') . ' ' . get_option('time_format'), strtotime($newest->last_search)) . ".</li>
      <li>Most popular keyword: <i>{$popular->term}</i> searched {$popular->search_count} time(s).</li>";
    }
    echo '</ul></td></tr>';

    echo '<tr valign="top">
    <th scope="row">Truncate Search Log</th>';
    echo '<td><input onclick="if(!confirm(\'Are you sure you want to delete all log entries? There is no undo!\')) {return false};" type="submit" value="Truncate Search Log" class="button-secondary" style="color: red;" name="truncate"> Delete all log entries in the database table. There is no undo!</td></tr>';

    echo '</tbody></table>';
    echo '<p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit"></p>';

    echo '<h3>Advanced options</h3>';
    echo '<table class="form-table"><tbody>';

    echo '<tr valign="top">
    <th scope="row"><label for="include_jquery">Include jQuery</label></th>
    <td><input name="wf_sa[include_jquery]" id="include_jquery" ' . checked('1', $options['include_jquery'], false) . ' value="1" type="checkbox"> If your theme doesn\'t already have jQuery included enable this option. Default: unchecked.</td>
    </tr>';

    echo '<tr valign="top">
    <th scope="row"><label for="include_ui_js">Include jQuery UI Autocomplete</label></th>
    <td><input name="wf_sa[include_ui_js]" id="include_ui_js" ' . checked('1', $options['include_ui_js'], false) . ' value="1" type="checkbox"> Disable this option only if you already have jQuery UI Autocomplete (and core, widget, position) included in your theme. Default: checked.</td>
    </tr>';

    echo '</tbody></table>';

    echo '<p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="Submit"></p>
    </form></div>';

  } // options_page

  // get plugins table name
  function get_table_name() {
    global $wpdb;
    $table = $wpdb->prefix . 'sa_keywords';
    
    return $table;
  } // get_table_names

  // writes the term/keyword to DB
  function log_search($term = false) {
    if (!$term) {
      $term = self::get_search_term();
    }
    
    if ($term) {
      global $wpdb;

      $term_esc = $wpdb->escape(mb_strtolower($term));
      $search_type = ($term['type'] == 'se') ? 'se' : 'lo';
      $last_search = current_time('mysql');
      $wpdb->query("INSERT INTO " . self::get_table_name() . " (term, search_count, last_search) 
                    VALUES ('{$term_esc}', 1, '{$last_search}') 
                    ON DUPLICATE KEY UPDATE search_count = search_count + 1, last_search = '{$last_search}';");
      return true;
    } else {
      return false;
    }
  } // log_search
  
  // gets search term from referer or local search
  function get_search_term() {
    $term = false;
    $type = false;
    
    if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
      // local search - no referrer
      if(!is_admin() && is_search() && !is_paged()) {
        $term = get_query_var('s');
        $type = 'lo';
        if (get_magic_quotes_gpc()) {
          $term = stripslashes($term);
        }
      }
    } else { // may be from search engine
      $ref = preg_replace('@(http|https)://@', '', stripslashes(urldecode($_SERVER['HTTP_REFERER'])));
      $args = explode('?', $ref);
      if (sizeof($args) > 1) {
        parse_str($args[1], $query);
      } else {
        $query = array();
      }
      
      if (substr($ref, 0, strlen($_SERVER['SERVER_NAME'])) == $_SERVER['SERVER_NAME']) {
        // still local
        if(!is_admin() && is_search() && !is_paged()) {
          $term = get_query_var('s');
          $type = 'lo';
          if (get_magic_quotes_gpc()) {
            $term = stripslashes($term);
          }
        }
      } elseif (strpos($ref, 'google') !== false) {
        $term = preg_replace('/\w+\:(.*)/', '$1', $query['q']);
        $type = 'se';
      } elseif (strpos($ref, 'yahoo') !== false) {
        $term = $query['p'];
        $type = 'se';
      } elseif (strpos($ref, 'lycos') !== false) {
        $term = $query['query'];
        $type = 'se';
      } elseif (strpos($ref, 'altavista') !== false) {
        $term = $query['q'];
        $type = 'se';
      } elseif (strpos($ref, 'bing.com') !== false || strpos($ref, 'search.msn') !== false || strpos($ref, 'search.live') !== false) {
        $term = $query['q'];
        $type = 'se';
      }
    } // search engine?
    
    if ($term) {
      return $term;
    } else {
      return false;
    }
  } // get_search_term
  
  // on first install log table is pre-poluated with site's categories and tags
  function get_terms() {
    global $wpdb;
    $bad = "'uncategorized', 'blogroll'";
    
    $out = $wpdb->get_col("SELECT name FROM {$wpdb->terms} WHERE name NOT IN ({$bad})");
    
    return $out;
  }
  
  // plugin activation
  function activate() {
    global $wpdb;
    
    // we only do activation actions first time, when there's no table
    if($wpdb->get_var("SHOW TABLES LIKE '" . self::get_table_name() . "'") != self::get_table_name()) {
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $sql_code = "CREATE TABLE `" . self::get_table_name() ."` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `term` varchar(255) NOT NULL DEFAULT '',
                  `search_count` int(10) unsigned NOT NULL DEFAULT '1',
                  `last_search` datetime NOT NULL,
                  PRIMARY KEY  (`id`),
                  UNIQUE KEY `term` (`term`)
                  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 ROW_FORMAT=DYNAMIC;";
      dbDelta($sql_code);
      
      add_option('wf_sa_v', '1.0');
      
      $terms = self::get_terms();
      foreach ($terms as $term) {
        self::log_search($term);
      }
      
      $options['order'] = 'quality';
      $options['mask'] = 'normal';
      $options['onselect'] = true;
      $options['suggestions_nb'] = 5;
      $options['min_length'] = 2;
      $options['theme'] = 'ui-lightness';
      $options['delay'] = 300;
      $options['input_selector'] = "input[name='s']";
      $options['log_local'] = true;
      $options['log_se'] = true;
      $options['include_ui_js'] = true;
      add_option('wf_sa', $options);
    }
  } // activate
} // class wf_sa
} // if class
?>