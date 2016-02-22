window.onload=function(){

document.querySelector('.change').addEventListener("change", function(e) {
    var id = e.parentNode.getAttribute("id");
    var div
    var toRemove;
    var data;
    if(id == "brands"){
        div = document.querySelector('#brands');
        toRemove = document.querySelector("p#p");
        data = {brand: e.value};
    }
    else{
        if(id == "continent"){

        }
    }
    if(toRemove != null) {
        div.removeChild(toRemove);
    }
	
	asyncAJAXRequest(data);
});

function asyncAJAXRequest(data) {
	$.ajax({
		type: "post",
		url: "async_request.php",
		async: true,
		data: data,
		success: function(receivedArray) {
		var array1 = JSON.parse(receivedArray); //this line and
		displayBrandVisitData(array1); 	//this call are here to keep the code that reads the array from executing before
      }									//the AJAX request has returned.
    });
}

function displayBrandVisitData(visitsArray) {
	var para = document.createElement("p");
	para.id = "p";
	para.className = "right"
	var node = document.createTextNode('Visits for ' + visitsArray[0] + ': ');
	var span = document.createElement("span")
	span.className = "teal-text text-darken-1 bold";
	span.innerHTML = visitsArray[1];
	para.appendChild(node);
	para.appendChild(span);
	
	var select = document.querySelector("Select");
	
	select.parentNode.insertBefore(para, select.nextSibling);
}

function displayBrandVisitData(visitsArray) {
    var para = document.createElement("p");
    para.id = "p";
    para.className = "right"
    var node = document.createTextNode('Visits for ' + visitsArray[0] + ': ');
    var span = document.createElement("span")
    span.className = "teal-text text-darken-1 bold";
    span.innerHTML = visitsArray[1];
    para.appendChild(node);
    para.appendChild(span);

    var select = document.querySelector("Select");

    select.parentNode.insertBefore(para, select.nextSibling);
}

};