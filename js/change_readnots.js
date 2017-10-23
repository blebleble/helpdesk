function change_read(id, sid, tid, typ){ 

    if (window.XMLHttpRequest){
    xmlhttp=new XMLHttpRequest();
}

else{
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}


var PageToSendTo = "change_readnots.php?";
var ID = id;
var IDPlaceholder = "id=";
var SID=sid;
var SIDPlaceholder = "sid=";
var TID=tid;
var TIDPlaceholder = "tid=";
var And="&";
var UrlToSend = PageToSendTo + IDPlaceholder + ID + And + SIDPlaceholder + SID + And + TIDPlaceholder + TID;

xmlhttp.open("GET", UrlToSend, false);
xmlhttp.send();

if (typ <=6){
    location.href='tasks_all.php?tid='+tid+'&sid='+sid; 
}else{
    location.href='team_tasks.php';      
 }}
