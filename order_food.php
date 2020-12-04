<?php 
    session_start();
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
        header("location: customer_login.php");
        exit;
    }

    elseif(isset($_SESSION['loggedin'])){
        if(isset($_POST)){
            echo "It will be ordered";
            $cust_id = $_SESSION['custid'];
            $address = $_POST['address'];
            $sql = $sql="select * from cart where custid = '$cust_id'";
            $res=$conn->query($sql);
            while($row= $res->fetch_assoc())
            {   $menu_id=$row['menuid'];
                $qty=$row['qty'];
                $sql = "INSERT INTO `orders` (`cust_id`, `menu_id`, `qty`, `address`) VALUES ('$cust_id', '$menu_id',  '$qty', '$address');";
                $conn->query($sql);
            }

            $sql="DELETE from cart where custid = '$cust_id'";
            $conn->query($sql);
        }      
    }
    header('location:customer_dashboard.php');

?>

<?php echo "this is the checkout page" ?>
