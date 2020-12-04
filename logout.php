
<?php

    session_start();    
    if(isset($_SESSION['restaurantloggedin']))
    {   
        session_unset();
        session_destroy();
        header('location:restaurant_login.php');
    }
    if(isset($_SESSION['loggedin']))
    {   
        session_unset();
        session_destroy();
        header('location:customer_login.php');
    }

?>