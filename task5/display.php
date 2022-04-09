<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {


$image=$_POST['image'];



if(isset($_POST['delete'])){


  $oldMessage = $image;

  $deletedFormat = '';
  
  
  $str=file_get_contents('info.txt');
  
  
  $str=str_replace($oldMessage, $deletedFormat,$str);
  
  //write the entire string
  file_put_contents('info.txt', $str);
        

}




}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="row">

  <?php
 $file = fopen('info.txt', 'r');
 while(!feof($file)){
     
   $blogs = explode('|',fgets($file));

   
   echo'
   <div class="col-sm-2">
    <div class="card">
    <img width="206px" height="50" src="uploads/'.$blogs[2].'" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Title :'.$blogs[0].'</h5>
        <h6 class="card-text">Content :'.$blogs[1].'</h6>';
       
      echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';

       echo' <input type="hidden" id="custId" name="title" value="'.$blogs[0].'">
        <input type="hidden" id="custId" name="content" value="'.$blogs[1].'">
        <input type="hidden" id="custId" name="image" value="'.$blogs[2].'">
        <button type="submit" name="delete" class="btn btn-primary">Delete Photo</button>
        </form>
      </div>
    </div>
  </div>';
  
 

   }
  
fclose($file);
 
  
  ?>
 
 
</div>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>