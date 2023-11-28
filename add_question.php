<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the admin is logged in
    if (isset($_SESSION['admin_id'])) {
        // Get the question and category from the form
        $question = $_POST['question'];
        $category = $_POST['category'];

        // Insert the question into the database with the category
        $sql = "INSERT INTO questions (question, category) VALUES ('$question', '$category')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Question added successfully!";
        } else {
            echo "Error adding question: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access. Please log in as an admin.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add Question</title>
</head>

<body>
    <div class="container">
        <h1>Add Question</h1>

        <form method="post" action="add_question.php">
            <div class="mb-3">
                <label for="question" class="form-label">Question:</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="personal_information">Personal Information</option>
                    <option value="academic_background">Academic Background</option>
                    <option value="interests_and_hobbies">Interests and Hobbies</option>
                    <option value="career_goals">Career Goals and Aspirations</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Question</button>
        </form>
    </div>
</body>

</html>
