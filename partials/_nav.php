<?php 

  //session_start();
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $loggedin = true;
  }
  else{
    $loggedin = false;
  }
  
  if(isset($_SESSION['restaurantloggedin']) && $_SESSION['restaurantloggedin'] == true){
    $restaurantloggedin = true ;
  }
  else{
    $restaurantloggedin = false;
  }
?>

<?php  echo '

<!DOCTYPE html>
<html>

<head>
    <title>FoodShala!</title>
    <!-- Favicon  Link -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/img/site.webmanifest">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External CSS -->
    <link rel="stylesheet" href="assets/CSS/style.css">

    <!-- Owl CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Home Section -->
    <div id="main-home">
        <!-- Header -->
        <div class="container">
            <!-- Header -->
            <header class="">
                <!-- navigation -->
                <nav class="navbar navbar-expand-lg navbar-light px-0">
                    <!-- <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="" width="150px"></a> -->
                    <a class="navbar-brand" href="/food/index.php"><h3 style="padding-left: 18px; padding-top: 10px;" >Food<span class="color-pink" >Shala</span></h3></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto"> ';
                            echo '<li class="nav-item active">
                                  <a class="nav-link" href="/food/index.php">Home<span class="sr-only">(current)</span></a>
                                </li>';   

                            if(!$loggedin){
                                echo '<li class="nav-item ">
                                <a class="nav-link" href="/food/menu.php">Menu<span class="sr-only">(current)</span></a>
                                </li>';
                              }
                            if($loggedin){
                              echo '
                                <div class="nav-item">
                                  <a class="nav-link bg-pink text-white rounded cart" href="mycart.php"><i class="fas fa-shopping-cart"></i> </a>
                                </div>
                              ';
                            }
                            if($loggedin || $restaurantloggedin){
                              echo '
                                  <li class="nav-item">
                                      <a class="nav-link" href="/food/logout.php">Log out</a>
                                  </li>
                              ' ;
                            }
                      echo '
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
      
'; ?>