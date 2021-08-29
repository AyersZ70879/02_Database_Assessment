<?php

// check the user is logged in... 
if (isset($_SESSION['admin'])) {

    // delete breed
    $deletebreed_sql = "DELETE FROM breeds WHERE `Breed_ID`=".$_REQUEST['ID'];
    $deletebreed_query = mysqli_query($dbconnect, $deletebreed_sql);

    $deletebreeds_sql = "DELETE FROM about WHERE `Breed_ID`=".$_REQUEST['ID'];
    $deletebreeds_query = mysqli_query($dbconnect, $deletebreeds_sql);
    
?>

<h1>Delete Success</h1>

<p>The cat breed has been deleted</p>

<?php

} // end user logged in if

else {
    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

?>