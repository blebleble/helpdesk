jQuery(document).ready(function(){
		getID();
})

function getID(){
	$( "#select_task" ).change(function() {
	var d = document.getElementById("select_task").value;	
	$.post( "get_subtasks.php", {data: d} )
	.done(function(jsonArray ) {
	var names = JSON.parse(jsonArray);
			 var j=1;
			 while (names[j]) {
				$( "#subtasks_list").prepend("<option value='"+names[j]+"'>");
			 j++;
			 }
	
			
    });    
})}

