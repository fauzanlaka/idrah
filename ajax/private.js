//----------------------------------------student--------------------------------------------
function student_search(path, formId){
    var URL = path + "?dummy=" + Math.random();
    var data = getFrmData(formId);
    ajaxLoadFrw('post', URL, data, 'list');
}
function student_search_enter(path, formId){
    if(event.keyCode==13){
        student_search(path, formId);
        return false;
    }
}
//----------------------------------------scoreCenter-----------------------------------------
function facultySelect(connect){
    var ft_id = document.getElementById('ft_id').value;
    var URL = "function/facultySelect.php?dummy=" + Math.random();
    var data = "&ft_id=" + ft_id + "&connect=" + connect;
    ajaxLoadFrw('post', URL, data, 'content');
}
//ค้นหาวิชาเพื่อดูรายงาน
function classTimetableSearch_setting(){
    var URL = "function/classTimetableSearch.php?dummy=" + Math.random();
    var data = getFrmData("classScheduleSearch");
    document.getElementById('msg').innerHTML = "Sedang cari...";
    ajaxLoadFrw('post', URL, data, 'msg');
}
//ค้นหาวิชาเพื่อบันทึก
function classTimetableSearch_record(){
    var URL = "function/classTimetableSearchRecord.php?dummy=" + Math.random();
    var data = getFrmData("classScheduleSearch");
    document.getElementById('msg').innerHTML = "Sedang cari...";
    ajaxLoadFrw('post', URL, data, 'msg');
}
//ค้นหารายชื่อห้อง
function studentSubject(s_id, ft_id, dp_id, rs_term, rs_year){
    var URL = "function/studentSubject.php?dummy=" + Math.random();
    var data = "&s_id=" + s_id + "&ft_id=" + ft_id + "&dp_id=" + dp_id + "&rs_term=" + rs_term + "&rs_year=" + rs_year;
    document.getElementById('msg').innerHTML = "Sedang cari...";
    ajaxLoadFrw('post', URL, data, 'msg');
}
//บันทึกคะแนน
function studentSubjectSave(value, ss_id){
    var URL = "function/studentSubjectSave.php?dummy=" + Math.random();
    var score = value;
    var alertId = "alert" + ss_id;
    var data = "&score=" + score + "&ss_id=" + ss_id + "&alertId=" + alertId;
    //alert(score);
    if(score == ""){
        document.getElementById(alertId).innerHTML = "";
    }else{
        document.getElementById(alertId).innerHTML = "Processing...";
    }
    ajaxLoadFrw('post', URL, data, 'msg');
}
//------------------------------------------dur------------------------------------
function dur_register(path, formId){
    var URL = path + "?dummy=" + Math.random();
    var data = getFrmData(formId);
    ajaxLoadFrw('post', URL, data, '');
}
function dul_delete(path, dr_id, st_id){
    var person = prompt("Enter password", "");
    if(person == "idarah"){
        var URL = path + "?dummy=" + Math.random();
        var data = "&dr_id=" + dr_id + "&st_id=" + st_id;
        ajaxLoadFrw('post', URL, data, 'content');
    }else{
        alert('Password incorect');
    }
    //document.getElementById("demo").innerHTML = txt;
    /*
    var result = confirm("Anda yakin menghapus?");
    if(result){
        var URL = path + "?dummy=" + Math.random();
        var data = "&dr_id=" + dr_id + "&st_id=" + st_id;
        ajaxLoadFrw('post', URL, data, 'content');
    }
    */
}