<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];
//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQL_ASSOC); 
    $username = $row['username'];
}else{
    echo "There was an error retrieving the username from the database";   
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="styling.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <title>My Notes</title>
      <style>
        #container{
            margin-top:120px;   
        }

        #notePad, #allNotes, #done, .delete{
            display: none;   
        }

        .buttons{
            margin-bottom: 20px;   
        }

        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: lightblue;
            color: #CA3DD9;
            background-color: #FDF1FF;
            padding: 10px;
              
        }
        
        .noteheader{
            width: 100%;
            border: 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            background: linear-gradient(#FFFFFF,#ECEAE7);
        }
          
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
          
        .timetext{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .notes{
            margin-bottom: 100px;
        }

      </style>
  </head>
  <body>
    <!--Navigation Bar-->  
      <nav role="navigation" class="navbar navbar-custom fixed-top navbar-expand-lg">
      
          <div class="container-fluid">
                  <div class="navbar-brand">Online Notes</div>
                  <button type="button" class="navbar-toggler collapsed" data-target="#navbarCollapse" data-toggle="collapse">
                      <span class="navbar-toggler-icon"><img src="images/myNav.png" class="logo"></span>
                  </button>
              <div class="navbar-collapse collapse" id="navbarCollapse">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        Contact us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><span class="sr-only">(current)</span>My Notes</a>
                    </li>
                  </ul>
                  <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="#">Logged in as <b><?php echo $username; ?></b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="index.php?logout=1">Log out</a>
                      </li>
                  </ul>  
              </div>
          </div>
      
      </nav>
    
<!--Container-->
      <div class="container" id="container">
          <!--Alert Message-->
          <div id="alert" class="alert alert-danger collapse">
              <a class="close" data-dismiss="alert">
                &times;
              </a>
              <p id="alertContent"></p>
          
          </div>
          <div class="row">
              <div class="col-md-6 offset-md-3">
                  <div class="buttons">
                      <button id="addNote" type="button" class="btn btn-info btn-lg">Add Note</button>
                      <button id="edit" type="button" class="btn btn-info btn-lg float-right">Edit</button>
                      <button id="done" type="button" class="btn green btn-lg float-right">Done</button>
                      <button id="allNotes" type="button" class="btn btn-info btn-lg">All Notes</button>
                  </div>
                  
                  <div id="notePad">
                      <textarea rows="10"></textarea>
                  </div>
                  
                  <div id="notes" class="notes">
<!--                  Ajax call to a php file-->
                  </div>
              
              </div>
          </div>
      </div>

    <!-- Footer-->
      <div class="footer">
          <div class="container">
              <p>Yan Cao Copyright &copy; 2015-<?php $today = date("Y"); echo $today?>.</p>
          </div>
      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="mynotes.js"></script>  
  </body>
</html>