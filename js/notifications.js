window.onload= function getNotifications(){
	

       $.ajax({
        type:"GET", 
        url:"notifications.php", 
        contentType:"application/json; charset=utf-8", 
        dataType:'json', 
            success: function(json) { 
             document.getElementById('circle').innerHTML=json;
            }
          });

        setTimeout(function(){
        getNotifications();
        }, 17000);
		
		
}
                
function del(ver){
    var text;
    switch (ver){
        case 0: text = "Czy na pewno chcesz usunąć podzadanie?";
            break;
        case 1: text = "Czy na pewno chcesz usunąć zadanie?";
            break;
        case 2: text = "Czy na pewno chcesz przenieść zaznaczone powiadomienia do kosza?";
            break;
        case 3: text = "Czy jesteś pewien?";
            break;
        case 4: text = "Czy na pewno chcesz usunąć komentarz?";
            break;
        case 5: text = "Czy na pewno chcesz usunąć załącznik?";
            break;
    }
    
    
    return confirm(text);
}                