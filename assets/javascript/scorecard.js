$(document).ready(function() {
    $('#focarea').change(function() {
        refresh(branch.value, focarea.value);
    });
    $('#branch').change(function() {
        refresh(branch.value, focarea.value);
    });
});

var pgrefresh;

function showUser(str, str2) {
    //alert(str);

    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "viewv2.php?bid=" + str + "&fid=" + str2, true);
    xmlhttp.send();
    $('.spinner').hide();

}

function edit(str) {
    //alert(str);

    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "EDIT.php?id=" + str, true);
    xmlhttp.send();
}

function refresh(str, str2) {
    clearInterval(pgrefresh);
    $('.spinner').show();
    pgrefresh = setInterval(function() {
        showUser(str, str2)
    }, 3000);
}