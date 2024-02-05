<?php
require_once 'connect.php';
require_once 'header.php';
require_once 'security.php';

if (isset($_POST['submit'])) {

    $newUname = mysqli_real_escape_string($dbcon, $_POST['username']);
    $newPass = mysqli_real_escape_string($dbcon, $_POST['password']);
    $newEmail = mysqli_real_escape_string($dbcon, $_POST['email']);

    $slug = slug($newUname);
    $date = date('Y-m-d H:i');
    $posted_by = mysqli_real_escape_string($dbcon, $_SESSION['username']);

    $sql = "INSERT INTO posts (username,password,email, date) VALUES('$newUname','$newPass', '$newEmail','$date')";
    mysqli_query($dbcon, $sql) or die("failed to post" . mysqli_connect_error());

    $permalink = "p/".mysqli_insert_id($dbcon) ."/".$slug;

    printf("Registered successfully. <meta http-equiv='refresh' content='2; url=%s'/>",
       $permalink);

} else {
    ?>
<div class="w3-container">
    <div class="w3-card-4">
        <div class="w3-container w3-teal">
            <h2>New Admin</h2>
        </div>

        <form class="w3-container" method="POST">

            <p>
                <label>username</label>
                <input type="text" class="w3-input w3-border" name="username" required>
            </p>
            <p>
                <label>password</label>
                <input type="text" class="w3-input w3-border" name="username" required>
            </p>
            <p>
                <label>email</label>
                <input type="text" class="w3-input w3-border" name="username" required>
            </p>
            <p>
                <input type="submit" class="w3-btn w3-teal w3-round" name="submit" value="Post">
            </p>
        </form>

    </div>
</div>
<?php
}

include("footer.php");