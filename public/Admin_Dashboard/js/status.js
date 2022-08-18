function changeProfessorStatus (id){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {}
    xmlhttp.open("GET", "http://127.0.0.1:8000/admin/professor/status?id=" + id);
    xmlhttp.send();
}

function changeStudentStatus (id){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {}
    xmlhttp.open("GET", "http://127.0.0.1:8000/admin/student/status?id=" + id);
    xmlhttp.send();
}
