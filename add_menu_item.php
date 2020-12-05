<?php 
    session_start();
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['restaurantloggedin']) || $_SESSION['restaurantloggedin']!= true){
        header("location: restaurant_login.php");
        exit;
    }
?>

<?php  	 
    
    $showAlert = false;
    $showError = false ;
    if($_SERVER["REQUEST_METHOD"] == "POST"){  
        $name = $_POST['name'];
        $restaurant_id = $_SESSION['restaurantid'];
        $description = $_POST['description'];
        $type = isset($_POST['non-veg'])?"non-veg":"veg";
        $price = $_POST['price'];
        $timestamp = htmlspecialchars(date("d-m-y-h-i-s-ms"));
        
        // file upload
        if(isset($_FILES['itemimage'])){
            $file_name = $_FILES['itemimage']['name'];
            $file_tmp = $_FILES['itemimage']['tmp_name'];
            move_uploaded_file($file_tmp , "uploadedfiles/".$timestamp.".png");
        }

        echo $username , $password;
        $exists  = false ;
        $query = "select name from menu_item where name = '$name'";
        $isunique =  mysqli_num_rows(mysqli_query($conn , $query));
        if($isunique >0){
            $exists = true;
            $showError = "Item already in the menu.";
        }
        else {
            echo "entered";
            $sql_query = "INSERT INTO `menu_item` (`menu_id`, `restaurant_id`, `name`, `price`, `type`, `description` , `timestamp`) 
            VALUES (NULL, '$restaurant_id', '$name', '$price', '$type', '$description' , '$timestamp');" ;
            $result = mysqli_query($conn , $sql_query); 
            echo "this is the result".$result ;
            if($result)  {
                echo "we have entered the second loop";
                $showAlert = true;
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
                <strong>Success!</strong> Added to your catalogue. Want to add more items?</a> .
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
        <h1 class="text-center">Add the item to your catalogue</h1>
        <form action="/food/add_menu_item.php" method="post" enctype="multipart/form-data" >
            <div class="form-group col-md-6" >
                <label for="name">Item Name</label>
                <input type="text"  maxlength = '40' class="form-control" id="exampleInputEmail1" name='name' aria-describedby="emailHelp">
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
                <label for="price">Price</label>
                <input type="number"  maxlength = '40' class="form-control" name='price' aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group col-md-6">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name = 'description'>
            </div>
            <div class="form-group col-md-6">
                 <label for="itemimage">Upload item image</label>
                 <input style="padding:3px;" required name="itemimage"  type="file" class="form-control" id="inputPassword4" >
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Add Item</button>
        </form>
         <br>
        <br>
        <br>
        <a href="/food/restaurant_section.php"><button type="submit" class="btn btn-primary col-md-3">Back to catalogue</button></a>
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