<?php

namespace Common\Util\Validator;
  
  class numericgroup {
    
    public static function test( $input ) {
      $pass = true;
      foreach($input as $data){
        if($data && (!preg_match( '{^[0-9]+$}', $data ))){
          $pass = false;
          break;
        }
      }
      return $pass;
    }
  }
