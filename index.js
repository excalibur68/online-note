//Ajax call for the sign up form
//once the form is submitted 
$("#signupform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
    //send them to signup.php using Ajax call
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost, 
        sucess: function(data){
            if(data){
                $("#signupmessage").html(data);
            }
        },
        error: function(){
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax call. Please try again later</div>");
        }
    });
});