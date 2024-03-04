<?php

class Palindrome{
    public static function isPalindrome($word){
        //TODO: Implement this

        $palindrome = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($word));

        return $palindrome == strrev($palindrome);
    }
}

if(Palindrome::isPalindrome("madam i'm adam")){
    echo 'A Palindrome';
}else{
    echo 'Not a Palindrome';
}
?>