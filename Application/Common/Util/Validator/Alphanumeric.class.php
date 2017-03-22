<?php
namespace Common\Util\Validator;
  
class alphanumeric {

  public static function test( $input ) {
    return !!preg_match( '{^[a-zA-Z0-9]+$}i', $input );
  }

}
