<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Safety Campaign</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">
  </head>
  <!-- php for insert, update and delete --->
  <?php 
    include('dbconnect.php');
  // defining of the values
    if(isset($_POST['btnSubmit']))
    {
      $heading=$_POST['heading'];
      $messaging=$_POST['messaging'];

      if(isset($_FILES["image1"])&& $_FILES["image1"]["error"]==0)
      {
          //Read file name
          $Filename1=$_FILES["image1"]["name"];
          //Read file path
          $Filepath1=$_FILES["image1"]["tmp_name"];
      }
      if(isset($_FILES["image2"])&& $_FILES["image2"]["error"]==0)
      {
          //Read file name
          $Filename2=$_FILES["image2"]["name"];
          //Read file path
          $Filepath2=$_FILES["image2"]["tmp_name"];
      }
    // Insert Query
      $sql="INSERT INTO howparenthelp (heading, messaging, image1, image2) VALUES ('$heading', '$messaging', '$Filename1','$Filename2')";
      if($conn->query($sql)==TRUE)
      {
        echo " Insert How Parent Help setup successfully ";
        move_uploaded_file($Filepath1, "images/". $Filename1);
        move_uploaded_file($Filepath2, "images/". $Filename2);
        header("location:howparenthelpSetup.php");
        exit();
      }
    }
    // Showing of text for inserted data
    if (isset($_POST['btnUpdate'])) {
      $id = $conn->real_escape_string($_POST['id']);
      $heading = $conn->real_escape_string($_POST['heading']);
      $messaging = $conn->real_escape_string($_POST['messaging']);
      $sql = "UPDATE howparenthelp SET description='$des";
    
      if (isset($_FILES["image1"]) && $_FILES["image1"]["error"] == 0) {
        $Filename1 = $_FILES["image1"]["name"];
        $Filepath1 = $_FILES["image1"]["tmp_name"];
        move_uploaded_file($Filepath1, "images/" . $Filename1);
        $sql .= ", image1='$Filename1'";
      } 
      if (isset($_FILES["image2"]) && $_FILES["image2"]["error"] == 0) {
        $Filename2 = $_FILES["image2"]["name"];
        $Filepath2 = $_FILES["image2"]["tmp_name"];
        move_uploaded_file($Filepath2, "images/" . $Filename2);
        $sql .= ", image1='$Filename2'";
      } 
      else {
        $sql = "UPDATE howparenthelp SET heading='$heading', messaging='$messaging' WHERE id='$id'";
      }
    
      if ($conn->query($sql) === TRUE) {
        header("location:howparenthelpSetup.php");
      } else {
        echo "Error: " . $conn->error;
      }
    }
    // Delete Query
    if(isset($_GET['deleteid'])){
      $did=$_GET['deleteid'];
      $sql="DELETE from howparenthelp where id='$did'";
      if($conn->query($sql)==True){
          echo"<div> Delete One Record Successfully</div>";
          header("location:howparenthelpSetup.php");
      }
    }


    // new edit query
    if (isset($_GET['editid'])) {
      $eid = $_GET['editid'];
      $sql = "SELECT * FROM howparenthelp WHERE id='$eid'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
  } else {
      $sql = "SELECT * FROM howparenthelp";
      $result = $conn->query($sql);
  }
  ?>


  <body>
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
          <a class="link " href="adminhome.php">Home <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="link " href="servicesSetup.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="link " href="newsletterSetup.php">NewsLetter</a>
        </li>
        <li class="nav-item">
          <a class="link " href="howparenthelpSetup.php">HowParentHelp</a>
        </li>
        <li class="nav-item">
          <a class="link " href="socialmediaappSetup.php">SocialMediaApps</a>
        </li>
        <li class="nav-item">
          <a class="link " href="contactList.phpp">Help/Support</a>
        </li>
        <li class="nav-item">
          <a class="link " href="MemberList.php">MemberList</a>
        </li>
        <li class="nav-item ms-auto">
          <a class="link " href="logout.php"><i class="fa-solid fa-user"></i><i class="fa-solid fa-right-from-bracket"></i></a>
        </li>
      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
    </div>
  </nav>
  <header>
      <h1 class="mt-3"><strong>How Parent  Set up </strong></h1>
      <!-- Custom Cursors and 3D Illustrations can be added here -->
  </header>

    <main>
      <section id="contact" class="shadow back-color">
        <h2>Contact Us</h2>
        <p>
          Feel free to reach out to us using the contact form below. We
          appreciate your feedback and inquiries.
        </p>
        <!-- Contact Form -->
        <form action="#" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
            <label for="heading">Heading:</label>
            <input type="text" id="heading" name="heading" value="<?php echo isset($row['heading'])? $row['heading']:"";?>"required />

            <label for="messaging">Message:</label>
            <textarea name="messaging" id="messaging" required><?php echo isset($row['messaging']) ? $row['messaging'] : ''; ?></textarea>

            <label for="image1" class="form-label">Image1:</label>
            <input class="form-control" type="file" id="image1" name="image1" <?php echo isset($row['image1']) ? '' : 'required'; ?> />
       
            

            <label for="image2" class="form-label">Image2:</label>
            <input class="form-control" type="file" id="image2" name="image2" <?php echo isset($row['image2']) ? '' : 'required'; ?> />

            <div class="row ">
              <?php 
              if (isset($_GET['editid'])) {
                ?>
                <label for="col" class="form-label">Pervious Images:</label>
                <div class="col">
                  <img src="<?php echo "images\\" . $row['image1']; ?>" class="img-fluid" style=" width:100%; height: 150px;" alt="">
                </div>
                <div class="col">
                  <img src="<?php echo "images\\" . $row['image2']; ?>" class="img-fluid" style=" width:100%;height: 150px;" alt="">
                </div>
                <?php
              } else {
                ?>
                <div class="col">
                  <img src="<?php echo "images\\" . $row['image1']; ?>" class="img-fluid" style="width:100%;height: 150px;"alt="" hidden>
                </div>
                <div class="col">
                  <img src="<?php echo "images\\" . $row['image2']; ?>" class="img-fluid"  style="width:100%;height: 150px;"alt="" hidden>
                </div>
                <?php
              }
              ?>
          </div>
            


            <?php if(isset($_GET['editid'])) { ?>
              <button type="submit" name="btnUpdate">Update</button>
            <?php } else { ?>
              <button type="submit" name="btnSubmit">Create Post</button>
            <?php } ?>
        </form>      
        <!-- Privacy Policy Link -->
        <p>
          Before sending a message, please review our
          <a href="privacy-policy.html" target="_blank">Privacy Policy</a>.
        </p>
      <section>
    </main>
      <!-- Table Start -->
      <section id="newsletters rad" >
        <div class="container table-responsive">
          <?php
          if($result->num_rows > 0 && !isset($_GET['editid'])) {
          ?>
            <table border="1" class="table table-hover  table-info  overflow-hidden rounded">
              <tr class="">
                <th scope="col">ID</th>
                <th scope="col">Image1</th>
                <th scope="col">Image2</th>
                <th scope="col">Heading</th>
                <th scope="col">Content</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
              </tr>
              <?php
                while($row = $result->fetch_assoc()) {
              ?>
                <tr>
                  <td class="responsive-text"><?php echo $row['id']; ?></td>
                  <td><img src="<?php echo "images\\" . $row['image1']; ?>" class="responsive-img" alt=""></td>
                  <td><img src="<?php echo "images\\" . $row['image2']; ?>" class="responsive-img" alt=""></td>
                  <td class="responsive-text"><?php echo $row['heading']?></td>
                  <td class="responsive-text"><?php echo $row['messaging']?></td>
                  <td class="responsive-text"> <?php echo $row['date']; ?></td>
                  <td class="action h-100">
                  <a href="howparenthelpSetup.php?editid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mt-1 mb-2  w-100">Edit</a>

                  <a href="howparenthelpSetup.php?deleteid=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm w-100">Delete</a>
                  </td>
                  
                </tr>
              <?php
                }
              ?>
            </table>
            <?php
              }
            ?>
        </div>
      </section>
      <!-- Table End -->
    <footer>
      <p>You are here: Home</p>
      <div class="footer-content">
        <p>&copy; 2024 Online Safety Campaign</p>
        <!-- Add social media buttons with relevant links -->
        <a href="#" style="color: white">Facebook</a>
        <a href="#" style="color: white; margin-left: 10px">Twitter</a>
        <a href="#" style="color: white; margin-left: 10px">Instagram</a>
      </div>
    </footer>
    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
