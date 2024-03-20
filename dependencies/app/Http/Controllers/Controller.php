<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function filterInput($str, $type = "text"){
        switch (strtolower($type)) {
         case "number":
          if (is_numeric($str) || $str == "")
           return array(true, filter_var($str, FILTER_VALIDATE_INT));
          else return array(false, "Invalid input - '$str', required number");
          break;
         case "boolean":
          if ($str == "" || $str == '0' || $str == '1' || is_bool($str))
           return array(true, filter_var($str, FILTER_VALIDATE_BOOLEAN));
          else return array(false, "Invalid input - '$str', required boolean");
          break;
         case "password":
          if ($str == "") {
           return array(false, "Invalid input - '$str', cannot be blank");
          } else {
           if (strpos($str, " ") === false) {
            return array(true, $str);
           } else return array(false, "Invalid input - '$str', not allow space");
          }
          break;
         case "json":
          $arr = array();
          if ($str != "") {
           if (!is_array($str)) {
            $arr = json_decode(htmlspecialchars_decode($str), true);
           } else {
            $arr = $str;
           }
          }
          if (!is_array($arr)) {
           return array(false, "Invalid input - '$str', not valid json format");
          } else {
           return array(true, $arr);
          }
          break;
         case "array":
          if (!is_array($str)) {
           if(trim($str) === ''){
            return array(true, array());
           }else{
            return array(false, "Invalid input - '$str', not an array");
           }
          } else {
           return array(true, $str);
          }
          break;
         default:
          if(isset($str) ){
            $str = htmlspecialchars($str, ENT_QUOTES);
            return array(true, $str);
          }else{
            return array(true, $str);
          }
        
          
        }
       }
      
       protected function validateInput($v, $type = 'text', $filter = true, $default = ""){
        if (($v === "" || $v === NULL) && $default) $v = $default;
      
        $results = $this->filterInput($v, $type);
        
        $result_txt = isset($results[1]) ? $results[1] : "";
        if (isset($results[0]) && $results[0] === true) {
         $check_text = str_replace('&lt;a&gt;','', $result_txt); 
         $check_text2 = str_replace('&amp;','', $result_txt); 
         $check_text3 = str_replace('amp;','', $result_txt);
         return $check_text3;
        } else{
          abort(400, 'Bed Request');
        }

       }

    
       protected function clean($string) {
        $string  =  str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9ก-๙\-]/u', '',str_replace('and', '-', $string));
       }

       protected function unique_code_bysetf($limit)
        {
          return (int) substr(random_int(100000000, 999999999), 0, $limit);
        }

     

}