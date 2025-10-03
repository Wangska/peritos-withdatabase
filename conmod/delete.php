<?php
require '../database/connection.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {

        $stmt = $pdo->prepare("DELETE FROM quiz_responses WHERE id = :id");
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() > 0) {
            header("Location: ../index.php?message=Record+Deleted+Successfully");
            exit();
        } else {
            echo "Error: Record not found or already deleted.";
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
