<?php 
    include 'partials/_dbconnect.php';
    $showAlert = false;
    $showError = false ;
    if($_SERVER["REQUEST_METHOD"] == "POST"){    
        $restaurantname = $_POST['restaurantname'];
        $password = $_POST["password"] ;
        $cpassword = $_POST["cpassword"] ;
        $email = $_POST['restaurantemail'];
        $city = $_POST['city'];                    //rest_id	name	email	password	city	
        echo $restaurantname , $password;
        $exists  = false ;
        $query = "select email from restaurant where email = '$email'";
        $isunique =  mysqli_num_rows(mysqli_query($conn , $query));
        if($isunique >0){
            $exists = true;
            $showError = "Restaurant already exists try to sign in instead.";
        }
        else {
          if($password == $cpassword ){
            echo "entered";
            $hash = password_hash($password , PASSWORD_DEFAULT  );
            $sql_query = "INSERT INTO `restaurant` (`name` ,`email`, `password`, `city`) VALUES 
            ('$restaurantname', '$email' ,'$hash' , '$city' )";
            $result = mysqli_query($conn , $sql_query); 
            echo "this is the result".$result ;
            if($result)  {
                echo "we have entered the second loop";
                $showAlert = true;
            }
        }
         else{
             $showError = "Passwords do not match";
         }
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
    <link rel="stylesheet" href="assets/CSS/login-logout.css">
    <title>Hello, world!</title>
  </head>
  <body>
    <?php 
     if($showAlert){
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your account has been created and you can <a href="/food/restaurant_login.php">log in</a> .
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

    <div class="login-box">
        <h1 class="text-center">Sign Up as Restaurant</h1>
        <form action="/food/restaurant_signup.php" method="post">
            <div class="textbox">
                <input type="text"  maxlength = '40' name='restaurantname' aria-describedby="emailHelp" placeholder = "Restaurant Name">
            </div>

            <div class="textbox">
                <input type="email"  maxlength = '40' name='restaurantemail' placeholder = "Email">
            </div>
            <div class="textbox">
                <input type="text"  maxlength = '40'  name='city' placeholder = "City">
            </div>
            <div class="textbox">
                <input type="password" name = 'password' placeholder = "Password">
            </div>
            <div class="textbox">                
                <input type="password" name="cpassword" placeholder = "Re-enter Password">
            </div>
            <button type="submit" class="sub-btn">Sign Up</button>
        </form>
        <h5>Already have a Restaurant registered? <a href="/food/restaurant_login.php">Log in</a></h5>
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