<?php
include '../database/connection.php';

    $sql = "SELECT id, name, section, submitted_at FROM quiz_responses ORDER BY submitted_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Response</title>
    <link rel="stylesheet" href="admindash.css" />
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <img src="../image/logo1.PNG" alt="logo1" class="logo-left">
            <p> <strong>St. Cecilia's College - Cebu, Inc. </strong><br>
                LASSO Supervised School <br>
                Poblacion Ward II, Minglanilla 6046, Cebu, Philippines <br>
                Tel. No. (032) 326 3677 / (032) 497 0767 / (032) 268 4746 <br>
                Facebook: St. Cecilia’s College - Cebu, Inc. <br>
                Website: www.stcecilia.edu.ph <br>
                E-Mail: sccreq@gmail.com <br> <br> <br>
              <strong>  Student Response </strong></p>
            <img src="../image/logo.PNG" alt="logo" class="logo-right">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Submitted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($students) > 0) {
                    foreach ($students as $row) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['section']}</td>
                                <td>{$row['submitted_at']}</td>
                               <td><a class='view-btn' href='view.php?id={$row['id']}'><img src='../image/icons8-eye-30.png' alt='View' /></a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
