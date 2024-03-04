<?php 
$limit = 9;
function getFibonacciSequence($limit) {
    if ($limit == 0) {
        return 0;
    } else if($limit == 1){
        return 1;
    }else{
        return (getFibonacciSequence($limit - 1) + getFibonacciSequence($limit - 2));
    }
}
for($i = 0; $i <= $limit; $i++){
    echo getFibonacciSequence($i). " ";
}





// function getFibonacciSequence(){
//     $startNumber = 0;
//     $nextNumber = 1;

//     $fibonacciSequence = [$startNumber];

//     while($startNumber < 34){
//         $sequence = $startNumber;
//         $startNumber = $nextNumber;
//         $nextNumber = $sequence + $startNumber;

//         $fibonacciSequence[] = $startNumber;
//     }

//     return $fibonacciSequence;
//     }

//     echo implode(', ', getFibonacciSequence()); 
?>