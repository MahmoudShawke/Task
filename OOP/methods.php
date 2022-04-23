<?php 


class methods{

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
  
  
  function validateDate($date){
     if(empty($date)){
      $errors['Date']='The Field is Required ';
     
     }
     elseif(!empty($date)){
      $arr = explode('-', $date);
      $date=$arr[0].'-'.$arr[1].'-'.$arr[2];
     
     
      if($done=checkdate($arr[1], $arr[2], $arr[0])){
          return $date;
        }else {
           $errors['Date']='Invalid Syntax ';
        }
  
     }
   else{
      
  }
  
     }
     
  
  function Clean($string)
  {
    $output = stripslashes(strip_tags(trim($string)));
  
    return $output;
  }
  


} 


