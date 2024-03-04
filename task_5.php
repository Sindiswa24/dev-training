<?php

function getFibonacciSequence($maxNumber){
    $startNumber = 0;
    $nextNumber = 1;

    $fibonacciSequence = [$startNumber];

    while ($startNumber < $maxNumber) {
        $sequence = $startNumber;
        $startNumber = $nextNumber;
        $nextNumber = $sequence + $startNumber;

        if ($startNumber <= $maxNumber) {
            $fibonacciSequence[] = $startNumber;
        }
    }

    return $fibonacciSequence;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maxNumber = isset($_POST['maxNumber']) ? intval($_POST['maxNumber']) : 0;

    echo implode(', ', getFibonacciSequence($maxNumber));
}

?>