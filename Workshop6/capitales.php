<?php
$capitales = [
    "Austria" => "Vienna",
    "Belgium" => "Brussels",
    "Cyprus" => "Nicosia",
    "Czech Republic" => "Prague",
    "Denmark" => "Copenhagen",
    "Estonia" => "Tallin",
    "Finland" => "Helsinki",
    "France" => "Paris",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Hungary" => "Budapest",
    "Ireland" => "Dublin",
    "Italy" => "Rome",
    "Latvia" => "Riga",
    "Lithuania" => "Vilnius",
    "Luxembourg" => "Luxembourg",
    "Malta" => "Valetta",
    "Netherlands" => "Amsterdam",
    "Poland" => "Warsaw",
    "Portugal" => "Lisbon",
    "Slovakia" => "Bratislava",
    "Slovenia" => "Ljubljana",
    "Spain" => "Madrid",
    "Sweden" => "Stockholm",
    "United Kingdom" => "London"
];

foreach ($capitales as $pais => $capital) {
    echo "The capital of $pais is $capital.\n";  // Usa \n para saltos de línea en consola
}
