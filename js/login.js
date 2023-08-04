// Onclick function

$('#loginBtn').click(function () {
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


function submitEvent() {
    const username = $('#username').val();
    const password = $('#password').val();

    if(!username || !password) alert("Enter all the details!");
    else{
        // Ajax request to login.php
        $.ajax({
            type: 'POST',
            url: './php/login.php',
            data: {username: username, password: password},
            success: function(response){
                var status = response.status;
                var message = response.message;
                var id = response.id;
    
                if(status === 'success'){

                    const userData = { username: username, id: id };
                    localStorage.setItem('userData', JSON.stringify(userData));

                    window.location.href = "profile.html";
                }   
                else alert(message);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        })
    }
}

$('.showBtn').on('click', function() { 
    
    $passBtn = $('#password');

    if ($passBtn.attr('type') === 'password') {
        $passBtn.attr('type', 'text');
        $('#showBtn').text("Hide");
    } else {
        $passBtn.attr('type', 'password');
        $('#showBtn').text("Show");
    }
});
