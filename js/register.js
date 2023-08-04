// Onclick function

$('#registerBtn').click(function () {
    submitEvent();
})

$("#username").on("keypress", function(event) {
    // Enter key is 13
    if (event.keyCode === 13) {
        submitEvent();
    }
});

$("#password").on("keypress", function(event) {
    // Enter key is 13
    if (event.keyCode === 13) {
        submitEvent();
    }
});

$("#confirmPassword").on("keypress", function(event) {
    // Enter key is 13
    if (event.keyCode === 13) {
        submitEvent();
    }
});

function submitEvent() {
    const username = $('#username').val();
    const password = $('#password').val();
    const confirmPassword = $('#confirmPassword').val();

    var regex=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;

    if(!username || !password || !confirmPassword) alert("Enter all the details!");
    else{
        if(!regex.test(password))   alert("Password should contain atleast 1 uppercase, 1 lowercase, 1 special character and 1 numerical value");
        else{
            if(password != confirmPassword) alert("Passwords does not match!")
            else{
                // Ajax request to register.php
                $.ajax({
                    type: 'POST',
                    url: './php/register.php',
                    data: {username: username, password: password},
                    success: function(response){
                        var status = response.status;
                        var message = response.message;
                        var id = response.id;
            
                        if(status === 'success')   window.location.href = "login.html";
                        else alert(message);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                })
            }
        }
    }
}


$('.showBtn').on('click', function() { 
    
    $passBtn = $('#password');
    $confirmPassBtn = $('#confirmPassword');

    if ($passBtn.attr('type') === 'password' && $confirmPassBtn.attr('type') === 'password') {
        $passBtn.attr('type', 'text');
        $confirmPassBtn.attr('type', 'text');
        $('#showBtn').text("Hide");
    } else {
        $passBtn.attr('type', 'password');
        $confirmPassBtn.attr('type', 'password');
        $('#showBtn').text("Show");
    }
});
