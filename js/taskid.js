jQuery(document).ready(function(){
		getID();
})

function getID(){
	$( "#select_task" ).change(function() {
	var d = document.getElementById("select_task").value;	

	$.ajax({
        type: 'POST',
		dataType:'json', 
        url: "get_subtasks.php",
        contentType:"application/json; charset=utf-8", 
        data: {
			data: d
        },
        success: function (jsonArray) {
            var names = JSON.parse(jsonArray);
			 var j=1;
			 while (names[j]) {
				 alert(names[j]);
			
			 j++;
			 }
		}
})
	
	
	
	
	
	
	
	
		
    });    
}



