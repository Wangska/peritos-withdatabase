<?php
require '../database/connection.php';
session_start();
$id = $_GET['id'] ?? '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM quiz_responses WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $answers = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$answers) {
        die("Record not found.");
    }
}
// $answers = $_SESSION['answers'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cybersecurity Quiz Answer</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="icon" href="../image/ecobin-design (3).png">
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="../image/logo1.PNG" alt="logo1" class="logo-left">
            <div class="title-container">
                <h1 class="main-title">Cybersecurity Quiz</h1>
                <h3 class="instructions">ALL ANSWERS MUST BE GIVEN ON THE ANSWER SHEET</h3>
            </div>
            <img src="../image/logo.PNG" alt="logo" class="logo-right">
        </div>


        <div class="info-section" style="display: flex; gap: 20px; margin-top: 50px;">
            <div class="input-group1">

                <input type="text" value="<?php echo htmlspecialchars($id); ?>" readonly hidden>
                <label for="name">Name:</label>
                <?php echo htmlspecialchars($answers['name'] ?? ''); ?>
            </div>

            <div class="input-group2">
                <label for="section">Section:</label>
                <?php echo htmlspecialchars($answers['section'] ?? ''); ?>
            </div>
        </div>

        <div class="quiz-section" style="margin-top: 30px;">


            <div class="quiz-item">
                <p>1. What is the primary role of technical controls in cybersecurity?</p>
                <label>- &nbsp;<strong><?php echo htmlspecialchars($answers['technical_controls'] ?? ''); ?></strong></label>
            </div>

            <div class="quiz-item">
                <p>2. Why are secure software development practices important?</p>
                <label>- &nbsp;<strong><?php echo htmlspecialchars($answers['q2'] ?? ''); ?><strong>
                </label>

            </div>

            <div class="quiz-item">
                <?php
                $options = [
                    "A" => "Antivirus software",
                    "B" => "Firewalls",
                    "C" => "Regular software updates",
                    "D" => "Strong passwords",
                    "E" => "Intrusion Detection Systems (IDS)",
                    "F" => "Security awareness training"
                ];
                ?>
                <p>3. Which security measures help prevent malware infections?</p>

                <ul>
                    <?php
                    if (!empty($_SESSION['answers']['q3'])) {
                        foreach ($_SESSION['answers']['q3'] as $option) {

                            if (isset($options[$option])) {
                                echo "<li>" . htmlspecialchars($options[$option]) . "</li>";
                            }
                        }
                    } else {
                        echo "<li>No answer provided</li>";
                    }
                    ?>
                </ul>

            </div>

            <div class="quiz-item">


                <p>4. A firewall’s primary function is to:</p>
                <label> - &nbsp;<strong><?php echo htmlspecialchars($answers['q4'] ?? ''); ?><strong>
                </label>



            </div>

            <div class="quiz-item">
                <p>5. What type of control is a firewall classified as?</p>
                <label>- &nbsp;<?php echo htmlspecialchars($answers['q5'] ?? ''); ?>
                </label>

            </div>

            <div class="quiz-item">
                <p>6. What is the difference between detective and preventive controls?</p>
                <label>- &nbsp;<?php echo nl2br(htmlspecialchars($answers['q6'] ?? '')); ?></label>

            </div>

            <?php

            $options = [
                "A" => "Firewalls",
                "B" => "IDS",
                "C" => "Regular system updates",
                "D" => "Employee training",
                "E" => "Incident response planning",
                "F" => "Network segmentation"
            ];

            ?>

            <div class="quiz-item">
                <p>7. An effective cybersecurity strategy requires:</p>
                <ul>
                    <?php
                    if (!empty($_SESSION['answers']['q7'])) {
                        foreach ($_SESSION['answers']['q7'] as $option) {

                            if (isset($options[$option])) {
                                echo "<li>" . htmlspecialchars($options[$option]) . "</li>";
                            } else {
                                echo "<li>Unknown option: " . htmlspecialchars($option) . "</li>";
                            }
                        }
                    } else {
                        echo "<li>No answer provided</li>";
                    }
                    ?>
                </ul>
            </div>


            <div class="quiz-item">
                <p>8. What is the main function of an Intrusion Detection System (IDS)?</p>
                <label>- &nbsp;<?php echo htmlspecialchars($answers['q8'] ?? ''); ?>

            </div>

            <div class="quiz-item">
                <p>9. What does an Endpoint Detection and Response (EDR) system do?</p>
                <label>- &nbsp;<?php echo htmlspecialchars($answers['q9'] ?? ''); ?></label>

            </div>

            <div class="quiz-item">
                <p>10. What is the primary benefit of using honeypots in cybersecurity?</p>
                <label>- &nbsp; <?php echo htmlspecialchars($answers['q10'] ?? ''); ?></label>
            </div>

            <div class="quiz-item">
                <p>11. What does Recovery Time Objective (RTO) define?</p>
                <label>- &nbsp;<?php echo htmlspecialchars($answers['q11'] ?? ''); ?></label>

            </div>

            <div class="quiz-item">
                <p>12. How does automation improve the recovery process in cybersecurity?</p>
                <label>- &nbsp;<?php echo nl2br(htmlspecialchars($answers['q12'] ?? '')); ?></label>

            </div>

            <div class="quiz-item">
                <?php
                $options = [
                    "A" => "Security guards",
                    "B" => "Warning signs",
                    "C" => "Surveillance cameras",
                    "D" => "Firewalls",
                    "E" => "Access control systems",
                    "F" => "Security policies"
                ];
                ?>


                <p>13. Which of the following are examples of deterrent controls? (Select all that apply)</p>
                <ul>
                    <?php
                    if (!empty($_SESSION['answers']['q13'])) {
                        foreach ($_SESSION['answers']['q13'] as $option) {

                            if (isset($options[$option])) {
                                echo "<li>" . htmlspecialchars($options[$option]) . "</li>";
                            } else {
                                echo "<li>Unknown option: " . htmlspecialchars($option) . "</li>";
                            }
                        }
                    } else {
                        echo "<li>No answer provided</li>";
                    }
                    ?>
                </ul>

            </div>

            <div class="quiz-item">
                <p>14. What is the primary purpose of deterrent controls in information security?</p>
                <label>- &nbsp;<?php echo htmlspecialchars($answers['q14'] ?? ''); ?></label>

            </div>

            <div class="quiz-item">
                <p>15. Which deterrent control method involves clear warning messages to discourage intruders?</p>
                <label>- &nbsp; <?php echo htmlspecialchars($answers['q15'] ?? ''); ?></label>
            </div>

        </div>

        <form method="post" action="admindash.php">
            <button type="submit" name="clear_session" class="return" style="margin-left: 50px;">Return</button>
        </form>
</body>

</html>