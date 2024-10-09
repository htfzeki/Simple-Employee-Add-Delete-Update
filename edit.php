<?php
include('config/db_connect.php');

// If an ID is provided in the URL, fetch the employee's current data for editing
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Get current employee data for editing
    $sql = "SELECT * FROM employee WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $employee = mysqli_fetch_assoc($result);

    // Set the values for the form fields
    $firstname = $employee['firstname'];
    $lastname = $employee['lastname'];
    $email = $employee['email'];
    $number = $employee['number'];
    $homeadd = $employee['homeadd'];
    $position = $employee['position'];

    mysqli_free_result($result);
    mysqli_close($conn);
} else {
    // If no ID is provided, initialize empty variables for adding a new employee
    $firstname = '';
    $lastname = '';
    $email = '';
    $number = '';
    $homeadd = '';
    $position = '';
}

// Process the form for adding or updating an employee
if (isset($_POST['submit'])) {
    include('config/db_connect.php');

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $homeadd = mysqli_real_escape_string($conn, $_POST['homeadd']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);

    if (isset($_POST['id'])) {
        // Update existing employee
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $sql = "UPDATE employee SET firstname='$firstname', lastname='$lastname', email='$email', number='$number', homeadd='$homeadd', position='$position' WHERE id=$id";
    } else {
        // Add new employee
        $sql = "INSERT INTO employee (firstname, lastname, email, number, homeadd, position) VALUES ('$firstname', '$lastname', '$email', '$number', '$homeadd', '$position')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: modify.php'); // Redirect to employee list after success
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center title-text"><?php echo isset($_GET['id']) ? 'Edit Employee' : 'Add New Employee'; ?></h4>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="white">
        <?php if (isset($_GET['id'])): ?>
            <!-- Hidden input to pass the employee ID when editing -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <?php endif; ?>

        <label>First Name: <b class="red-text"><?php echo $errors['firstname'] ?? ''; ?></b></label>
        <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>

        <label>Last Name: <b class="red-text"><?php echo $errors['lastname'] ?? ''; ?></b></label>
        <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>

        <label>Email Address: <b class="red-text"><?php echo $errors['email'] ?? ''; ?></b></label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label>Number (09---------): <b class="red-text"><?php echo $errors['number'] ?? ''; ?></b></label>
        <input type="text" name="number" value="<?php echo htmlspecialchars($number); ?>" required>

        <label>Home Address: <b class="red-text"><?php echo $errors['homeadd'] ?? ''; ?></b></label>
        <input type="text" name="homeadd" value="<?php echo htmlspecialchars($homeadd); ?>" required>

        <label>Position: <b class="red-text"><?php echo $errors['position'] ?? ''; ?></b></label>
        <input type="text" name="position" value="<?php echo htmlspecialchars($position); ?>" required>

        <div class="center">
            <input type="submit" name="submit"
                value="<?php echo isset($_GET['id']) ? 'Update Employee' : 'Add Employee'; ?>"
                class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php'); ?>
</body>

</html>