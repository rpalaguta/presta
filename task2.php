<?php

function splitArrayIntoGroups(array $arr, int $groupAmmount): Void
{
    $sum = array_sum($arr);
    // Randam vidutinę sumą
    $avg = $sum / $groupAmmount;

    // Išrūšiuojam masyvą mažėjančia tvarka
    rsort($arr);

    $groups = [];
    $groupSums = [];

    $i = 0;
    // Pasiruošiam du tuščius masyvus. $groups laikys skaičius, $groupSums - atitinkamų grupių sumas
    while ($i < $groupAmmount) {
        $groups[] = [];
        $groupSums[] = 0;
        $i++;
    }

    // pridedam skaičių į mažiausią sumą turinčią grupę
    foreach ($arr as $num) {
        // array_keys pagalba surandame mažiausio elemento vietą
        $minSumKey = array_keys($groupSums, min($groupSums))[0];
        $groups[$minSumKey][] = $num;
        $groupSums[$minSumKey] += $num;
    }

    // rūšiuojam grupes mažėjančia sumų tvarką
    array_multisort($groupSums, SORT_DESC, $groups);

    // spausdinam grupes ir jų sumas
    foreach ($groups as $group) {
        sort($group, SORT_DESC);
        $line = implode(',', $group) . ' = ' . array_sum($group) . PHP_EOL;
        
        // gražinam rezultat1 su <pre> tagais, jei failas atidarytas naršyklėje
        if (PHP_SAPI == 'cli') {
            echo $line;
        } else {
            echo '<pre>' . $line . '</pre>';
        }
    }
}

$arr = [1,2,4,7,1,6,2,8];

// Nustatom grupių kiekį
$groupAmmount = 3;

splitArrayIntoGroups($arr, $groupAmmount);