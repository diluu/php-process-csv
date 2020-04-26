<?php
namespace app\parse;

class TransactionCodeValidator
{
    //Valid chars is defined as a string constant
    const VALID_CHARS = "23456789ABCDEFGHJKLMNPQRSTUVWXYZ";

    public static function verify_key($key){
        if(strlen($key) != 10){
            return false;
        }
        $check_digit = self::generate_check_character(substr($key, 0, 9));
        return substr($key, 9, 1)==$check_digit;

    }

    public static function generate_check_character($input){
        $factor = 2;
        $sum = 0;
        $n = strlen(self::VALID_CHARS);

        // Starting from the right and working leftwords is easier since the initial factor will always be 2
        for($i=strlen($input)-1; $i>=0; $i--){
            $code_point = strpos(self::VALID_CHARS, substr($input, $i, 1));
            $addend = $factor * $code_point;

            // Alternate the 'factor' that each 'codePoint' is multiplied by
            $factor = $factor==2 ? 1:2;

            // Sum the digits of the 'addend' as expressed in base 'n'
            $addend = ($addend/$n) + ($addend % $n);
            $sum += $addend;
        }

        // Calculate the number that must be added to the 'sum' to make it divisible by 'n'
        $remainder = $sum % $n;
        $check_code_point = ($n - $remainder) % $n;
        return substr(self::VALID_CHARS, $check_code_point, 1);
    }
}
