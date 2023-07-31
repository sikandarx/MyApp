<?php
// Assuming $grade and $id arrays have the same length
$grade = [80, 95, 70, 85];
$id = [101, 102, 103, 104];

// Function that takes two parameters and does something with them
function processValues($gradeValue, $idValue) {
    echo "ID: $idValue, Grade: $gradeValue |" . PHP_EOL;
    // Your function logic here...
}

// Check if both arrays have the same length
if (count($grade) === count($id)) {
    // Iterate over both arrays correspondingly
    foreach ($grade as $index => $gradeValue) {
        $idValue = $id[$index];
        processValues($gradeValue, $idValue);
    }
} else {
    echo "Arrays do not have the same length, cannot iterate correspondingly." . PHP_EOL;
}

?>