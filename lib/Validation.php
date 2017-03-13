<?php
  class Validation
  {
    public function isint($int){
      if(is_nummeric($int)){
        return True;
      }else {
        return False;
      }
    }

    public function isemail($email){
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return True;
      } else {
        return False;
      }
    }

    public function minlengthchecker($var, $minlength){
      if(strlen($var) >= $minlength){
        return True;
      } else {
        return False;
      }
    }
  }

?>
