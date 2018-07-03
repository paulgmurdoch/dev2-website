  var $j = jQuery.noConflict();
		
  $j(function() {
    $j("#experiments_active").change( function() {
      $j(".contexpcode").toggle();
    });
    $j("#event_tracking_active").change( function() {
        $j(".eventtrackcode").toggle();
      });
  });