jQuery(document).ready(function(){
		getID();
})

function getID(){
	$( "#select_task" ).change(function() {
	var d = document.getElementById("select_task").value;	
	 $.ajax( // wywołanie ajaxa
      { 
         type: "POST",
         url: "get_subtasks.php",
          data:d,
         cache: false,
         success: function(){}        
      })
	
	
	
		
		
    });    
}
