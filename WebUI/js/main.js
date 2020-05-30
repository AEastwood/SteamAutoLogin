function login(Username, endpoint) {
    endpoint = (endpoint) ? endpoint : 'localhost';

    if(!Username){
        swal("Login Failed", `Username or Password Invalid`, "error");
    }
    else {
        CreateLoginRequest(Username, endpoint);
    }
}

function CreateLoginRequest(Username, endpoint) {
    let loginUri = `/docommand.php?command=login&username=${Username}`;

    $.ajax({
        url: loginUri,
        type: 'GET',
        success: function(res) {
            var webSocket = new WebSocket(`wss://${endpoint}:2326`);
                webSocket.onopen = function (event) {
                webSocket.send(res);
                swal("Login Sent", `You've logged in as ${Username}`, "success");
            }           
        }
    }); 
    
}