<?php
session_start();
use GrahamCampbell\ResultType\Success;
require 'crud_db.php';

// Create Section
if(isset($_POST['submit'])){
    $data = $_POST['data'];

    $sqldata = "INSERT INTO data(data) VALUES('$data')";
    if($conn->query($sqldata)){
        $_SESSION['success'] = "Data inserted Sucessfully!";
        header('location:index.php');
    }
    else{
        $_SESSION['error'] = "Something went wrong!";
    }
}

// Update Section
if(isset($_POST['update'])){
    $updateid = $_POST['updateID'];
    $update = $_POST['updated_data'];

    $sqlupdate = "UPDATE data SET data = '$update' WHERE id = '$updateid'";
    if($conn->query($sqlupdate)){
        $_SESSION['success'] = "Data updated Sucessfully!";
        header('location:index.php');
    }
    else{
        $_SESSION['error'] = "Something went wrong!";
    }
}

// Photo Section
if(isset($_POST['photoupdate'])){
    $photoupdateid = $_POST['photoupdateID'];
    $photoupdate = $_FILES['photo_updated_data'];
    $after_explode = explode('.', $photoupdate['name']);
    $extension = end($after_explode);
    $extension_type = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if(in_array($extension, $extension_type)){
        if($photoupdate['size'] <= 1000000){
            $select = "SELECT image FROM data WHERE id = '$photoupdateid'";
            $select_data = $conn->query($select);
            $after_fetch = mysqli_fetch_assoc($select_data);
            
            // if($after_fetch['image'] != null){
            //     unlink('/uploads/iamges/'.$after_fetch['image']);
            // }
            // echo 'success';
            // die();
            
            $file_name = uniqid().'.'.$extension;
            $photo_sql = "UPDATE data SET image = '$file_name' WHERE id = $photoupdateid";
            if($conn->query($photo_sql)){
                move_uploaded_file($photoupdate['tmp_name'], 'uploads/images/'.$file_name);
                $_SESSION['success'] = 'Image updated successfully!';
                header('location:index.php');
            }else{
                $_SESSION['error'] = 'Something went wrong!';
                header('location:index.php');
            }
        }
        else{
            $_SESSION['error'] = 'File must be less then 1mb!';
            header('location:index.php');
        }
    }
    else{
        $_SESSION['error'] = 'Extension not acceptable!';
        header('location:index.php');
    }

}

// Delete Section
if(isset($_POST['delete'])){
    $deleteid = $_POST['deleteID'];
    $delete = "DELETE FROM data WHERE id = '$deleteid'";
    if($conn->query($delete)){
        $_SESSION['success'] = 'Data deleted successfully!';
        header('location:index.php');
    }
    else{
        $_SESSION['error'] = 'Something went wrong!';
        header('location:index.php');
    }
}
?>