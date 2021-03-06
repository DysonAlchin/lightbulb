<?php
//includes the Navbar
include "template.php";
/**
 *  This is the user's profile page.
 * It shows the Users details including picture, and a link to edit the details.
 *
 * @var SQLite3 $conn
 */
?>
<!--title-->
<title>User Profile</title>

<!--heading-->
<h1 class='text-primary'>Your Profile</h1>

<?php

//if the user is logged in
if (isset($_SESSION["username"])) {
//session variables into php variables
    $userName = $_SESSION["username"];
    $userId = $_SESSION["user_id"];

//selects all data for user logged in
    $query = $conn->query("SELECT * FROM user WHERE username='$userName'");
    $userData = $query->fetchArray();
//stores data into variables
    $userName = $userData[1];
    $password = $userData[2];
    $name = $userData[3];
    $profilePic = $userData[4];
    $accessLevel = $userData[5];
} else {
    //if not logged in go to home page
    header("Location:index.php");
}
?>

<!--Displays the user information-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
<!--            username-->
            <h3>Username : <?php echo $userName; ?></h3>
<!--            profile picture-->
            <p>Profile Picture:</p>
            <?php echo "<img src='images/profile_pictures/" . $profilePic . "' width='100' height='100'>" ?>
        </div>
        <div class="col-md-6">
<!--            user name-->
            <p> Name : <?php echo $name ?> </p>
<!--            users' access level-->
            <p> Access Level : <?php echo $accessLevel ?> </p>
<!--            edit profile button-->
            <p><a href="edit.php" title="Edit">Edit Profile</a></p>
        </div>
    </div>
</div>

<?php
$numberOfRowsReturned = $conn->querySingle("SELECT count(*) FROM messaging WHERE recipient='$userId'");
if ($numberOfRowsReturned > 0) {
    $messages = $conn->query("SELECT count(*) FROM messaging WHERE recipient='$userId'" );

?>
   <div class="container-fluid">
    <div class="row">
        <div class="col-md-4 text-success"><h2>From</h2></div>
        <div class="col-md-4 text-success"><h2>Message</h2></div>
        <div class="col-md-4 text-success"><h2>Date Sent</h2></div>
    </div>

    <?php
    while($individual_message = $messages->fetchArray()) {
        $sender = $individual_message[1];
        $message = $individual_message[3];
        $dateSubmitted = $individual_message[4];
        ?>
        <divclass="row">
        <divclass="col-md-4"><?php echo$sender;?></div>
        <divclass="col-md-4"><?php echo$message;?></div>
        <divclass="col-md-4"><?php echo$dateSubmitted;?></div>
        </div>

        <?php
    }

}
?>
