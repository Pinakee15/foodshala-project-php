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
<body>
    <?php include './partials/_nav.php' ?>
    Welcome <?php echo $_SESSION['username'] ?> to your cart
    <br><br>
        <?php // Here we will add our catalogue
 
            $custid=$_SESSION['custid'];
            //$sql="SELECT * FROM menu_item m,restaurant r where m.restaurant_id = r.rest_id and r.rest_id = '$restid'";
            $sql="SELECT * FROM menu_item m, cart c where m.menu_id = c.menuid and c.custid= '$custid'";
            $result=$conn->query($sql);
            $total=0;
        ?>
    <table class="table">
      <caption><?php echo "Logged in as: ".$_SESSION['username']?></caption>
      <thead>
        <tr>
          <th scope="col">Food Name</th>
          <th scope="col">Quantity ordered</th>
          <th scope="col">Total Amount</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>         
         <?php while($row = $result->fetch_assoc()){ ?>
          <tr>   
            <td><?php echo ucfirst($row['name'])?></td>
            <td><?php echo $row['qty']?></td>
            <td><?php  $lt=$row['qty']*$row['price']; 
                        echo $lt;  
                        $total+=$lt; ?></td>
            <td><form action="delete_cart.php" method="POST">
                  <input type="hidden" value=<?php echo $row['custid'] ?> name="custid" />
                  <input type="submit" name="submit" value="Remove" class="btn btn-danger"/>
                </form>
            </td>
          </tr>
    <?php };?>
          <td>TOTAL</td>
          <td></td>
          <td><?php echo $total?></td>
          <td><form action="/food/order_food.php" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <input type="text" placeholder="Delivery Address" name = "address" required/>
                </div>
                <div class="form-group col-md-4">
                    <input <?php echo ($total==0)?"Disabled":"";?> type="submit" name="submit" value="Order Now" class="btn btn-primary"/>
                </div>
                </div>  
              </form>
            </td>
        </tr>
      </tbody>
    </table>
    




    <!-- <h2>If you want to logout , you can logout from <a href='/food/logout.php'>here </a> </h2> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>