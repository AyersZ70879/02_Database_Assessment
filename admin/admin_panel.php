<?php

// check user is logged in... 
if (isset($_SESSION['admin'])) {

    // get breeds from database 
    $all_about_sql = "SELECT * FROM `about` ORDER BY `Breed` ASC ";
    $all_about_query = mysqli_query($dbconnect, $all_about_sql);
    $all_about_rs = mysqli_fetch_assoc($all_about_query);

    // initialise breed name form
    $breed = "";
    $altname = "";

    // Code below executes when the form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // get values from form...
        $about_ID = mysqli_real_escape_string($dbconnect, $_POST['about']);
        header("Location: index.php?page=about&aboutID=".$about_ID);
    
    } // end submit button pushed if

?>
<h1>Admin Panel</h1>
<p>
    To <a href="index.php?page=../admin/new_breed">add a cat breed</a>, use the precending link
    or the '+' symbol at the top right of the page. 
</p>

<p>
    Cat breeds can be edited / deleted by searching for a breed and then clicking
    on the 'edit' / 'delete' icons at the botton right of each cat type. If you 
    don't see icons to edit / delete quotes, it means you are logged out.
</p>

<h2>Cat Breeds...</h2>

<p>
    Either <a href="index.php?page=../admin/add_about">Add a Cat Breed</a>
    or choose an cat breed from the dropdown list below to edit / delete an existing 
    cat breed.
</p>

<form method="post" enctype="multipart/form-data" action="<?php 
echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/admin_panel");?>">

    <div>


        <select name="about">
            <!-- Default option is choose -->
            <option value="unknown" selected>Choose...</option>

            <?php
            do {

                // get breed full name (name and then alt)
                $about_full = $all_about_rs['Breed']."
                ".$all_about_rs['AltBreedName'];

            ?>

            <option value="<?php echo $all_about_rs['Breed_ID']; ?>">
                <?php echo $about_full; ?>
            </option>

            <?php


            } // end of breed about options 'do'

            while($all_about_rs=mysqli_fetch_assoc($all_about_query))

            ?>

        </select>

            &nbsp;

        <input class="short" type="submit" name="breed_about" value="Next..." />

    </div>

</form>

&nbsp; &nbsp;
<p>
<a href="index.php?page=../admin/logout" title="Log out">
    Log Out
</a>
</p>

<?php
} // end user logged in if

else {

    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else
?>
&nbsp;
