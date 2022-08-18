const usernameInput = document.getElementById('username');
const roleInput = document.getElementById('role');
const emailInput = document.getElementById('email');
const nationalCodeInput = document.getElementById('national_code');
const statusInput = document.getElementById('status');

usernameInput.addEventListener('input', updateValue);
roleInput.addEventListener('input', updateValue);
emailInput.addEventListener('input', updateValue);
nationalCodeInput.addEventListener('input', updateValue);
statusInput.addEventListener('input', updateValue);

function updateValue(e) {
    username = document.getElementById('username').value;
    email = document.getElementById('email').value;
    nationalCode = document.getElementById('national_code').value;
    role = document.getElementById('role').value;
    status = document.getElementById('status').value;

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        const res = this.responseText;
        if (!res.includes("Too Many Requests")){
            document.getElementById("result").innerHTML = "";
            let myArr = res.split("-");
            for (let i = 0; i < myArr.length-1; ++i) {
                let split = myArr[i].split(":");
                document.getElementById("result").innerHTML += "<a href='/" + role + "/" + split[0] + "/edit" + "'>" + split[1] + "</a><br>";
                if (i >= 10) break;
            }
        }
    }
    xmlhttp.open("GET", "/admin/role/get?role=" + role + "&username=" + username + "&email=" + email + "&nationalCode=" + nationalCode + "&status=" + status);
    xmlhttp.send();
}
