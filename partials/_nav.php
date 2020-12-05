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

  echo '
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/food/index.php">Foodshala</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">';
      if(!$loggedin){
        echo '<li class="nav-item active">
        <a class="nav-link" href="/food/menu.php">Menu<span class="sr-only">(current)</span></a>
        </li>';
      }
    if(!$loggedin && !$restaurantloggedin){
      echo '<li class="nav-item">
              <a class="nav-link" href="/food/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/loginsys/signup.php">Sign up</a>
            </li>';
    }
    if($loggedin || $restaurantloggedin){
      echo '
          <li class="nav-item">
              <a class="nav-link" href="/food/logout.php">Log out</a>
          </li>
      ' ;
    }

    if($loggedin){
      echo '
          <li class="nav-item">
            <a class="nav-link" href="/food/mycart.php">My Cart</a>
          </li>
      ';
    }

    echo  '</ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  " ' ;
?>
