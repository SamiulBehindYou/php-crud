<?php session_start(); 
require 'crud_db.php';

// Data select from database for read
$select = "SELECT * FROM data";
$mysql = mysqli_query($conn, $select);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CURD Operation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<style>
  body{
    overflow-x: hidden;
  }
</style>
</head>
<body>
  <!-- Header Section -->
   <div class="row">
    <div class="col-lg-12 p-2 bg-info m-auto">
      <h1 class="text-center text-white">CURD Oparation</h1>
    </div>
   </div>
  <div class="container">

    <!-- Alert success message will show here!  -->
     <?php if(isset($_SESSION['success'])){ ?>
     <div class="alert alert-success mt-2">
      <strong class="text-center text-success">
        <?php echo $_SESSION['success']; ?>
      </strong>
     </div>
     <?php } unset($_SESSION['success']);?>

    <!-- Alert error message will show here!  -->
    <?php if(isset($_SESSION['error'])){ ?>
     <div class="alert alert-error">
      <strong class="text-center text-error">
        <?php echo $_SESSION['error']; ?>
      </strong>
     </div>
     <?php } unset($_SESSION['error']);?>

  <!-- Create Section -->
    <div class="row">
      <div class="col-lg-6 m-auto mt-2 bg-info rounded">
        <div class="mb-3">
        <h1 class="text-center text-white">Create</h1>
        </div>
        <form action="action.php" method="POST">
          <div class="mb-3">
            <input type="text" name="data" class="form-control" placeholder="Cerate your text here!">
          </div>
          <div class="mb-3">
            <input type="submit" name="submit" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>

    <!-- Read Section -->
    <div class="row">
      <div class="col-lg-6 m-auto mt-2 bg-info rounded">
        <div class="mb-3">
          <h1 class="text-center text-white">Read</h1>
        </div>
        <div class="mb-3">
          <table class="table rounded">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Data</th>
              </tr>
            </thead>
            <tbody class="tbody-light">
              <?php 
              if($mysql->num_rows > 0){
                
              foreach($mysql as $read){ ?>
              <tr>
                <td><?= $read['id']; ?></td>
                <td><?= $read['data']; ?></td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
        </div>        
      </div>
    </div>
    
    <!-- Update Section -->
    <div class="row">
      <div class="col-lg-6 m-auto mt-2 bg-info rounded">
        <div class="mb-3">
        <h1 class="text-center text-white">Update</h1>
        </div>
        <form action="action.php" method="POST">
          <div class="mb-3">
            <label class="form-label text-white">Select your data ID</label>
            <select name="updateID" class="form-control">
              <?php 
              foreach($mysql as $reada){ ?>
              <option value="<?= $reada['id'] ?>"><?= $reada['id'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="text" name="updated_data" class="form-control" placeholder="Update your data here!">
          </div>
          <div class="mb-3">
            <input type="submit" name="update" value="Update" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>

    <!-- Photo Update Section -->
    <div class="row">
      <div class="col-lg-6 m-auto mt-2 bg-info rounded">
        <div class="mb-3">
        <h1 class="text-center text-white">Photo Update</h1>
        </div>
        <form action="action.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label text-white">Select your data ID</label>
            <select name="photoupdateID" class="form-control">
              <?php 
              foreach($mysql as $reada){ ?>
              <option value="<?= $reada['id'] ?>"><?= $reada['id'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="file" name="photo_updated_data" class="form-control" placeholder="Update your data here!" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
            <img id="blah" class="mt-3 rounded" width="200"/>
          </div>
          <div class="mb-3">
            <input type="submit" name="photoupdate" value="Update Photo" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Section -->
    <div class="row">
      <div class="col-lg-6 m-auto mt-2 bg-info rounded">
        <div class="mb-3">
        <h1 class="text-center text-white">Delete</h1>
        </div>
        <form action="action.php" method="POST">
          <div class="mb-3">
            <label class="form-label text-white">Select your data ID</label>
            <select name="deleteID" class="form-control">
            <?php 
              foreach($mysql as $reada){ ?>
              <option value="<?= $reada['id'] ?>"><?= $reada['id'] ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="submit" name="delete" value="Delete" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>


  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script href="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>