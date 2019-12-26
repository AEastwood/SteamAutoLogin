function login(Username) {
    if(!Username){
        swal("Login Failed", `Username or Password Invalid`, "error");
    }
    else {
        CreateLoginRequest(Username);
    }
}

function CreateLoginRequest(Username) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            swal("Login Sent", `You've logged in as ${Username}`, "success");
        }
    };
    xhttp.open("GET", `http://192.168.1.75/loginv2/docommand.php?command=login&username=${Username}`, true);
    xhttp.send();
}