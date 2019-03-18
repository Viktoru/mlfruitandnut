(function($, Drupal) {
  /**
   * Add new command for reading a message.
   */
  Drupal.AjaxCommands.prototype.customDataTables = function(ajax, response, status){
    // Place content in current-msg div.
    $('#response-result').html(response.content);
    $('#construction-table').DataTable({
	    "searching": false,
		  "bFilter" : false,
		  "bLengthChange": false,
      "ordering": true,
      "columns": [
        null,
        null
          ]
      // columnDefs: [
      //   {
      //     targets: -1,
      //     className: 'dt-body-right'
      //   }
      // ]

/*
		"infoCallback": function( settings, start, end, max, total, pre ) {
			if(start > 5) start = start/5;
			return 'Showing '+ start + ' to ' + end/5 + ' of '+ total/5 + ' entries';
    	},
*/
	});
  };
  Drupal.AjaxCommands.prototype.resetButtonCommand = function(ajax, response, status){
	  console.log(response.content);
    jQuery('#mlfruitandnut-search').trigger("reset"); 
    jQuery("select[data-drupal-selector=edit-construction-title] option").prop("selected", function(){ return this.defaultSelected; }); 
    jQuery("#response-result").html("");
    $("select[data-drupal-selector=edit-mlfruitandnut-title]").html("");
    return false;
  };
})(jQuery, Drupal);