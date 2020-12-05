<?php  
    session_start();   
    include 'partials/_dbconnect.php';
    $login = false;
    $showError = false ;
    if(isset($_SESSION['loggedin'])){ //||  $_SESSION['loggedin'] == true){
        echo "we have entered";
        header("location: customer_dashboard.php");
        exit;
    } 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = $_POST["password"] ;
        //$username = $_POST['username'];

        $query = "Select * from customer where email ='$email'" ;
        $result = mysqli_query($conn , $query);
        $num_of_rows = mysqli_num_rows($result);
        if($num_of_rows == 1){
            $row = mysqli_fetch_assoc($result);
            print_r($row);
            if(password_verify($password , $row["password"])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['name'] ;
                $_SESSION['custid'] = $row['cust_id'];
                $_SESSION['foodtype'] = $row['foodtype'];

                if(isset($_SESSION['restaurantloggedin'])){
                    unset($_SESSION['restaurantloggedin']);
                }
                
                header("location: customer_dashboard.php");
                exit ;
            }
          else{
          $showError = "Invalid credentials";
          }
        }
        else{
          $showError = "The user does not exist";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">  -->
    <link rel="stylesheet" href="assets/CSS/login-logout.css">
    <title>Login</title>
  </head>
  <body >
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

    <div>
        <div class="login-box">
            <h1 class="text-center">Customer sign in</h1>
                <form action="/food/customer_login.php" method="post">
                    <div class="textbox">
                        <!-- <i class="fas fa-user"></i> -->
                        <input type="email" maxlength = '40' placeholder="Email" name='email'>
                    </div>
                    <div class="textbox">
                        <!-- <i class="fas fa-lock"></i> -->
                        <input type="password"  name = 'password' placeholder="Password">
                    </div>
                    <button type="submit" class="sub-btn">Login</button>
                </form>
            <br><br>
            <h5>Don't have an account , <a href="/food/customer_signup.php">sign up</a> here.</h5>
        </div>


        <!-- <form action="/food/customer_login.php" method="post">
            <div class="form-group col-md-6" >
                <label for="email">Email</label>
                <input type="email" maxlength = '40' class="form-control" id="exampleInputEmail1" name='email' aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name = 'password'>
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Login</button>
        </form>
        <br><br>
        <h5>Don't have an account , <a href="/food/customer_signup.php">sign up</a> here.</h5>
    </div> -->


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