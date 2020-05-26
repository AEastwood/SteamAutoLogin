function login(Username) {
    if(!Username){
        swal("Login Failed", `Username or Password Invalid`, "error");
    }
    else {
        CreateLoginRequest(Username);
    }
}

function CreateLoginRequest(Username) {
    let loginUri = `/docommand.php?command=login&username=${Username}`;
    var showFailure = true;

    $.ajax({
        url: loginUri,
        type: 'GET',
        success: function(res) {
            var webSocket = new WebSocket(`wss://localhost:2326`);
                webSocket.onopen = function (event) {
                webSocket.send(res);
                webSocket.onclose = function (event) {
                    swal("Login Sent", `You've logged in as ${Username}`, "success");
                }
            };
            
        }
    }); 
    
}