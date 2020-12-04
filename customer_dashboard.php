<?php 
    session_start();
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
        header("location: customer_login.php");
        exit;
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

    <title>Welcome <?php echo $_SESSION['username'] ?></title>
  </head>
  <body>
    <?php include './partials/_nav.php' ?>
    Welcome <?php echo $_SESSION['username'] ?>
    <br><br>
    <h4>Order your favourite meal from your favourite restaurant</h4> 
    <?php 
        //$sql = "select menu_id, name, type , price , description from menu_item m";
        $food_preference = $_SESSION['foodtype'];
        if($food_preference == 'veg'){
            $sql="SELECT m.name as item_name, m.type as item_type , m.description, m.price , m.menu_id , r.name as rest_name FROM menu_item m, restaurant r 
            where  m.type = 'veg'  and m.restaurant_id = r.rest_id";
        }
        else{
            $sql="SELECT m.name as item_name, m.type as item_type , m.description, m.price , m.menu_id , r.name as rest_name FROM menu_item m, restaurant r 
            where m.restaurant_id = r.rest_id";
        }
        
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) { ?>
             <div style = "padding : 30px ;" >
               <?php echo "<div> id: |".$row["menu_id"]."| - Name:  |".$row["item_name"]."| <br> ".$row["item_type"]."|  ".$row["price"]."|  ".$row["description"]." |".$row['rest_name']."</div><br>";                
               ?>  
               <form action="addtocart.php" method="POST">
                  <input type="hidden" name="menu_id" value=<?php echo ($row['menu_id']) ?> />
                  <input class="add" name="submit" type="submit" value="Add to Cart"/>
               </form>
             </div>
        <?php }
        }      
        else {
        echo "0 results";
        }  ?> 
    




    <!-- <h2>If you want to logout , you can logout from <a href='/food/logout.php'>here </a> </h2> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>