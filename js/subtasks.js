
  
  var hide= function hide(id){
 

    var div = document.getElementById('sh'+id);
    var div2=document.getElementById(id);

    if(div.style.display == 'none')
    {
        div.style.display = 'block';
        div2.innerHTML = 'ukryj podzadania';
    }
    else
    {
        div.style.display = 'none';
        div2.innerHTML = 'pokaż podzadania';
    }
}



var editTask=
function editTask(id){
    if (window.XMLHttpRequest){
         xmlhttp=new XMLHttpRequest();
    }

    else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    var PageToSendTo = "edit_task.php?";
    var IDPlaceholder = "id=";

    var UrlToSend = PageToSendTo + IDPlaceholder + id;

    xmlhttp.open("GET", UrlToSend, false);
    xmlhttp.send();  
    window.location.href = "edit_task.php?id="+id;
}


var editSubtask=
function editSubtask(id){
    if (window.XMLHttpRequest){
         xmlhttp=new XMLHttpRequest();
    }

    else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    var PageToSendTo = "edit_subtask.php?";
    var IDPlaceholder = "id=";

    var UrlToSend = PageToSendTo + IDPlaceholder + id;

    xmlhttp.open("GET", UrlToSend, false);
    xmlhttp.send();  
    window.location.href = "edit_subtask.php?id="+id;
}


var deleteST=
function deleteST(id, typ){
    if(del(typ)){
        if (window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }

        else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

         var PageToSendTo = "delete_st.php?";
         var IDPlaceholder = "id=";
         var TYPPlaceholder = "typ=";

         var UrlToSend = PageToSendTo + IDPlaceholder + id + '&' + TYPPlaceholder + typ;

         xmlhttp.open("GET", UrlToSend, false);
         xmlhttp.send();
         window.location.href = "team_tasks.php";
    }
}



var closeST=
function closeST(id){
 
        if (window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }

        else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

         var PageToSendTo = "close_st.php?";
         var IDPlaceholder = "id=";

         var UrlToSend = PageToSendTo + IDPlaceholder + id ;

         xmlhttp.open("GET", UrlToSend, false);
         xmlhttp.send();
         window.location.href = "team_tasks.php";
    
}
 
 
 
var hangST=
function hangST(id){
 
        if (window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }

        else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

         var PageToSendTo = "hang_st.php?";
         var IDPlaceholder = "id=";

         var UrlToSend = PageToSendTo + IDPlaceholder + id ;

         xmlhttp.open("GET", UrlToSend, false);
         xmlhttp.send();
         window.location.href = "team_tasks.php";
    
}
 
 
 var blockSubtask=
 function blockSubtask (id){
    if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }

    else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    var PageToSendTo = "blocksubt.php?";
    var IDPlaceholder = "id=";

    var UrlToSend = PageToSendTo + IDPlaceholder + id;

    xmlhttp.open("GET", UrlToSend, false);
    xmlhttp.send();  
    window.location.href = "team_tasks.php";
 }