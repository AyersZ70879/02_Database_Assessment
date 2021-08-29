<?php

// check the user is logged in... 
if (isset($_SESSION['admin'])) {

    $breed_ID = $_REQUEST['ID'];

    $deletebreed_sql = "SELECT *FROM `about` WHERE `Breed_ID` =".$_REQUEST['ID'];
    $deletebreed_query = mysqli_query($dbconnect, $deletebreed_sql);
    $deletebreed_rs=mysqli_fetch_assoc($deletebreed_query);

    ?>
    <h2>Delete Breed - Confirm</h2>
    <p> Do you really want to delete the following cat breed... <br />
    <i><?php echo $deletebreed_rs['Breed']; ?></i></p>
    
    <p>
        <a href="index.php?page=../admin/deletebreed&ID=<?php echo $_REQUEST['ID'];?>"
        >Yes, Delete it!</a>
        <a href="index.php">No, take me home</a>
    </p>

    <?php

} // end user logged in if

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

?>