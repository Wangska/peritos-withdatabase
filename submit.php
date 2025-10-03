<?php
session_start();

function valid_name($name) {
    $name_pattern = "/^[a-zA-Z\s.,'-]+$/"; 
    
    if (empty($name)) {
        return "Name is required.";
    } elseif (!preg_match($name_pattern, $name)) {
        return "Invalid input name";
    } 
    return null;
}

function valid_section($section) {
    $section_pattern = "/^[a-zA-Z0-9\s.,'-]+$/"; 
    
    if (empty($section)) {
        return "Section is required.";
    } elseif (!preg_match($section_pattern, $section)) {
        return "Section must contain valid letters or numbers";
    }
    return null;
}

function valid_fields($fields, &$errors) {
    $formal_text_pattern = "/^[a-zA-Z0-9\s.,'-]+$/"; 
    
    foreach ($fields as $field) {
        $input = ($_POST[$field] ?? '');

        if (empty($input)) {
            $errors[$field] = "This field is required.";
        } elseif (!preg_match($formal_text_pattern, $input)) {
            $errors[$field] = "Invalid characters.";
        } 
    }
}

function valid_areas($fields, &$errors) {
    $formal_text_pattern = "/^[a-zA-Z0-9\s.,'-]+$/"; 
    
    foreach ($fields as $field) {
        $input = ($_POST[$field] ?? '');

        if (empty($input)) {
            $errors[$field] = "This field is required.";
        } elseif (!preg_match($formal_text_pattern, $input)) {
            $errors[$field] = "Invalid characters.";
        } 
    }
}


function valid_radios($fields, &$errors) {
    foreach ($fields as $field) {
        if (!isset($_POST[$field])) {
            $errors[$field] = "Please select an answer.";
        }
    }
}

function valid_checkboxes($fields, &$errors) {
    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || !is_array($_POST[$field]) || count($_POST[$field]) === 0) {
            $errors[$field] = "Select at least one option.";
        }
    }
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = ($_POST["name"]);
    $section = ($_POST["section"]);

    if ($error = valid_name($name)) {
        $errors['name'] = $error;
    }
    
    if ($error = valid_section($section)) {
        $errors['section'] = $error;
    }
    
    valid_fields(['technical-controls', 'q5', 'q9', 'q11'], $errors);
    valid_areas(['q2', 'q6', 'q12'], $errors);

    valid_radios(['q4', 'q8', 'q10', 'q14', 'q15'], $errors);
    valid_checkboxes(['q3', 'q7', 'q13'], $errors);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header("Location: index.php");
        exit;
    }

    $_SESSION['answers'] = $_POST;
    header("Location: display.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
