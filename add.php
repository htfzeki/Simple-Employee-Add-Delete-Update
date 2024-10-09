<?php

include("config/db_connect.php");
$firstname = $lastname = $email = $number = $homeadd = $position = '';
$errors = array('firstname' => '', 'lastname' => '', 'email' => '', 'number' => '', 'homeadd' => '', 'position' => '');
if (isset($_POST['submit'])) {

    if (empty($_POST['firstname'])) {
        $errors['firstname'] = '*Put you First Name';
    } else {
        $firstname = $_POST['firstname'];
    }

    if (empty($_POST['lastname'])) {
        $errors['lastname'] = '*Put your Last Name';
    } else {
        $lastname = $_POST['lastname'];
    }

    if (empty($_POST['email'])) {
        $errors['email'] = '*Put your Email Address';
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['number'])) {
        $errors['number'] = '*Put your Number';
    } else {
        $number = $_POST['number'];
    }

    if (empty($_POST['homeadd'])) {
        $errors['homeadd'] = '*Put your Home Address';
    } else {
        $homeadd = $_POST['homeadd'];
    }

    if (empty($_POST['position'])) {
        $errors['position'] = '*Put your Position';
    } else {
        $position = $_POST['position'];
    }


    if (array_filter($errors)) {
    } else {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $homeadd = mysqli_real_escape_string($conn, $_POST['homeadd']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);

        $sql = "INSERT INTO employee(firstname,lastname,email,number,homeadd,position) VALUES('$firstname','$lastname','$email','$number', '$homeadd', '$position')";


        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Error' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center title-text">Employee Details</h4>
    <form action="add.php" method="POST" class="white">
        <label>First Name: <b class="red-text"><?php echo $errors['firstname']; ?></b></label>
        <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname) ?>">

        <label>Last Name: <b class="red-text"><?php echo $errors['lastname']; ?></b></label>
        <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">

        <label>Email Address: <b class="red-text"><?php echo $errors['email']; ?></b> </label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">

        <label>Number (09---------): <b class="red-text"><?php echo $errors['number']; ?></b></label>
        <input type="number" name="number" value="<?php echo htmlspecialchars($number) ?>">

        <label>Home Address: <b class="red-text"><?php echo $errors['homeadd']; ?></b></label>
        <input type="text" name="homeadd" value="<?php echo htmlspecialchars($homeadd) ?>">

        <label>Postion: <b class="red-text"><?php echo $errors['position']; ?></b></label>
        <input type="text" name="position" value="<?php echo htmlspecialchars($position) ?>">

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>


<?php include('templates/footer.php'); ?>
</body>

</html>