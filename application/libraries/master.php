<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Master {
 public function fruits($count, $type)
 {
   switch($type)
   {
    case 'red':
     return $count." Apple";
     break;
    case 'yellow':
      return $count." banana";
      break;
    }
  }
}