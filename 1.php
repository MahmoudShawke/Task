<?php 

//$alphabet='abcdefghijklmnopqrstuvwxyz';
 function NextChar($char,$alph='abcdefghijklmnopqrstuvwxyz')
{
    $output = strpos($alph, $char);
    $len= strlen($alph) -1;
    
    if($output==$len)
    {
        
        return $alph[0];
    }
    elseif($output==false)
    {

      return  "The String '".$char."' Not Found";
    }
    else
    {
    return $alph[$output+1];
    }
}

echo NextChar('س');

?>

