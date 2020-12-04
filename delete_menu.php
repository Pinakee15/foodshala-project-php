<?php 
    session_start();
    include 'partials/_dbconnect.php';
    if(!isset($_SESSION['restaurantloggedin']) || $_SESSION['restaurantloggedin']!= true){
        header("location: restaurant_login.php");
        exit;
    }
?>
<?php echo $id=$_POST['menu_id'];?>  

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['menu_id'])){
            echo "delete page";
            
            $menu_id=$_POST['menu_id'];
            $sql="DELETE FROM menu_item WHERE menu_id = '$menu_id'";
       
            if($conn->query($sql))
            {
                echo "Item Deleted Successfully";
                header('location:restaurant_section.php');
            }
            else
                {
                    echo "Couldn't Delete Item, Try again later";
                }
            }
    }


    if(isset($_POST['submit']))
    {   echo "Deleting......\n";
        $id=$_POST['menu_id'];

        $sql="DELETE FROM menu_item WHERE menu_id = '$id'";
       
        if($conn->query($sql))
        {
            echo "Item Deleted Successfully";
            header('location:restaurant_section.php');
        }
        else
            {
                echo "Couldn't Delete Item, Try again later";
            }

    }
?>