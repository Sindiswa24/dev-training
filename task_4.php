<?php

class ItemOwners {
    public static function groupByOwners($itemsArr) {
        $result = array();

        foreach ($itemsArr as $key => $owner) {
            $result[$owner][] = $key;
        }

        return $result;
    }
}

$itemsArr = array(
    "Baseball Bat" => "John",
    "Golf ball" => "Stan",
    "Tennis Racket" => "John",
    "Basket ball" => "Stan",
    "Swimming cap" => "Sindiswa",
    "Swimming cap" => "John"
);

echo json_encode(ItemOwners::groupByOwners($itemsArr));


?>