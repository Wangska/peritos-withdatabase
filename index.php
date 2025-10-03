<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];
unset($_SESSION['errors'], $_SESSION['form_data']);

if (isset($_POST['clear_session'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybersecurity Quiz</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="image/ecobin-design (2).png">
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="image/logo1.PNG" alt="logo1" class="logo-left">
            <div class="title-container">
                <h1 class="main-title">Cybersecurity Quiz</h1>
                <h3 class="instructions">ALL ANSWERS MUST BE GIVEN ON THE ANSWER SHEET</h3>
            </div>
            <img src="image/logo.PNG" alt="logo" class="logo-right">
        </div>

        <div class="details">
            <p><strong>No. of Questions:</strong> 15</p>
        </div>


        <form method="POST" action="./conmod/submit.php">

            <div class="info-section" style="display: flex; gap: 20px;">
                <div class="input-group1">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $form_data['name'] ?? '';  ?>">
                    <span class="error"><?php echo $errors['name'] ?? ''; ?></span>
                </div>

                <div class="input-group2">
                    <label for="section">Section:</label>
                    <input type="text" id="section" name="section" value="<?php echo $form_data['section'] ?? ''; ?>">
                    <span class="error"><?php echo $errors['section'] ?? ''; ?></span>
                </div>
            </div>

            <div class="quiz-section">
                <p>For questions 1-15, decide which answer best fits each blank.</p>

                <div class="quiz-item">
                    <p>1. What is the primary role of technical controls in cybersecurity?</p>
                    <input type="text" id="technical-controls" name="technical-controls" value="<?php echo ($form_data['technical-controls'] ?? ''); ?>">
                    <span class="error"><?php echo $errors['technical-controls'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>2. Why are secure software development practices important?</p>
                    <textarea id="q2" name="q2" rows="4"><?php echo  $form_data['q2'] ?? ''; ?></textarea>
                    <span class="error"><?php echo $errors['q2'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>3. Which security measures help prevent malware infections?</p>
                    <?php
                    $options = [
                        "A" => "Antivirus software",
                        "B" => "Firewalls",
                        "C" => "Regular software updates",
                        "D" => "Strong passwords",
                        "E" => "Intrusion Detection Systems (IDS)",
                        "F" => "Security awareness training"
                    ];

                    $selectedOptions = $form_data['q3'] ?? [];

                    foreach ($options as $value => $label) {
                        $checked = is_array($selectedOptions) && in_array($value, $selectedOptions) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='q3[]' value='$value' $checked> $label</label><br>";
                    }
                    ?>
                    <span class="error"><?php echo $errors['q3'] ?? ''; ?></span>
                </div>


                <div class="quiz-item">
                    <p>4. A firewall’s primary function is to:</p>
                    <?php $selectedValue = $form_data['q4'] ?? ''; ?>

                    <label>
                        <input type="radio" name="q4" value="Detect Malware" <?php echo ($selectedValue == 'Detect Malware') ? 'checked' : ''; ?>>
                        Detect malware
                    </label><br>

                    <label>
                        <input type="radio" name="q4" value="Prevent unauthorized access" <?php echo ($selectedValue == 'Prevent unauthorized access') ? 'checked' : ''; ?>>
                        Prevent unauthorized access
                    </label><br>

                    <label>
                        <input type="radio" name="q4" value="Encrypt data" <?php echo ($selectedValue == 'Encrypt data') ? 'checked' : ''; ?>>
                        Encrypt data
                    </label><br>

                    <span class="error"><?php echo $errors['q4'] ?? ''; ?></span>
                </div>



                <div class="quiz-item">
                    <p>5. What type of control is a firewall classified as?</p>
                    <input type="text" id="q5" name="q5" value="<?php echo  $form_data['q5'] ?? ''; ?>">
                    <span class="error"><?php echo $errors['q5'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>6. What is the difference between detective and preventive controls?</p>
                    <textarea id="q6" name="q6" rows="4"><?php echo  $form_data['q6'] ?? ''; ?></textarea>
                    <span class="error"><?php echo $errors['q6'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>7. An effective cybersecurity strategy requires:</p>
                    <?php
                    $options = [
                        "A" => "Firewalls",
                        "B" => "IDS",
                        "C" => "Regular system updates",
                        "D" => "Employee training",
                        "E" => "Incident response planning",
                        "F" => "Network segmentation"
                    ];

                    $selectedOptions = $form_data['q7'] ?? []; 

                    foreach ($options as $value => $label) {
                        $checked = (is_array($selectedOptions) && in_array($value, $selectedOptions)) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='q7[]' value='$value' $checked> $label</label><br>";
                    }
                    ?>
                    <span class="error"><?php echo $errors['q7'] ?? ''; ?></span>
                </div>


                <div class="quiz-item">
                    <p>8. What is the main function of an Intrusion Detection System (IDS)?</p>
                    <?php $selectedValue = $form_data['q8'] ?? ''; ?>

                    <label><input type="radio" name="q8" value="Prevent cyber attacks" <?php echo ($selectedValue == 'Prevent cyber attacks') ? 'checked' : ''; ?>>
                        Prevent cyber attacks
                    </label><br>

                    <label><input type="radio" name="q8" value="Detect unauthorized access" <?php echo ($selectedValue == 'Detect unauthorized access') ? 'checked' : ''; ?>>
                        Detect unauthorized access
                    </label><br>

                    <label><input type="radio" name="q8" value="Encrypt network traffic" <?php echo ($selectedValue == 'Encrypt network traffic') ? 'checked' : ''; ?>>
                        Encrypt network traffic
                    </label><br>

                    <span class="error"><?php echo $errors['q8'] ?? ''; ?></span>
                </div>


                <div class="quiz-item">
                    <p>9. What does an Endpoint Detection and Response (EDR) system do?</p>
                    <input type="text" id="q9" name="q9" value="<?php echo  $form_data['q9'] ?? ''; ?>">
                    <span class="error"><?php echo $errors['q9'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>10. What is the primary benefit of using honeypots in cybersecurity?</p>
                    <?php $selectedValue = $form_data['q10'] ?? ''; ?>

                    <label><input type="radio" name="q10" value="Store sensitive data securely" <?php echo ($selectedValue == 'Store sensitive data securely') ? 'checked' : ''; ?>> Store sensitive data securely</label><br>

                    <label><input type="radio" name="q10" value="Attract attackers and study their methods" <?php echo ($selectedValue == 'Attract attackers and study their methods') ? 'checked' : ''; ?>> Attract attackers and study their methods</label><br>

                    <label><input type="radio" name="q10" value="Improve network performance" <?php echo ($selectedValue == 'Improve network performance') ? 'checked' : ''; ?>> Improve network performance</label><br>

                    <span class="error"><?php echo $errors['q10'] ?? ''; ?></span>
                </div>


                <div class="quiz-item">
                    <p>11. What does Recovery Time Objective (RTO) define?</p>
                    <input type="text" id="q11" name="q11" value="<?php echo  $form_data['q11'] ?? ''; ?>">
                    <span class="error"><?php echo $errors['q11'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>12. How does automation improve the recovery process in cybersecurity?</p>
                    <textarea id="q12" name="q12" rows="4"><?php echo  $form_data['q12'] ?? ''; ?></textarea>
                    <span class="error"><?php echo $errors['q12'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>13. Which of the following are examples of deterrent controls? (Select all that apply)</p>
                    <?php
                    $options = [
                        "A" => "Security guards",
                        "B" => "Warning signs",
                        "C" => "Surveillance cameras",
                        "D" => "Firewalls",
                        "E" => "Access control systems",
                        "F" => "Security policies"
                    ];

                    $selectedOptions = $form_data['q13'] ?? [];

                    foreach ($options as $value => $label) {
                        $checked = is_array($selectedOptions) && in_array($value, $selectedOptions) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='q13[]' value='$value' $checked> $label</label><br>";
                    }
                    ?>
                    <span class="error"><?php echo $errors['q13'] ?? ''; ?></span>
                </div>


                <div class="quiz-item">
                    <p>14. What is the primary purpose of deterrent controls in information security?</p>
                    <?php $selectedValue = $form_data['q14'] ?? ''; ?>

                    <label><input type="radio" name="q14" value="To prevent threats from occurring" <?php echo ($selectedValue == 'To prevent threats from occurring') ? 'checked' : ''; ?>> To prevent threats from occurring</label><br>

                    <label><input type="radio" name="q14" value="To reduce the impact of an attack" <?php echo ($selectedValue == 'To reduce the impact of an attack') ? 'checked' : ''; ?>> To reduce the impact of an attack</label><br>

                    <label><input type="radio" name="q14" value="To discourage potential intruders" <?php echo ($selectedValue == 'To discourage potential intruders') ? 'checked' : ''; ?>> To discourage potential intruders</label><br>

                    <span class="error"><?php echo $errors['q14'] ?? ''; ?></span>
                </div>

                <div class="quiz-item">
                    <p>15. Which deterrent control method involves clear warning messages to discourage intruders?</p>
                    <?php $selectedValue = $form_data['q15'] ?? ''; ?>

                    <label><input type="radio" name="q15" value="Encryption" <?php echo ($selectedValue == 'Encryption') ? 'checked' : ''; ?>> Encryption</label><br>

                    <label><input type="radio" name="q15" value="Security banners and warnings" <?php echo ($selectedValue == 'Security banners and warnings') ? 'checked' : ''; ?>> Security banners and warnings</label><br>

                    <label><input type="radio" name="q15" value="Multi-factor authentication" <?php echo ($selectedValue == 'Multi-factor authentication') ? 'checked' : ''; ?>> Multi-factor authentication</label><br>

                    <span class="error"><?php echo $errors['q15'] ?? ''; ?></span>
                </div>


            </div>

            <button class="submit">Confirm</button>
        </form>
    </div>
</body>

</html>