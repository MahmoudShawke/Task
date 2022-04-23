<?php


function Clean($string){
    $output=stripslashes(strip_tags(trim($string)));

    return $output;
 }

function uploadcv($pdf){
    $name=$pdf['name'];
    $type=$pdf['type'];
    $tmp=$pdf['tmp_name'];
    $size=$pdf['size'];

    $arr=explode('/',$type);
    $ext=strtolower(end($arr));
    
    $allowedExt=['pdf'];
  


    if(in_array($ext,$allowedExt))
    {

        $fname=hexdec(uniqid()).".".$ext;
        
          $Path = 'uploads/'.$fname;

          if (move_uploaded_file($tmp, $Path))
           {

             return "image Uploaded";
           } 
          else
          {
            return "image Uploaded Failed";
          }
    }
     else 
      {
        return 'InValid Extension';
      }
      
  } 

    
    



if($_SERVER['REQUEST_METHOD'] == "POST"){

  // CODE .... 
  $errors = []; 
 $name     = Clean($_POST['name']);
 $email    = Clean($_POST['email']);
 $password = Clean($_REQUEST['password']);
 $adrees   = Clean($_POST['address']);
 $linked   = Clean($_POST['link']);
 $cv       = $_FILES['pdf'];




  if(!empty($_POST['radio'])) {
    $gender = $_POST['radio'];
    
  }else{
    $gender=0;
  }
  

 
 
 



# Validate NAME ... 
if(empty($name) || is_numeric($name)==1){
  if(empty($name)){
      $errors['Name']  = "Required"; 
  }else{
   
    $errors['Name']  = "Must Be String";
  }

  
}


# VALIDATE EMAIL 
if(empty($email) ){
 


      $errors['Email']  = "Required"; 
    }
  
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $errors['Email']  = "Must Select an Valid Email"; 
  }
 



  # VALIDATE password 
 
  if(empty($password ) )
  {
      
          
          $errors['Password']  = "Required"; 
  }
  elseif( (strlen($password) <=5))
  {
          $errors['Password']  = "Min Length is 6 "; 
  }
      
    
# Validate Adress .. 

  if(empty($adrees) )
  {
     
      $errors['Address']  = "Required"; 

  }
  elseif(strlen($adrees) <=10)
  {
        $errors['Address']  = "Min Length is 10";
  }
  
   # Validate LinkedIn .. 

   if(empty($linked) ){
      
      $errors['URL']  = "Required"; 
    
   }
  elseif(!filter_var($linked,FILTER_VALIDATE_URL)){
        $errors['URL']  = "Must be a valid Link ";
    }
  
  # Validate PDF .. 
    $up=uploadcv($cv);
  if(empty($cv['name'])){
      
    $errors['Cv']  = "Required"; 
  
   }elseif($up=='image Uploaded') {
       $errors['Cv']  = "Upload Succesful"; 
   }
   elseif($up=='image Uploaded Failed') {
    $errors['Cv']  = "image Uploaded Failed"; 
}else
{
  $errors['Cv']  = "Invalid Exstention"; 
}

# Validate Gender .. 

if($gender==0 )
{
   
    $errors['Gender']  = "Required"; 

}








}


?>
<html>
    <head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
    <body>
    <div class="container">
    <h2>Register</h2>
 <form   action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" >
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
    <label for="exampleInputPassword1">Gender</label><br>
    
    
    <input type="radio" name="radio" value="Male"> Male
    
   
    <input type="radio" name="radio" value="Female"> Female
    
    <?php
    if(isset($_POST['register'])   ){
    if(!empty($errors['Gender'])){
     echo "<p> <font color=red>".$errors['Gender']."</font> </p>";
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
  <div class="form-group">
    <label for="exampleInputPassword1">CV</label>
    <input type="file" name="pdf" class="form-control" id="exampleInputPassword1">
    <?php
    if(isset($_FILES['pdf'])){
    if(!empty($errors['Cv'])){
     echo "<p> <font color=red>".$errors['Cv']."</font> </p>";
      }
      else{
        echo "<p> <font color=green>Valid Data </font> </p>";
      }
    }
    ?>
    
  </div>
  

  <button type="submit" name="register" class="btn btn-primary">Submit</button>
   
    
</form> 
</div>

</body>

</html>