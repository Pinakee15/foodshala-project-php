<?php  
    session_start();   

    $login = false;
    $showError = false ;
    if(isset($_SESSION['restaurantloggedin'])){ //||  $_SESSION['loggedin'] == true){
        echo "we have entered";
        header("location: restaurant_section.php");
        exit;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'partials/_dbconnect.php'; 
        $email = $_POST['email'];
        $password = $_POST["password"] ;

        $query = "Select * from restaurant where email ='$email'" ;
        $result = mysqli_query($conn , $query);
        $num_of_rows = mysqli_num_rows($result);
        if($num_of_rows == 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password , $row["password"])){
                $login = true;
                session_start();
                $_SESSION['restaurantloggedin'] = true;
                $_SESSION['restaurantname'] = $row['name'] ;
                $_SESSION['restaurantid'] = $row['rest_id'];
                header("location: restaurant_section.php");
            }
          else{
          $showError = "Invalid credentials";
          }
        }
        else{
          $showError = "The restaurant does not exist";
        }
    }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <?php include './partials/_nav.php' ?>
    <?php 
     if($login){
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You are logged in.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ' ;
     }
     elseif($showError){
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> '.$showError.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ' ; 
     }
    ?>

    <div class="container">
        <h1 class="text-center">Login to your Restaurant</h1>
        <form action="/food/restaurant_login.php" method="post">
            <div class="form-group col-md-6" >
                <label for="email">Restaurant Email</label>
                <input type="email" maxlength = '20' class="form-control" id="exampleInputEmail1" name='email' aria-describedby="emailHelp">
                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name = 'password'>
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Login</button>
        </form> <br><br>
        <h5>Do not have your Restaurant registered? <a href="/food/restaurant_signup.php">Sign up</a> today!</h5>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>