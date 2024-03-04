<?php 

function addAll($array){
    if(empty($array)){
        return 0;
    }
    else{
        return array_sum($array) + addAll(array_slice($array, 1));
    }
}

// function addAll($array) {
//     $sum = 0;
//     $arrLength = count($array);
    
//     for($i = 0; $i < $arrLength; $i++) {
//         $sum += array_sum($array);
//         array_shift($array);
//     }

//     return $sum;
// }

$Array = [1, 1, 1, 1, 1];
echo addAll($Array);

?>