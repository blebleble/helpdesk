

jQuery(document).ready(function(){
	
clickme();
save_position();

	
	
	
})


function clickme(){
$( ".clickme" ).click(function() {
  $("#show"+this.id).toggle();
});
}




function save_position(){
 $(function() {
    $( ".timeline-centeredleft" ).sortable();
  });
  
  function saveOrder() {
	var selectedLanguage = new Array();
	$('ul#sortable-row li').each(function() {
	selectedLanguage.push($(this).attr("id"));
	});
	document.getElementById("row_order").value = selectedLanguage;
  }
  
}