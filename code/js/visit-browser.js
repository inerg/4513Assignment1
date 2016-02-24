window.onload=function() {

asyncAJAXRequest("");
    document.querySelector('#submit').addEventListener("click", updateTable);
// var items = document.getElementsByClassName('change');
//    for(var i = 0; i < items.length; i++)
//    {
//        items[i].addEventListener("change", listen);
//    }
//
//function listen(e) {
//
//    var id = e.target.parentNode.getAttribute("id");
//    var div;
//    var toRemove;
//    var data;
//    if(id == "brands"){
//        loadingBar('#brands');
//        div = document.querySelector('#brands');
//        toRemove = document.querySelector("p#p");
//        data = {brand: e.target.value};
//    }
//    else{
//        if(id == "continent"){
//            loadingBar('#continent');
//            div = document.querySelector('#countries').parentNode;
//            toRemove = document.querySelector("#countries");
//            data = {continent: e.target.value};
//        }
//    }
//    if(toRemove != null) {
//        div.removeChild(toRemove);
//    }
//
//	asyncAJAXRequest(data, id);
//}
//
function updateTable(){

        var brand = document.querySelector('#brand');
        if("false".localeCompare(brand.options[brand.selectedIndex].value)) {
            brand = brand.options[brand.selectedIndex].value;
        }
    else
        brand = "";
        var os = document.querySelector('#os');
        if("false".localeCompare(os.options[os.selectedIndex].value)) {
            os = os.options[os.selectedIndex].value;
        }
    else
        {
            os = "";
        }
        var dt = document.querySelector('#dt');
        if("false".localeCompare(dt.options[dt.selectedIndex].value)) {
            dt = dt.options[dt.selectedIndex].value;
        }
    else
        {
            dt = "";
        }
        var referrer = document.querySelector('#referrer');
        if("false".localeCompare(referrer.options[referrer.selectedIndex].value)) {
            referrer = referrer.options[referrer.selectedIndex].value;
        }
    else
        {
            referrer = "";
        }
        var browser = document.querySelector('#browser');
        if("false".localeCompare(browser.options[browser.selectedIndex].value)) {
            browser = browser.options[browser.selectedIndex].value;
        }
        else
        {
            browser = "";
        }

        data = {brand: brand, os: os, dt: dt, referrer: referrer, browser: browser};
        //console.log(div.options[div.selectedIndex].value);
        //console.log(div.options[div.selectedIndex].value);

    clearModals();
    clearTable();
    loadingBar("#VisitInfo");
    asyncAJAXRequest(data);
}

    function clearModals(){
        var parent = document.querySelector("body");
        var modals = document.querySelectorAll(".modal");
        for(var i = 0; i < modals.length; i++){
            var temp = modals[i];
            console.log("clearing: " + temp.id);
            parent.removeChild(temp);
        }
    }
    function clearTable(){
        var parent = document.querySelector("#VisitInfo").parentNode;
        parent.removeChild(document.querySelector("#countries"));
    }
function asyncAJAXRequest(data) {
	$.ajax({
		type: "post",
		url: "visit_async_request.php",
		async: true,
		data: data,
		success: function(receivedArray) {
		var array1 = JSON.parse(receivedArray); //this line and
            displayVisitData(array1);
            	//these calls are here to keep the code that reads the array from executing before
      }									//the AJAX request has returned.
    });
}
//
//function displayBrandVisitData(visitsArray) {
//	var para = document.createElement("p");
//	para.id = "p";
//	para.className = "right"
//	var node = document.createTextNode('Visits for ' + visitsArray[0] + ': ');
//	var span = document.createElement("span")
//	span.className = "teal-text text-darken-1 bold";
//	span.innerHTML = visitsArray[1];
//	para.appendChild(node);
//	para.appendChild(span);
//
//	var select = document.querySelector("Select");
//
//	select.parentNode.insertBefore(para, select.nextSibling);
//    $('#' + select.parentNode.id + "> .progress").hide();
//}
}
function displayVisitData(visitsArray) {
    var table = document.createElement("table");
    table.id = "countries";
    table.className = "striped highlight responsive-table table-hover-continents";
    var tableHead = document.createElement("thead");
    var row = document.createElement("tr");

    var th = document.createElement("th");
    th.innerHTML = "Visit Date";
    row.appendChild(th);

    th = document.createElement("th");
    th.innerHTML = "Visit Time";
    row.appendChild(th);

    th = document.createElement("th");
    th.innerHTML = "IP Address";
    row.appendChild(th);

    th = document.createElement("th");
    th.innerHTML = "Country Name";
    row.appendChild(th);

    th = document.createElement("th");
    th.innerHTML = "More Info";
    row.appendChild(th);

    tableHead.appendChild(row);
    table.appendChild(tableHead);

    var tableBody = document.createElement("tbody");
    //table body/

    for(var i = 0; i < visitsArray.length; i++)
    {
        var row = document.createElement("tr");
        var column = document.createElement("td");
        column.innerHTML = visitsArray[i].visit_date;
        row.appendChild(column);

        column = document.createElement("td");
        //var date = new Date(visitsArray[i].visit_time);
        //column.innerHTML = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        column.innerHTML = visitsArray[i].visit_time;
        row.appendChild(column);

        column = document.createElement("td");
        column.innerHTML = visitsArray[i].ip_address;
        row.appendChild(column);

        column = document.createElement("td");
        column.innerHTML = visitsArray[i].CountryName;
        row.appendChild(column);

        column = document.createElement("td");

        var modal = document.createElement("a");
        modal.setAttribute("href","#modal" + i);
        modal.setAttribute("target","_self");
        modal.className = "btn modal-trigger waves-light waves-effect";
        modal.innerHTML = "Info";
        column.appendChild(modal);
        buildModal(visitsArray[i], i);
        //column.innerHTML = "put link here";
        row.appendChild(column);

        tableBody.appendChild(row);

        $('#VisitInfo' + '> .progress').hide();
    }

    table.appendChild(tableBody);

    var select = document.querySelector("#VisitInfo");
    select.parentNode.appendChild(table);


    $(document).ready(function(){
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();

    });
   // $('#continent > .progress').hide();

}

function buildModal(info, id){
     var div = document.createElement("div");
    div.id = "modal"+id;
    div.className = "modal";
    var tempDiv = document.createElement("div");
    tempDiv.className = "modal-content";
    var modalHeader = document.createElement("h4");
    modalHeader.innerHTML = info.ip_address;
    tempDiv.appendChild(modalHeader);
    //fill it with things here

    div.appendChild(tempDiv);

    tempDiv = document.createElement("div");
    tempDiv.className = "modal-footer";

    var modalFooter = document.createElement("a");
    modalFooter.className = "modal-action modal-close waves-effect waves-green btn-flat"
    modalFooter.setAttribute("href","#!");
    tempDiv.appendChild(modalFooter);
    div.appendChild(tempDiv);
    document.querySelector("body").appendChild(div);
}
function loadingBar(id){
    var divProgress = document.createElement("div");
    divProgress.className = "progress";
    var div = document.createElement("div");
    div.className =  "indeterminate";
    divProgress.appendChild(div);

    document.querySelector(id).appendChild(divProgress)
}
