<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

  // CODE .... 
 $name     = $_POST['name'];
 $email    = $_POST['email'];
 $password = $_REQUEST['password'];
 $adrees   = $_POST['address'];
 $linked   = $_POST['link'];

 $errors = []; 

# Validate NAME ... 
if(empty($name) || is_numeric($name)==1 ){
  if(empty($name)){
      $errors['Name']  = "Required"; 
  }else{
   
      $errors['Name']  = "Must Be String";
  }

  
}


# VALIDATE EMAIL 
if(empty($email) || !preg_match("/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/ ", $email) ){
  if(empty($email))
  {

      $errors['Email']  = "Required"; 
  }
  else {
      $errors['Email']  = "Must Select an Valid Email"; 
  }
 
}


  # VALIDATE password 
 
  if(empty($password ) || (strlen($password) <=5) ){
      if(empty($password))
      {
          
          $errors['Password']  = "Required"; 
      }
      else {
          $errors['Password']  = "Min Length is 6 "; 
      }
      
    }
# Validate Adress .. 

  if(empty($adrees)||(strlen($adrees) <=10) ){
      if(empty($adrees))
      {
      $errors['Address']  = "Required"; 
    
      }
  else{
        $errors['Address']  = "Min Length is 10";
    }
  }
   # Validate LinkedIn .. 

   if(empty($linked)|| !preg_match("#^https?://www.+#",  $linked) ){
      if(empty($linked))
      {
      $errors['URL']  = "Required"; 
    
      }
  else{
        $errors['URL']  = "Must be a valid Link ";
    }
  }







}


?>
<html>
    <head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>
    <body>
 <form   action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <?php
    
    if(isset($_POST['name'])){
    if(!empty($errors['Name'])){
     echo "<p> <font color=red>".$errors['Name']."</font> </p>";
      }
      else{
        echo "<p> <font color=green>Valid Data </font> </p>";
      }
    }
    ?>
    
  </div>
<div class="form-group">
    <label for="exampleInputEmail1">email</label>
    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <?php
    
    if(isset($_POST['email'])){
    if(!empty($errors['Email'])){
     echo "<p> <font color=red>".$errors['Email']."</font> </p>";
      }
      else{
        echo "<p> <font color=green>Valid Data </font> </p>";
      }
    }
    ?>


  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    <?php
    
    if(isset($_POST['password'])){
    if(!empty($errors['Password'])){
     echo "<p> <font color=red>".$errors['Password']."</font> </p>";
      }
      else{
        echo "<p> <font color=green>Valid Data </font> </p>";
      }
    }
    ?> 
 
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Address</label>
    <input type="text" name="address" class="form-control" id="exampleInputPassword1">
    <?php
    if(isset($_POST['address'])){
    if(!empty($errors['Address'])){
     echo "<p> <font color=red>".$errors['Address']."</font> </p>";
      }
      else{
        echo "<p> <font color=green>Valid Data </font> </p>";
      }
    }
    ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">LinkedIn</label>
    <input type="text" name="link" class="form-control" id="exampleInputPassword1">
    <?php
    if(isset($_POST['link'])){
    if(!empty($errors['URL'])){
     echo "<p> <font color=red>".$errors['URL']."</font> </p>";
      }
      else{
        echo "<p> <font color=green>Valid Data </font> </p>";
      }
    }
    ?>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
   
    
</form> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>