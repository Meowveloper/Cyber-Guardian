<nav class="navbar navbar-expand-lg ">
    <a class="navbar-brand  " href="#">
    <img src="images/logo.png" width="130px" height="70px" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ">
      <li class="nav-item  ">
        <a class="link " href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="link " href="information.php">Information</a>
      </li>
      <li class="nav-item dropdown">
        <a class="link data-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Campaigns</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="popular-apps.php">Popular-app</a></li>
          <li><a class="dropdown-item" href="parents-help.php">Parents Help</a></li>
          <li><a class="dropdown-item" href="livestreaming.php">Livestreaming</a></li>
        </ul>
      </li>
      <!-- updateing-->
      <li class="nav-item">
        <a class="link " href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="link " href="legislation.php">Legislation</a>
      </li>

    </ul>
    <div class="logout ">
    <a class=" " href="logout.php"><i class="fa-solid fa-user"></i><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
    
    
    <form class="form-inline my-2 d-flex flex-row gap-3 mr-20 w-35 form-responsive">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="profile">
      <img class="wh"src="<?= "images/" . $_SESSION['user']['profileImg'] ?>" alt="" />
    </div> 
  
  </div>
</nav>