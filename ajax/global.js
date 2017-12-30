//--------------------------------------Page Loading--------------------------------------
function formLoad(path, id, usrid){
    var URL = path + "?id=" + id + "&userid=" + usrid;
    var data = null;
    document.getElementById('content').innerHTML = "Loading...";
    ajaxLoadFrw("GET", URL, data, "content");
    alert(url);
}
//--------------------------------------Data insert--------------------------------------
function dataAdd(path, formId){
    var URL = path + "?dummy=" + Math.random();
    var data = getFrmData(formId);
    document.getElementById('process').innerHTML = "กำลังประมวลผล...";
    ajaxLoadFrw('post', URL, data, 'content');
} 
//--------------------------------------Data update--------------------------------------
function dataUpdate(path, formId){
    var URL = path + "?dummy=" + Math.random();
    var data = getFrmData(formId);
    document.getElementById('process').innerHTML = "กำลังประมวลผล...";
    ajaxLoadFrw('post', URL, data, 'content');
}
//--------------------------------------success alert action--------------------------------------
function alertClose(){
    document.getElementById('successAlert').style.display = 'none';
}
function alertClose1(){
    document.getElementById('successAlert1').style.display = 'none';
}
function alertClose2(){
    document.getElementById('successAlert2').style.display = 'none';
}
function deleteAlertClose(){
    document.getElementById('deleteAlert').style.display = 'none';
}
//--------------------------------------selector search box--------------------------------------
function msOverList(el){
    el.style.backgroundColor = '#00c0ef';
    el.style.cursor = 'pointer';
}
function msOutList(el){
    el.style.backgroundColor = '#f9fafc';
}
function hideList(){
    document.getElementById('listbox').style.display = 'none';
}
//--------------------------------------Data row delete--------------------------------------
function dbRowDelete(path, id, idRe){
    var URL = path + "?dummy=" + Math.random();
    var result = confirm("การลบข้อมูลอาจมีผลกระทบกับข้อมูลอื่นๆ ท่านแน่ใจหรือไม่ว่าต้องการลบข้อมูล");
    if(result){
	var data = "&id=" + id + "&idRe=" + idRe;
	ajaxLoadFrw('post', URL, data, '');
    }
}
//--------------------------------------open hidden data--------------------------------------
function openHide(id){
    if(document.getElementById(id).style.display == "none"){
        document.getElementById(id).style.display = "block";
    }else if(document.getElementById(id).style.display == "block"){
        document.getElementById(id).style.display = "none";
    }
}