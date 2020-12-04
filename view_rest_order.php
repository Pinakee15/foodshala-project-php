<?php 
    session_start();
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['restaurantloggedin']) || $_SESSION['restaurantloggedin']!= true){
        header("location: restaurant_login.php");
        exit;
    }
?>

<?php 
    echo "these are your orders."
?>

<html>
<head>
    <title></title>
    <title>FoodShala</title>
      <link rel="stylesheet" href="mycart.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
   
<table class="table">
  <caption><?php echo "Logged in as: ".$_SESSION['restaurantname']?></caption>
  <thead>
    <tr>
      <th scope="col">Customer Name</th>
      <th scope="col">Item Ordered</th>
      <th scope="col">Address</th>
      <th scope="col">Quantity</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $restid=$_SESSION['restaurantid'];
        $sql="SELECT c.name as customername , m.name as foodname ,qty, o.time as ordertime , o.address as customeraddress 
              FROM orders o , menu_item m ,customer c where m.menu_id = o.menu_id and o.cust_id=c.cust_id  and m.restaurant_id= '$restid'";
        $result=$conn->query($sql);
        $total=0;
        while($row= $result->fetch_assoc())
        {?>
            <tr>
                <td><?php echo ucfirst($row['customername'])?></td>
                <td><?php echo $row['foodname']?></td>
                <td><?php echo $row['customeraddress']?></td>
                <td><?php  echo $lt=$row['qty'] ?></td>
                <td><?php  echo $lt=$row['ordertime'] ?> </td>
            </tr>
        <?php }?>
  </tbody>
</table>
    </div>
    
    <footer style="position:fixed;bottom:0;display:block;width:100%;background-color:black;color:white" class="page-footer font-small dark">

      
      <div class="footer-copyright text-center py-3">@ Developed by:
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGKZZzmFqnsdwsSNVWmLQxkbkkZMhCbWqMbGTBLQtQqNCmppDFDbWgzHrmwtQjtFmQJjXnC"><em>Raj Kaushik</em></a>
      </div>
    
    
    </footer>
</body>
</html>