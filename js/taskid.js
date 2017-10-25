jQuery(document).ready(function(){
		getID();
})

function getID(){
	$( "#select_task" ).change(function() {
	var d = document.getElementById("select_task").value;	
	$.post( "get_subtasks.php", {data: d} )
	.done(function( dd ) {
    alert( "Data Loaded: " + dd );
	
	
	
		
		
    });    
})
