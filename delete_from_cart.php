<?php 
    session_start();
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
        header("location: customer_login.php");
        exit;
    }
?>


<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['custid'])){
            echo "delete page";
            
            $menuid = $_POST['menuid'];
            $custid = $_POST['custid'];
            $sql="DELETE FROM cart WHERE custid = '$custid' and menuid = '$menuid' ";
       
            if($conn->query($sql))
            {
                header('location:mycart.php');
            }
            else
                {
                    echo "There is some error ..";
                }
            }
    }
    else{
        header('location: customer_dashboard.php');
    }

?>