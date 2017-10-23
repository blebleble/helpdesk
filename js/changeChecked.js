function changeChecked(){
     
   var checkboxu= document.getElementsByClassName('checkboxu');  
   var checkboxr= document.getElementsByClassName('checkboxr'); 
   var x = document.getElementById("deletenots").value; 

   if( x =='wszystkie'){
        for(var i=0; i< checkboxu.length; i++){
            checkboxu[i].checked = true;
        }
        for(var i=0; i< checkboxr.length; i++){
            checkboxr[i].checked = true;
        }
    
   } 
   
   
   if( x =='----'){
        for(var i=0; i< checkboxu.length; i++){
            checkboxu[i].checked = false;
        }
    
        for(var i=0; i< checkboxr.length; i++){
            checkboxr[i].checked = false;
        }
   }   
  
  if( x =='przeczytane'){
        for(var i=0; i< checkboxr.length; i++){
            checkboxr[i].checked = true;
        }
        
        for(var i=0; i< checkboxu.length; i++){
            checkboxu[i].checked = false;
        }
        
   }
  
  if( x =='nieprzeczytane'){
         for(var i=0; i< checkboxu.length; i++){
            checkboxu[i].checked = true;
        }
        
        for(var i=0; i< checkboxr.length; i++){
            checkboxr[i].checked = false;
        }
   }
  
  
  
 }   
 