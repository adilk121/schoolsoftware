/*###########################################Function For Ajax Work Calling##########################*/
function make_catreq1(f12){
	//alert(ix);
	try{
		ob1=new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
			ob1=new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e2){
			ob1=false;
		}
	}
	if(!ob1 && typeof XMLHttpRequest!='undefined'){
		ob1=new XMLHttpRequest();
	}
	var url="remote1.php?id3="+f12;
	//alert(''+url);
	ob1.open("GET",url,true);
	ob1.onreadystatechange=show_form;
	ob1.send(null);
}
/*###########################################Function For Ajax Result Fixing in Div##########################*/	
function show_form(){
	if(ob1.readyState==4){
		var resp=ob1.responseText;
		//alert(resp);
		var newdiv=document.getElementById("avail1");
		newdiv.innerHTML=resp;
		//alert(""+resp);
	}
}

