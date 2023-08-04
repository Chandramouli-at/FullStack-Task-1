$(document).ready(function() {

    var user = JSON.parse(localStorage.getItem("userData"));
    if(user == null)    window.location.href = "login.html";
    var userId = user["id"];
    console.log(userId);

    var name, fname, lname, age, dob, email, contact;
    
    // Function to fetch session data from PHP
    function getData() {
        console.log("getData running")
      $.ajax({
        type: 'POST',
        url: './php/profile.php',
        data: { action: "sessionData", id: userId},
        dataType: 'json',
        success: function (response) {
            // alert(response.fname)
            if (response.fname) {
                console.log(response)
                $('#detailsBox').show();

                name = response.fname + " " + response.lname
                fname = response.fname;
                lname = response.lname;
                age = response.age;
                dob = response.dob;
                email = response.email;
                contact = response.contact;

                $('#displayName').text(name);
                $('#displayAge').text(age);
                $('#displayDob').text(dob);
                $('#displayEmail').text(email);
                $('#displayContact').text(contact);


            } else {
                console.log(response);
                $('#formBox').show();
            }
        },
        error: function (error) {
          console.error('Error fetching session data:', error);
        }
      });
    }
  
    // Call to get data
    getData();
  
    // Handle form submission
    $('#saveBtn').click(function(event) {
      event.preventDefault();
      // Get input values
      const fname = $('#fname').val();
      const lname = $('#lname').val();
      const age = $('#age').val();
      const dob = $('#dob').val();
      const email = $('#email').val();
      const contact = $('#contact').val();
  
      // Send input values to PHP using AJAX
      $.ajax({
        type: 'POST',
        url: './php/profile.php',
        dataType: 'json',
        data: { action: "save", id: userId, fname: fname, lname: lname, age: age, dob: dob, email: email, contact: contact },
        success: function (response) {
            if(response.userId){
                $('#displayName').text(fname + " " + lname);
                $('#displayAge').text(age);
                $('#displayDob').text(dob);
                $('#displayEmail').text(email);
                $('#displayContact').text(contact);
      
                $('#detailsBox').show();
                $('#formBox').hide();
            }
        }
      });
    });
  
    // Handle "Update" button click
    $('#updateBtn').click(function() {
        console.log("updateBtn Clicked")
        $('#detailsBox').hide();
        $('#formBox').show();

        $('#fname').attr('value', fname);
        $('#lname').attr('value', lname);
        $('#age').attr('value', age);
        $('#dob').attr('value', dob);
        $('#email').attr('value', email);
        $('#contact').attr('value', contact);
    });

    // Handle "Cancel" button click
    $('#cancelBtn').click(function() {
        console.log("cancelBtn Clicked")
        $('#detailsBox').show();
        $('#formBox').hide();
    });


    // Handle Logout
    $('#logoutBtn').click(function(event){
        event.preventDefault();

        localStorage.removeItem("userData");

        window.location.href = "login.html";
    })
  });