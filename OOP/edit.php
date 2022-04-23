<?php
require('methods.php');
require('connection/connect.php');

$id = $_GET['id'];

$sql = "select * from blogs where id = $id";
$connn=new conn();
$con= $connn->get_con();
$op  = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);




if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $object=new  methods();
  $title     = $object->Clean($_POST['title']);
  $content   = $object->Clean($_POST['content']);
  $date      = $object->Clean($_POST['date']);
  $image     = $_FILES['image'];

  $tit     = $object->validatetitle($title);
  $cont    = $object->validatecontent($content);
    
    if (!empty($tit) && !empty($cont)) {

        $sql = "update blogs set title='$title' , content = '$content' where  id = $id";

        $op =  mysqli_query($con, $sql);
        
        if ($op) {
            $message =  'Raw updated';
            # Set Message to Session
        
            $_SESSION['Message'] = $message;
        
            header("location: index.php");
        } else {
            echo 'Error Try Again ' . mysqli_error($con);
        }


    }



# Close Connection .... 
$con= $connn->clos_con();



}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Blog</h2>

        <form action="<?php echo   htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $data['id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="title" placeholder="Enter Name" value="<?php echo $data['title'] ?>">
            </div>
            <?php

if (isset($_POST['title'])) {
  if (!empty($errors['Title'])) {
    echo '<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    ' . $errors['Title'] . '
     </div>';
  } else {
    echo "<p> <font color=green>Valid Data </font> </p>";
    
  }
}
?>

            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="Enter Content" value="<?php echo $data['content'] ?>">
            </div>
            <?php

if (isset($_POST['content'])) {
  if (!empty($errors['Content'])) {

    echo '<div class="alert alert-danger" role="alert">
   <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
   <span class="sr-only">Error:</span>
   ' . $errors['Content'] . '
    </div>';
  } else {
    echo "<p> <font color=green>Valid Data </font> </p>";
   
  }
}
?>
            <div class="form-group">
                <label for="exampleInputEmail">Image Path</label>
                <input type="file" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp" name="image" placeholder="Enter image" value="<?php echo $data['image'] ?>">
            </div>
            <?php
        if (isset($_POST['register'])) {
          if (!empty($errors['Image'])) {
            echo '<div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          ' . $errors['Image'] . '
           </div>';
          } else {
            echo "<p> <font color=green>Uploaded Successfully </font> </p>";
          }
        }
        ?>
          


            <button type="submit" name="register" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>