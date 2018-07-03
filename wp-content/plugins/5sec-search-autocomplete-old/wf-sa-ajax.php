<?php
  if(!$_GET || !isset($_GET['term'])) {
    die('Bad request.');
  }
  
  // disable client-side cache
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

  ob_start();
  @require_once '../../../wp-config.php';
  @require_once ABSPATH . 'wp-load.php';
  @require_once ABSPATH . 'wp-includes/wp-db.php';
  
  $options = get_option('wf_sa');
  $out = array();

  $term = $wpdb->escape($_GET['term']);
  if ($options['mask'] == 'normal') {
    $term = $term . '%';
  } elseif ($options['mask'] == 'broad') {
    $term = '%' . $term . '%';
  }
  if ($options['order'] == 'term') {
    $order = 'term ASC';
  } elseif ($options['order'] == 'quality') {
    $order = 'search_count DESC, term ASC';
  }
  
  $results = $wpdb->get_results('SELECT term FROM ' . wf_sa::get_table_name() . ' ' .
                                "WHERE term LIKE '{$term}' ORDER BY {$order} LIMIT " . $options['suggestions_nb']);

  foreach ($results as $tmp) {
    
    if ($options['mask'] == 'normal') {
      $term2 = '<strong>' . $_GET['term'] . '</strong>' . substr($tmp->term, strlen($_GET['term']));
    } elseif ($options['mask'] == 'broad') {
      $term2 = str_replace($_GET['term'], '<strong>' . $_GET['term'] . '</strong>', $tmp->term);
    }
    $out[] = array('label' => $term2, 'value' => $tmp->term);
  }

  ob_end_clean();
  echo json_encode($out);
?>