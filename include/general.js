checked=false;
function checkall(frm1){
	var aa= frm1;
	if(checked == false){
		checked = true
	}
	else{
		checked = false
	}
	for (var i =0; i < aa.elements.length; i++){
		aa.elements[i].checked = checked;
	}
}
