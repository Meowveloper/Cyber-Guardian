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

<!-- php for insert, update and delete -->
<?php
session_start();
$email = $_SESSION['user']['email'];
include('dbconnect.php');
// defining of the values
if (isset($_POST['btnSubmit'])) {
  $title = $_POST['title'];
  $des = $_POST['description'];
  $info = $_POST['info'];
  if (isset($_FILES["simg"]) && $_FILES["simg"]["error"] == 0) {
    //Read file name
    $Filename = $_FILES["simg"]["name"];
    //Read file path
    $Filepath = $_FILES["simg"]["tmp_name"];
  }

  // Insert Query
  $sql = "INSERT INTO services (title, description, info,serviceImg) VALUES ('$title', '$des', '$info','$Filename')";
  if ($conn->query($sql) === TRUE) {
    echo " Insert Service setup successfully ";
    move_uploaded_file($Filepath, "images/" . $Filename);
    header("location:servicesSetup.php");
  }
  exit();
}
// Showing of text for inserted data
if (isset($_POST['btnUpdate'])) {
  $id = $conn->real_escape_string($_POST['id']);
  $title = $conn->real_escape_string($_POST['title']);
  $des = $conn->real_escape_string($_POST['description']);
  $info = $conn->real_escape_string($_POST['info']);
  if (isset($_FILES["simg"]) && $_FILES["simg"]["error"] == 0) {
    $Filename = $_FILES["simg"]["name"];
    $Filepath = $_FILES["simg"]["tmp_name"];
    move_uploaded_file($Filepath, "images/" . $Filename);
    $sql = "UPDATE services SET title='$title',  description='$des', info = '$info' ,serviceImg = '$Filename' WHERE id='$id'";
  } else {
    $sql = "UPDATE services SET title='$title',  description='$des', info = '$info' WHERE id='$id'";
  }


  if ($conn->query($sql) === TRUE) {
    header("location:servicesSetup.php");
  } else {
    echo "Error: " . $conn->error;
  }
}
// Delete Query
if (isset($_GET['deleteid'])) {
  $did = $_GET['deleteid'];
  $sql = "DELETE from services where id='$did'";
  if ($conn->query($sql) == True) {
    echo "<div> Delete One Record Successfully</div>";
    header("location:servicesSetup.php");
  }
}
// Edit Query
if (isset($_GET['editid'])) {
  $eid = $_GET['editid'];
  $sql = "SELECT * FROM services WHERE id='$eid'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
} else {
  $sql = "SELECT * FROM services";
  $result = $conn->query($sql);
}

?>

<body>
  <!-- Navbar start -->
  <?php include("adminnav.php"); ?>
  <!-- Navbar end -->
  <header>
    <h1 class="mt-3"><strong>Services Set up</strong></h1>
    <!-- Custom Cursors and 3D Illustrations can be added here -->
  </header>

  <main>
    <section id="contact" class="shadow back-color">
      <h2>Set Up In Here!</h2>
      <p>Welcome to the <strong>Services Set Up</strong> section. Here, you can create and manage services focused on online safety education. Provide a clear title, detailed description, additional info if needed, and upload an image representing the service.</p>
      <!-- Contact Form -->
      <form action="#" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo isset($row['title']) ? $row['title'] : ""; ?>" required />

        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea>

        <label for="info">info:</label>
        <textarea name="info" id="info" required><?php echo isset($row['info']) ? $row['info'] : ''; ?></textarea>

        <label for="image" class="form-label">Image:</label>
        <input class="form-control" type="file" id="image" name="simg" <?php echo isset($row['serviceImg']) ? '' : 'required'; ?> />
        <?php

        if (isset($_GET['editid'])) {
        ?>
          <label for="col" class="form-label">Pervious Image:</label>
          <img src="<?php echo "images\\" . $row['serviceImg']; ?>" width="100%" height="300px" alt="">
        <?php
        } else {
        ?>
          <img src="<?php echo "images\\" . $row['serviceImg']; ?>" alt="" hidden>
        <?php
        }
        ?>
        <?php if (isset($_GET['editid'])) { ?>
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
  <section id="newsletters rad">
    <div class="container table-responsive">
      <?php
      if ($result->num_rows > 0 && !isset($_GET['editid'])) {
      ?>
        <table class="table table-hover  table-info  overflow-hidden rounded">
          <tr class="table-dark">
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Information</th>
            <th scope="col">Publish Date</th>
            <th scope="col action">Action</th>
          </tr>
          <?php
          while ($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td class="responsive-text"><?php echo $row['id']; ?></td>
              <td><img src="<?php echo "images\\" . $row['serviceImg']; ?>" class="responsive-img" alt=""></td>
              <td class="responsive-text"><?php echo $row['title'] ?></td>
              <td class="responsive-text "><?php echo $row['description'] ?></td>
              <td class="responsive-text "><?php echo $row['info'] ?></td>
              <td class="responsive-text "><?php echo $row['createdate'] ?></td>
              <td class="action h-100">
                <a href="servicesSetup.php?editid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mt-1 mb-2  w-100">Edit</a>
                <a href="servicesSetup.php?deleteid=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm w-100">Delete</a>
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
  <!-- Footer Start -->
  <?php include("adminfooter.php") ?>
  <!-- Footer End -->
  <!-- Bootstrap 5 JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>