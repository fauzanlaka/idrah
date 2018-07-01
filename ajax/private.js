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
//------------------------------------------staff------------------------------------
function attendanceReport(){
    if(document.getElementById('fromDate').value == ""){
        document.getElementById('fromDate').focus();
    }else if(document.getElementById('toDate').value == ""){
        document.getElementById('toDate').focus();
    }else if(document.getElementById('tp_id').value == ""){
        document.getElementById('tp_id').focus();
    }else{
        var URL = "module/staff/action/attendanceReport.php?dummy=" + Math.random();
        var data = getFrmData('search');
        document.getElementById('result').innerHTML = "Searching...";
        ajaxLoadFrw('post', URL, data, 'result');
    }
}
function holidayAdd(){
    if(document.getElementById('fromDate').value==""){
        document.getElementById('fromDate').focus();
    }else if(document.getElementById('toDate').value==""){
        document.getElementById('toDate').focus();
    }else if(document.getElementById('jh_holiday_name').value==""){
        document.getElementById('jh_holiday_name').focus();
    }else{
        var URL = "module/staff/action/holidayAdd.php?dummy=" + Math.random();
        var data = getFrmData('holiday');
        document.getElementById('process').innerHTML = 'Saving...';
        ajaxLoadFrw('post', URL, data, 'result');
    }
}
function deleteHoliday(jh_id){
    var person = prompt("Enter password", "");
    if(person == 'idarah'){
        var URL = "module/staff/action/deleteHoliday.php?dummy=" + Math.random();
        var data = "&jh_holiday_name=" + jh_id;
        document.getElementById('deleteProcess').innerHTML = "...";
        ajaxLoadFrw('post', URL, data, '');
    }
}
function staffSearchEnter(){
    if(event.keyCode==13){
        staffSearch();
        return false;
    }
}
function staffSearch(){
    //ปิด pagination
    var textLength = document.getElementById('q').value.length;
    if(textLength<1){
        document.getElementById('pagination').style.display = 'block';
    }else{
        document.getElementById('pagination').style.display = 'none';
    }
    var URL = "module/staff/action/staffSearch.php?dummy=" + Math.random();
    var data = getFrmData('search');
    ajaxLoadFrw('post', URL, data, 'list');
}
function staffHoliday(){
    var URL = "module/staff/action/staffHoliday.php?dummy=" + Math.random();
    var data = getFrmData('holidayForm');
    document.getElementById('holidayProcess').innerHTML = "Saving...";
    ajaxLoadFrw('post', URL, data, 'list');
}
function deleteStaffHoliday(h_id, t_id){
    var URL = "module/staff/action/deleteStaffHoliday.php?dummy=" + Math.random();
    var data = "&h_id=" + h_id + "&t_id=" + t_id;
    ajaxLoadFrw('post', URL, data, '');
}
function staffProfile(){
    var URL = "module/staff/action/staffProfile.php?dummy=" + Math.random();
    var data = getFrmData('profileForm');
    document.getElementById('profileProcess').innerHTML = "Saving...";
    ajaxLoadFrw('post', URL, data, '');
}
function staffLeave(){
    if(document.getElementById('sl_leave_title').value==""){
        document.getElementById('sl_leave_title').focus();
    }else if(document.getElementById('fromDate').value==""){
        document.getElementById('fromDate').focus();
    }else if(document.getElementById('toDate').value==""){
        document.getElementById('toDate').focus();
    }else{
        var URL = "module/staff/action/staffLeave.php?dummy=" + Math.random();
        var data = getFrmData('leaveForm');
        document.getElementById('leaveProcess').innerHTML = "Saving...";
        ajaxLoadFrw('post', URL, data, '');
    }
}
function deleteLeave(id, t_id){
        var URL = "module/staff/action/deleteLeave.php?dummy=" + Math.random();
        var data = "&id=" + id + "&t_id=" + t_id;
        ajaxLoadFrw('post', URL, data, '');
}