<?php
include("config/db_connect.php");

$sql = 'SELECT firstname, lastname, email, number, homeadd, position, id FROM employee';
$result = mysqli_query($conn, $sql);
$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

mysqli_close($conn);



?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<?php include('templates/header.php'); ?>
<section class="container grey-text">
    <h4 class="center title-text">Employee List</h4>
    <table class="responsive-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Home Address</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee) { ?>
                <tr>

                    <td><?php echo htmlspecialchars($employee['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($employee['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($employee['email']); ?></td>
                    <td><?php echo htmlspecialchars($employee['number']); ?></td>
                    <td><?php echo htmlspecialchars($employee['homeadd']); ?></td>
                    <td><?php echo htmlspecialchars($employee['position']); ?></td>
                    <td class="col s12 m6 l3">
                        <a href="view.php?id=<?php echo $employee['id']; ?>"
                            class="waves-effect waves-light btn brand">View</a>
                    </td>


                </tr>

            <?php } ?>

        </tbody>
    </table>
    <?php include('templates/footer.php'); ?>

</html>