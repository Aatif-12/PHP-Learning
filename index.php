<?php
session_start();
$insert = false;
if (isset($_POST['name'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "trip_form";

    // Create a connection
    $conn = mysqli_connect($server, $username, $password, $dbname);

    // Check the connection
    if (!$conn) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO `form` (`Name`, `Age`, `Gender`, `Email`, `Phone Number`, `dt`) VALUES ('$name', '$age', '$gender', '$email', '$phone', current_timestamp())";

    if ($conn->query($sql) == true) {
        $_SESSION['insert'] = true;
    } else {
        echo "ERROR: $sql <br> $conn->error";
    }

    // Close the connection
    $conn->close();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <h1>Welcome to Manali Trip form</h1>
        <p>
            Enter your details and submit this form to confirm your participation in the trip.
        </p>

        <?php
        if (isset($_SESSION['insert']) && $_SESSION['insert'] === true) {
            echo "<p class='submit' style='color:green; font-size:20px; font-style: italic; text-align: center;'>Thank you for submitting your form. We are happy to see you joining us on the Manali Trip.</p>";
            unset($_SESSION['insert']);      
        }
        ?>

        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" required />
            </div>
            <div class="mb-3">
                <label for="exampleInputAge" class="form-label">Age</label>
                <input type="text" class="form-control" name="age" required />
            </div>
            <div class="mb-3">
                <label for="exampleInputGender" class="form-label">Gender</label>
                <input type="text" class="form-control" name="gender" required />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" required />
            </div>
            <div class="mb-3">
                <label for="exampleInputPhoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone" required />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
