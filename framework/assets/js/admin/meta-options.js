jQuery(function($) {
  $( "#tabs" ).tabs();
  $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

  /** Layout options */
  $("#layout-select").selectable({
  	selected: function( event, ui ) {
  		$('#page_layout').val($(ui.selected).attr('data-layout'));
  	}
	});
	/** Page title */
	$(function() {
    $("#page-title").buttonset();
  });

});
