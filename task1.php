<?php

function printTable(array $data): Void
{
    try {
        // Šis ciklas nustato maksimalų kiekvieno stulpelio plotį ir įrašo jį į $widths masyvą
        $widths = array();
        foreach ($data as $row) {
            foreach ($row as $key => $value) {
                $widths[$key] = max(isset($widths[$key]) ? $widths[$key] : 0, strlen($key), strlen($value));
            }
        }
    
        // Spausdinam ASCII lentelę
        $table = '';
        $header = '';
        $separator = '';
        // Šis ciklas sugeneruoja lentelės stulpelių pavadinimus su skirtukais eidamas per $widths masyvą 
        foreach ($widths as $key => $width) {
            $header .= '| ' . str_pad($key, $width) . ' ';
            $separator .= '+-' . str_repeat('-', $width) . '-';
        }
        $header .= "|\n";
        $separator .= "+\n";
        $table .= $separator . $header . $separator;
        // Ciklas užpildo lentelę duomenimis
        foreach ($data as $row) {
            $line = '';
            foreach ($widths as $key => $width) {
                $line .= '| ' . str_pad(isset($row[$key]) ? $row[$key] : '', $width) . ' ';
            }
            $line .= "|\n";
            $table .= $line;
        }
        $table .= $separator;
    
        // gražinam lentelę su <pre> tagais, jei failas atidarytas naršyklėje
        if (PHP_SAPI == 'cli') {
            echo $table;
        } else {
            echo '<pre>' . $table . '</pre>';
        }
    } catch (Throwable $th) {
        echo $th->message;
        die;
    }
}

$array = array(
    array(
        'Name' => 'Trikse',
        'Color' => 'Green',
        'Element' => 'Earth',
        'Likes' => 'Flowers'
        ),
    array(
        'Name' => 'Vardenis',
        'Element' => 'Air',
        'Likes' => 'Singning',
        'Color' => 'Blue'
        ),  
    array(
        'Element' => 'Water',
        'Likes' => 'Dancing',
        'Name' => 'Jonas',
        'Color' => 'Pink'
        ),
);

printTable($array);