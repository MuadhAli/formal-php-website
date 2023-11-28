<?php
session_start();
include('database.php');

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
    $category = $_GET['category'];
} else {
    // Default category if not provided
    $category = 'personal_information';
}

// Fetch questions for the selected category from the database
$sql = "SELECT * FROM questions WHERE category = '$category'";
$result = mysqli_query($conn, $sql);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Question Form</title>
</head>

<body>
    <div class="container">
        <h1>Question Form - <?php echo ucfirst(str_replace('_', ' ', $category)); ?></h1>

        <?php
        foreach ($questions as $question) {
            echo "<p>{$question['question']}</p>";
            // Add input fields based on the type of question (e.g., text, checkbox, etc.)
            echo "<input type='text' name='{$question['question']}'><br>";
        }
        ?>

        <!-- Add form submission logic here -->

    </div>
</body>

</html>
