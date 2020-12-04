<?php 
    include 'partials/_dbconnect.php';
    $showAlert = false;
    $showError = false ;
    if($_SERVER["REQUEST_METHOD"] == "POST"){    
        $username = $_POST['username'];
        $password = $_POST["password"] ;
        $cpassword = $_POST["cpassword"] ;
        $email = $_POST['email'];
        $foodtype = isset($_POST['non-veg'])?"non-veg":"veg";
        echo $username , $password;
        $exists  = false ;
        $query = "select email from customer where email = '$email'";
        $isunique =  mysqli_num_rows(mysqli_query($conn , $query));
        if($isunique >0){
            $exists = true;
            $showError = "User already exists try with other email.";
        }
        else {
          if($password == $cpassword ){
            echo "entered";
            $hash = password_hash($password , PASSWORD_DEFAULT  );
            $sql_query = "INSERT INTO `customer` (`name` ,`email`, `password`, `foodtype`) VALUES 
            ('$username', '$email' ,'$hash' , '$foodtype' )";
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

    <title>Hello, world!</title>
  </head>
  <body>
    <?php include './partials/_nav.php' ?>
    <?php 
     if($showAlert){
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your account has been created and you can <a href="/food/customer_login.php">log in</a> .
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
        <h1 class="text-center">Signup as customer</h1>
        <form action="/food/customer_signup.php" method="post">
            <div class="form-group col-md-6" >
                <label for="username">Username</label>
                <input type="text"  maxlength = '20' class="form-control" id="exampleInputEmail1" name='username' aria-describedby="emailHelp">
            </div>
            <br>
            
            <h6>Food type:</h6>
               <div class="form-group col-md-3">
                  <label for="veg">Veg</label>
                  <input  name="veg"  type="checkbox" class="form-control" >
                </div>
                <div class="form-group col-md-3">
                  <label for="non-veg">Non-Veg</label>
                  <input  name="non-veg"  type="checkbox" class="form-control">
                </div>

            <br>
            <div class="form-group col-md-6" >
                <label for="email">Email</label>
                <input type="email"  maxlength = '40' class="form-control" name='email' aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name = 'password'>
            </div>
            <div class="form-group col-md-6">
                <label for="cpassword">Re-enter Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Sign Up</button>
        </form>
        <br>
        <br>
        <br>
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