// Onclick function

$('#loginBtn').click(function () {
    const username = $('#username').val();
    const password = $('#password').val();

    console.log("username", username);
    console.log("password", password);

    // Ajax request to login.php
    $.ajax({
        type: 'POST',
        url: 'https://chandramouliat.infinityfreeapp.com/login.php',
        data: {username: username, password: password},
        success: function(res){
            if(res === 'Hi')   window.location.href = "register.html";
            else alert(res);
        }
    })
})
