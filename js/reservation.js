/* global xmlHttp, savedValue, savedValues1 */

function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        // Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function keyset(key, e) {

    if (e.keyCode == 13) {
        document.getElementById(key).focus();
    }
}

function got_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000066";

}

function lost_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000000";
}



function checkreserved() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "reservation_data.php";
    url = url + "?Command=" + "checkreserve";

    url = url + "&refno=" + document.getElementById('refno').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    url = url + "&gname=" + document.getElementById('gname').value;
    url = url + "&rdate=" + document.getElementById('rdate').value;
    url = url + "&from=" + document.getElementById('from').value;
    url = url + "&to=" + document.getElementById('to').value;

    xmlHttp.onreadystatechange = assign_dt3;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function assign_dt3() {
    var XMLAddress1;
    var xx = [];
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("table");

        for (var i = 0; i < XMLAddress1.length; i++) {

            xx.push(XMLAddress1[i].childNodes[0].nodeValue);
        }

        for (var i = 0; i < xx.length; i++) {
//            alert(xx[i]);

            document.getElementById(xx[i]).style.backgroundColor = "red";

        }

    }
}
function newent() {

    document.getElementById('refno').value = "";
    document.getElementById('uniq').value = "";
    document.getElementById('gname').value = "";
    document.getElementById('rdate').value = "";
    document.getElementById('from').value = "";
    document.getElementById('to').value = "";
    document.getElementById('person').value = "";
    document.getElementById('note').value = "";
    document.getElementById('tables').value = "";
    document.getElementById('msg_box').innerHTML = "";
    var floor_tables = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24"];
    for (var i = 0; i < floor_tables.length; i++) {
        document.getElementById(floor_tables[i]).style.backgroundColor = "#66afe8";

    }
    tables = [];


    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "reservation_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&refno=" + document.getElementById('refno').value;

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}


function assign_dt() {
    var XMLAddress1;
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
        var idno = XMLAddress1[0].childNodes[0].nodeValue;
        if (idno.length === 1) {
            idno = "RE/0000" + idno;
        } else if (idno.length === 2) {
            idno = "RE/000" + idno;
        } else if (idno.length === 3) {
            idno = "RE/00" + idno;
        } else if (idno.length === 4) {
            idno = "RE/0" + idno;
        } else if (idno.length === 5) {
            idno = "RE/" + idno;
        }

        document.getElementById("refno").value = idno;
        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;
    }
}



function cancel_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('refno').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Ref No Not Enterd</span></div>";
        return false;
    }
    var url = "reservation_data.php";
    url = url + "?Command=" + "cancel_item";

    url = url + "&refno=" + document.getElementById('refno').value;


    xmlHttp.onreadystatechange = cancelresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function cancelresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Cancel") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Cancel</span></div>";
            newent();
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}


function save_inv() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

//    if (document.getElementById('refno').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reservation No Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('gname').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Guest Name Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('rdate').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reservation Date Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('from').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reservation From Not Selected</span></div>";
//        return false;
//    }
//
//    if (document.getElementById('to').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Reservation To Not Enterd</span></div>";
//        return false;
//    }
//
//    if (document.getElementById('person').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>No Of Persons Not Enterd</span></div>";
//        return false;
//    }
//    if (document.getElementById('tables').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Tables Not Selected</span></div>";
//        return false;
//    }



    var url = "reservation_data.php";
    url = url + "?Command=" + "save_item";

    url = url + "&refno=" + document.getElementById('refno').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    url = url + "&gname=" + document.getElementById('gname').value;
    url = url + "&rdate=" + document.getElementById('rdate').value;
    url = url + "&from=" + document.getElementById('from').value;
    url = url + "&to=" + document.getElementById('to').value;
    url = url + "&person=" + document.getElementById('person').value;
    url = url + "&note=" + document.getElementById('note').value;
    url = url + "&addtable=" + document.getElementById('tables').value;

    document.getElementById('msg_box').innerHTML = "";

    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function salessaveresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";
//            print();
            newent();
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

//split
var tables = [];
function ch_reserve(name) {

    var sw = 0;
    for (var i = 0; i < tables.length; i++) {
        if (tables[i] == name) {
            sw = 1;
            console.log(tables[i] + " : " + name);
            tables.splice(i, 1);
        } else {

        }
    }

    if (sw != 1) {
        tables.push(name);
    }

    var floor_tables = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24"];
    for (var i = 0; i < floor_tables.length; i++) {
        document.getElementById(floor_tables[i]).style.backgroundColor = "#66afe8";
    }

    for (var i = 0; i < tables.length; i++) {
        document.getElementById(tables[i]).style.backgroundColor = "green";
    }

    document.getElementById("tables").value = tables;
//    checkreserved();
}

function custno(code)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "reservation_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;


    xmlHttp.onreadystatechange = passcusresult_quot;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}



function passcusresult_quot()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("refno");
        opener.document.form1.refno.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("gname");
        opener.document.form1.gname.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("rdate");
        opener.document.form1.rdate.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("from");
        opener.document.form1.from.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("to");
        opener.document.form1.to.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("person");
        opener.document.form1.person.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tables");
        opener.document.form1.tables.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("note");
        opener.document.form1.note.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("cancel");
        if (XMLAddress1[0].childNodes[0].nodeValue == "1") {
            opener.document.getElementById('msg_box').innerHTML = "<div class='alert alert-danger' role='alert'><span class='center-block'>Canceled</span></div>";
        } else {

        }


        self.close();
    }
}

function update_cust_list(stname)
{


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "reservation_data.php";
    url = url + "?Command=" + "update_list";


    if (document.getElementById('cusno').value != "") {
        url = url + "&mstatus=cusno";
    } else if (document.getElementById('customername').value != "") {
        url = url + "&mstatus=customername";
    } else if (document.getElementById('customername1').value != "") {
        url = url + "&mstatus=customername1";
    }

    url = url + "&cusno=" + document.getElementById('cusno').value;
    url = url + "&customername=" + document.getElementById('customername').value;
    url = url + "&customername1=" + document.getElementById('customername1').value;
    url = url + "&stname=" + stname;


    xmlHttp.onreadystatechange = showcustresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function showcustresult()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        document.getElementById('filt_table').innerHTML = xmlHttp.responseText;

    }
}