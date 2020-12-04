<?php 
    session_start();
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['restaurantloggedin']) || $_SESSION['restaurantloggedin']!= true){
        header("location: restaurant_login.php");
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

    <title>Welcome <?php echo $_SESSION['restaurantname'] ?></title>
  </head>
  <body>

    <?php echo "welcome  to the restaurant section."; ?>
    <?php include './partials/_nav.php' ?>
    <br><br><br>

    <div class="container">
        <h1 class="text-center">Welcome <?php echo $_SESSION['restaurantname']?></h1>
        <a href="/food/view_rest_order.php"><button type="button" class="btn btn-info">View your orders</button></a> 
        <br><br>
        <a href="/food/add_menu_item.php"><button type="button" class="btn btn-info">Add Menu items</button></a> 
    </div>

    <?php // Here we will add our catalogue
 
            $restid=$_SESSION['restaurantid'];
            //$sql="SELECT * FROM menu_item m,restaurant r where m.restaurant_id = r.rest_id and r.rest_id = '$restid'";
            $sql="SELECT m.name, m.description, m.price , m.menu_id FROM menu_item m,restaurant r where m.restaurant_id = r.rest_id and r.rest_id = '$restid'";
            $result=$conn->query($sql);
            
            while($row = $result->fetch_assoc()){ ?>
             <div>
                <div>Name : <?php echo $row['name'] ?></div>
                <div>Description: <?php echo $row['description'] ?></div>
                <div>Price : <?php echo $row['price'] ?></div>
                <form action="/food/delete_menu.php" method = "POST">
                  <input type="hidden" name="menu_id" value=<?php echo ($row['menu_id']) ?> />
                  <button type="submit" class="btn btn-primary col-md-6">Delete Item</button>
                </form>
             </div>

    <?php };?>
    
    <h5>Want to signout?<a href="/food/logout.php">Sign out here</a> </h5>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>