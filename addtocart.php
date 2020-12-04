<?php 
    session_start();
    $added = false;
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
        header("location: customer_login.php");
        exit;
    }
    elseif(isset($_SESSION['loggedin'])){
        if(isset($_POST)){
            echo "It will be added to the cart";
            $menu_id=$_POST['menu_id'];
            $cust_id =  $_SESSION['custid'];
            $sql="select * from cart where custid = '$cust_id' and menuid = '$menu_id'";
            $res=$conn->query($sql);
            print_r($res);
            
            if($res->num_rows==0){
                $sql="INSERT INTO cart (menuid , custid, qty) values ('$menu_id', '$cust_id','1')";
                echo $conn->query($sql);
            }
            else{
                // $menuid=$_POST['menu_id'];
                // $custid=$_SESSION['custuser']['cust_id'];
                $res=$res->fetch_assoc();
                $qty =$res['qty']+1;
                $sql="UPDATE cart SET qty ='$qty' where custid = '$cust_id' and menuid = '$menu_id'";
                $conn->query($sql);           
            }
        }      
    }
    header('location:customer_dashboard.php');
?>
<h1>Hey sssup I am the cart</h1>
<!-- php
    require 'db_connection.php';
    session_start();
    if(isset($_SESSION['custuser']))
    {   
        if(isset($_POST['submit'])){
            echo "Adding it to cart";
            $menuid=$_POST['menu_id'];
            $custid=$_SESSION['custuser']['cust_id'];
            $sql="SELECT * FROM cart where cust_id = '$custid' and menu_id = '$menuid'";
            $res=$conn->query($sql);
           
            if($res->num_rows==0)
            {$sql="INSERT INTO cart (cust_id,menu_id,num) values ('$custid','$menuid','1')";
            echo $conn->query($sql);
            }
            else{
                $menuid=$_POST['menu_id'];
                $custid=$_SESSION['custuser']['cust_id'];
                $res=$res->fetch_assoc();
                $cnt=$res['num']+1;
                $sql="UPDATE cart SET num ='$cnt' where cust_id = '$custid' and menu_id = '$menuid'";
                $conn->query($sql);
                
            }
        }

    }
        if(isset($_SESSION['menu']))
        {   unset($_SESSION['menu']);
            header('location:menu.php');
            exit();
        }
    header('location:customer_dashboard.php');

?> -->