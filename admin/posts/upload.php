<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>

<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $image_error = "";
    $pathImage = "";
    $imgEdit = "";
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        if(getimagesize($_FILES["fileToUpload"]["tmp_name"]) == "") {
            $imgEdit = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        } else {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        }
      
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $image_error = "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $image_error = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $image_error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $image_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $image_error = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
       if($image_error == "") {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $pathImage = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
            } else {
                $image_error = "Sorry, there was an error uploading your file.";
            }
       } else {
            $image_error = "Sorry";
       }
       
    }
?>