<?php
session_start();
function validatetitle($title)
{
  global $errors;
  if (empty($title)) {

    $errors['Title']  = "Requierd";
  } 
  elseif (is_numeric($title) ) {

    $errors['Title']  = "Must Be String";
  }
  else {
    return $title;
  }
}
function validatecontent($content)
{
  global $errors;
  if (empty($content)) {
    $errors['Content']  = "Required";
  } elseif (strlen($content) <=   50) {
    $errors['Content']  = "Minumum is 50 ";
  } else {
    return $content;
  }
}
function validatefile($image)
{
  global $errors;

  if (!empty($image['name'])) {


    $name = $image['name'];
    $type = $image['type'];
    $tmp = $image['tmp_name'];
    $size = $image['size'];

    $arr = explode('/', $type);
    $ext = strtolower(end($arr));

    $allowedExt = ['jpg', 'png', 'jpeg'];



    if (in_array($ext, $allowedExt)) {

      $fname = time() . rand() . "." . $ext;
      $Path = 'uploads/' . $fname;
      uploadfile($tmp, $Path);
      return $fname;
    } else {
      $errors['Image']  = "Invalid Exstension";
    }
  } else {
    $errors['Image']  = "Required";
  }
}
function uploadfile($tmp, $Path)
{
  if (move_uploaded_file($tmp, $Path)) {

    return "image Uploaded";
  } else {

    return "image Uploaded Failed";
  }
}
function Clean($string)
{
  $output = stripslashes(strip_tags(trim($string)));

  return $output;
}

function read($name){
  $file    = fopen($name, 'r');
  while(!feof($file)){
      
    echo   fgets($file).'<br>';
    }
  

}

function writetxt($title, $content, $image)
{
  $file    = fopen('info.txt', 'a')  or die("can't open file");

  $text = "\n".$title . "|" . $content . "|" . $image ;

  fwrite($file, $text);
  
 
  fclose($file);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // CODE .... 


  $errors = [];
  $title     = Clean($_POST['title']);
  $content   = Clean($_POST['content']);
  $image     = $_FILES['image'];

  validatetitle($title);
  validatecontent($content);
  $con = validatefile($image);
  if (!empty(validatetitle($title)) && !empty(validatecontent($content)) &&!empty($con) ) {
   
    $tit     = validatetitle($title);
    $cont    = validatecontent($content);

    writetxt($tit, $cont, $con);
  }
  elseif(empty(validatetitle($title))||empty(validatecontent($content))){
    $errors['Image']  = "Requierd All Data";
  }
  
    
 
}
?>
<html>

<head>
  <title>ِBlog Details</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    <h2>Blog Details</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
            setcookie('Title', $_POST['title'], time() + 8565);
          }
        }
        ?>

      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Content</label>
        <input type="textarea" name="content" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

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
            setcookie('Content', $_POST['content'], time() + 8565);
          }
        }
        ?>


      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Image</label>
        <input type="file" name="image" class="form-control" id="exampleInputPassword1">
        <?php
        if (isset($_POST['register'])) {
          if (!empty($errors['Image'])) {
            echo '<div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          ' . $errors['Image'] . '
           </div>';
            // echo "<p> <font color=red>" . $errors['Image'] . "</font> </p>";
          } else {
            echo "<p> <font color=green>Uploaded Successfully </font> </p>";
          }
        }
        ?>

      </div>


      <button type="submit" name="register" class="btn btn-primary">Add Blog</button>


    </form>
  </div>

</body>

</html>