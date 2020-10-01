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

    
    let loginUri = `/steam/?uname=${Username}`;
    
    
    $.ajax({
        url: loginUri,
        type: 'GET',
        success: function(res) {
            var webSocket = new WebSocket(`ws://${endpoint}:2326`);
                webSocket.onopen = function (event) {
                webSocket.send(res);
                swal("Login Sent", `You've logged in as ${Username}`, "success");
            }           
        }
    }); 
    
}