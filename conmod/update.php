<?php
session_start();
require '../database/connection.php';

$id = $_POST['id'] ?? ($_GET['id'] ?? '');

if (!$id) {
    die("No ID provided.");
}

function valid_name($name)
{
    $name_pattern = "/^[a-zA-Z\s.,'-]+$/";
    if (empty($name)) {
        return "Name is required.";
    } elseif (!preg_match($name_pattern, $name)) {
        return "Invalid input name.";
    }
    return null;
}

function valid_section($section)
{
    $section_pattern = "/^[a-zA-Z0-9\s.,'-]+$/";
    if (empty($section)) {
        return "Section is required.";
    } elseif (!preg_match($section_pattern, $section)) {
        return "Section must contain valid letters or numbers.";
    }
    return null;
}

function valid_fields($fields, &$errors)
{
    $formal_text_pattern = "/^[a-zA-Z0-9\s.,'-]+$/";
    foreach ($fields as $field) {
        $input = trim($_POST[$field] ?? '');
        if (empty($input)) {
            $errors[$field] = "This field is required.";
        } elseif (!preg_match($formal_text_pattern, $input)) {
            $errors[$field] = "Invalid characters.";
        }
    }
}

function valid_radios($fields, &$errors)
{
    foreach ($fields as $field) {
        if (!isset($_POST[$field])) {
            $errors[$field] = "Please select an answer.";
        }
    }
}

function valid_checkboxes($fields, &$errors)
{
    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || !is_array($_POST[$field]) || count($_POST[$field]) === 0) {
            $errors[$field] = "Select at least one option.";
        }
    }
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $section = $_POST['section'] ?? '';

    if ($error = valid_name($name)) {
        $errors['name'] = $error;
    }
    if ($error = valid_section($section)) {
        $errors['section'] = $error;
    }

    valid_fields(['technical_controls', 'q2', 'q4', 'q5', 'q6', 'q8', 'q9', 'q10', 'q11', 'q12', 'q14', 'q15'], $errors);
    valid_radios(['q2', 'q4', 'q5', 'q6', 'q8', 'q9', 'q10', 'q11', 'q12', 'q14', 'q15'], $errors);
    valid_checkboxes(['q3', 'q7', 'q13'], $errors);


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../update.php?id=" . $id);
        exit();
    }


    $q3 = isset($_POST['q3']) ? implode(',', $_POST['q3']) : '';
    $q7 = isset($_POST['q7']) ? implode(',', $_POST['q7']) : '';
    $q13 = isset($_POST['q13']) ? implode(',', $_POST['q13']) : '';

    $updateStmt = $pdo->prepare("UPDATE quiz_responses SET 
          name = :name, 
          section = :section, 
          technical_controls = :technical_controls, 
          q2 = :q2, 
          q3 = :q3, 
          q4 = :q4, 
          q5 = :q5, 
          q6 = :q6, 
          q7 = :q7, 
          q8 = :q8, 
          q9 = :q9, 
          q10 = :q10, 
          q11 = :q11, 
          q12 = :q12, 
          q13 = :q13, 
          q14 = :q14, 
          q15 = :q15
          WHERE id = :id");

    $updated = $updateStmt->execute([
        'name' => $name,
        'section' => $section,
        'technical_controls' => $_POST['technical_controls'] ?? '',
        'q2' => $_POST['q2'] ?? '',
        'q3' => $q3,
        'q4' => $_POST['q4'] ?? '',
        'q5' => $_POST['q5'] ?? '',
        'q6' => $_POST['q6'] ?? '',
        'q7' => $q7,
        'q8' => $_POST['q8'] ?? '',
        'q9' => $_POST['q9'] ?? '',
        'q10' => $_POST['q10'] ?? '',
        'q11' => $_POST['q11'] ?? '',
        'q12' => $_POST['q12'] ?? '',
        'q13' => $q13,
        'q14' => $_POST['q14'] ?? '',
        'q15' => $_POST['q15'] ?? '',
        'id' => $id
    ]);

    if ($updated) {
        $_SESSION['success'] = "Record updated successfully!";
        header("Location: ../answer.php?id=" . $id);
        exit();
    } else {
        $_SESSION['error'] = "Failed to update record.";
    }
}
