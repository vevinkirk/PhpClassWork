<?php
// All validation functions return either true or false.
// 
// Validate string length.
function fIsValidLength($input, $minLength, $maxLength) {
   //returns true of false
   //trim empty spaces from beginning and end
   $input = trim($input);
   $IsValid = (strlen($input) >= $minLength && strlen($input) <= $maxLength);
   return $IsValid;
}

//email address
function fIsValidEmail($email) {
   //validate using php filter function. Returns true or false.
   $email = trim($email);
   if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
      return false;
   else
      return true;
}

//state abbreviation
function fIsValidStateAbbr($state) {
   $ValidAbbr = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL",
       "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA",
       "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC",
       "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT",
       "VA", "WA", "WV", "WI", "WY");

   //trim & change to upper case (to match strings in array)
   $state = trim(strtoupper($state));

   //check if a value exists in an array. 
   return in_array($state, $ValidAbbr);
}

//telephone numbers
function fIsValidPhone($phone) {
   //remove delimiters and spaces
   $pattern = "/[-,.()\s]/";
   $phone = preg_replace($pattern, '', $phone);

   //must be 10 digits
   return ((strlen($phone) == 10) && is_numeric($phone));
}

//date
function fIsValidDate($date) {
//date must be in format yyyy-mm-dd or yyyy/mm/dd (RFC 3339 format)
   $date = str_replace('-', '/', $date);
   $test_arr = explode('/', $date);
   if (count($test_arr) == 3 &&
           is_numeric($test_arr[0]) &&
           is_numeric($test_arr[1]) &&
           is_numeric($test_arr[2])) {
      //checkdate($month, $day, $year)
      if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
         return true;
      } else {
         return false; //invalid date
      }
   } else {
      return false; //invalid format
   }
}

function fIsValidAge($age){
    //check if age is a numeric
    $age = trim($age);
    if(is_numeric($age)){
        if($age > 99 or $age < 1){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}

function fIsValidZip($zip){
    //check if Zip is 5 length long and numeric
    $zip = trim($zip);
    return ((strlen($zip) == 5) && is_numeric($zip));
}

function fIsValidModel($model){
    //check if model is one of three given values
    $model = trim($model);
    if($model == "Mustang" || $model == "Subaru" || $model == "Corvette"){
        return true;
    }else{
        return false;
    }
}

function fIsValidColor($color){
    $color = trim($color);
    if($color == "red" || $color == "blue" || $color == "yellow"){
        return true;
    }else{
        return false;
    }
}
?>
