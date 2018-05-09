<?php
//The user is re-directed to this file after clicking the activation link
//Signup link contains two GET parameters: email and activation key
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Account Activation</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            h1{
                color:orange;   
            }
            .contactForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style> 

    </head>
        <body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
            <h1>Account Activation</h1>
<?php
//If email or activation key is missing show an error
if(!isset($_GET['email']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the activation link you received by email.</div>'; exit;
}
//else
    //Store them in two variables
$email = $_GET['email'];
$key = $_GET['key'];
    //Prepare variables for the query
$email = mysqli_real_escape_string($link, $email);
$key = mysqli_real_escape_string($link, $key);
    //Run query: set activation field to "activated" for the provided email
$sql = "UPDATE users SET activation='activated' WHERE (email='$email' AND activation='$key') LIMIT 1";
$result = mysqli_query($link, $sql);
    //If query is successful, show success message and invite user to login
if(mysqli_affected_rows($link) == 1){
    echo '<div class="alert alert-success">Your account has been activated.</div>';
    echo '<a href="index.php" type="button" class="btn-lg btn-sucess">Log in<a/>';
    
}else{
    //Show error message
    echo '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    
}
?>
            
        </div>
    </div>
</div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
</html>