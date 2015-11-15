<?php
if(isset($_FILES['photo'])){
    $mysqli = new mysqli("127.0.0.1:3306", "root", "admin123", "tutorial_cameraupload");
    if(mysqli_connect_errno()){
        echo "Please check your database connection!";
        exit;
    }

    if(!file_exists("upload")){
        mkdir("upload", 0777);
    }

    $filename = $_FILES['photo']['name'];
    $description = $_POST['description'];
    move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/'.$filename);

    $sql = "INSERT INTO photo (`path`, `description`) VALUES (?, ?) ";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param("ss", $filename, $description);
    $statement->execute();

    if($statement->affected_rows > 0){
        echo "Upload photo success";
    }else{
        echo "Upload photo failed. " + $statement->errno;
    }

    $statement->close();
    $mysqli->close();
}else{
    echo "No File!";
}
?>
