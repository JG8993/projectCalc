<?php 

$weight = null;
$weightMessage = '';
$metric = null;
$altWeight = null;
$altWeightMessage = '';
$weightToAdd = '';
$barWeight = null;
$totalWeight = null;
$weightArrPounds = array(45,35,25,10, 5,2.5);
$weightArrKilos = array(20, 15, 10, 5, 2.5, 1.25);


function calculatePlatesNeeded($weightPerSide, $plateWeights){
    $weightRemaining = $weightPerSide;
    $plates = [];

    foreach ($plateWeights as $weight){
        $count = floor($weightRemaining / $weight);
        $weightRemaining -= $count * $weight;
        
        
        $weightRemaining = round($weightRemaining, 2);
        
        $plates[$weight] = $count;
    }
    return $plates;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $weight = isset($_POST['weight']) && is_numeric($_POST['weight']) ? $_POST['weight']: null;
    $metric = isset($_POST['metric']) ? $_POST['metric'] : null;
    $barWeight = isset($_POST['bar_weight']) ? $_POST['bar_weight'] : null;

    if ($barWeight == '45_pounds' && $metric == 'pounds'){
        $barWeight = 45;
    } elseif ($barWeight == '35_pounds' && $metric == 'pounds'){
        $barWeight = 35;
    } else {
        $errormessage = "Select a bar weight";
    }

    if ($barWeight == '45_pounds' && $metric == 'kilos'){
        $barWeight = 20;
    } elseif ($barWeight == '35_pounds' && $metric == 'kilos'){
        $barWeight = 16;
    } else {
        $errormessage = "Select a bar weight";
    }
    $totalWeight = $weight;

    $weightPerSide = ($totalWeight - $barWeight) / 2;

    if ($metric == 'pounds') {
        $platesNeeded = calculatePlatesNeeded($weightPerSide, $weightArrPounds);
    } elseif ($metric == 'kilos'){
        $platesNeeded = calculatePlatesNeeded($weightPerSide, $weightArrKilos);
    }

}


if($weight !== null && $metric !== null){
    $weightMessage = "Weight Entered: $totalWeight $metric";
    if($metric == 'pounds'){
        $altWeight = $totalWeight *= 0.453592;
        $formatAltWeight = round($altWeight);
        $altWeightMessage = "or $formatAltWeight kilos"; 
    } else {
        $altWeight = $totalWeight /= .453592;
        $formatAltWeight = round($altWeight);
        $altWeightMessage = "or $formatAltWeight pounds";
    }
} 



include "plateCalculator.php"; ?>