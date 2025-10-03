<?php
session_start();

require '../database/connection.php';

if (!isset($_SESSION['answers'])) {
    echo "No data to submit.";
    exit();
}

$answers = $_SESSION['answers'];

$q3 = isset($answers['q3']) ? implode(", ", $answers['q3']) : "";
$q7 = isset($answers['q7']) ? implode(", ", $answers['q7']) : "";
$q13 = isset($answers['q13']) ? implode(", ", $answers['q13']) : "";


$insertdata = "INSERT INTO quiz_responses (name, section, technical_controls, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15)
            VALUES (:name, :section, :technical_controls, :q2, :q3, :q4, :q5, :q6, :q7, :q8, :q9, :q10, :q11, :q12, :q13, :q14, :q15)";

$stmt = $pdo->prepare($insertdata);

$stmt->execute([
    ':name' => $answers['name'],
    ':section' => $answers['section'],
    ':technical_controls' => $answers['technical-controls'],
    ':q2' => $answers['q2'],
    ':q3' => $q3,
    ':q4' => $answers['q4'],
    ':q5' => $answers['q5'],
    ':q6' => $answers['q6'],
    ':q7' => $q7,
    ':q8' => $answers['q8'],
    ':q9' => $answers['q9'],
    ':q10' => $answers['q10'],
    ':q11' => $answers['q11'],
    ':q12' => $answers['q12'],
    ':q13' => $q13,
    ':q14' => $answers['q14'],
    ':q15' => $answers['q15'],
]);

unset($_SESSION['answers']);

echo "Data inserted successfully!";
header("Location: success.php"); 
exit();
