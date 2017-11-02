

jQuery(document).ready(function () {

    clickme();
    save_position();
	colorChange();

})


function clickme() {
    $(".clickme").click(function () {
        $("#show" + this.id).toggle();
    });
}




function save_position() {
    $(function () {
        $(".timeline-centeredleft").sortable();
        $(".clickme").sortable();
    });

    function saveOrder() {
        var selectedLanguage = new Array();
        $('ul#sortable-row li').each(function () {
            selectedLanguage.push($(this).attr("id"));
        });
        document.getElementById("row_order").value = selectedLanguage;
    }

}

function verify_order() {

	var array= new Array();
	$('.timeline-entry').each(function () {
    array.push(this.id);
	});
	
	$.post("saveorder.php", {array: array}, function(){

});
	
	
	
}

function colorChange(){
$(".color").change(function(){
    var id = this.id;
    var color = this.value;
	$('#color'+this.id).css('background', this.value);
     $.post("changeColor.php", {id: id, color: color}, function(result){

});
})}