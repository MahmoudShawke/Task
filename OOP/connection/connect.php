<?php
class conn{
    public $con;
    
    function __construct() {
    $servername='localhost';
    $dbname='blogs';
    $username='root';
    $password='';
    
    
    $con=mysqli_connect($servername,$username,$password,$dbname);
    if($con){
    
     $this->con=$con;
    
    }else {
    
        echo mysqli_connect_error();
    }
   
  
}
function get_con() {
    return $this->con;
  }



  function clos_con() {
    return mysqli_close($this->con);
  }
}


?>