<h2> All Results </h2>

<?php

$find_sql = "SELECT * FROM `breeds`
JOIN `about` ON (`about`.`Breed_ID` = `breeds`.`Breed_ID`)
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// Loop through results and display them...
do {

    // get cat name to display
    include("get_about.php");

    ?>
<div class="results">
    <p>
        <!-- display cat name -->
        <a class="catdisplay" href="index.php?page=about&aboutID=<?php echo $find_rs['Breed_ID']; ?>">
            <?php echo $full_name; ?>
        </a>

        <p><b>Male Weight:</b> <?php echo $find_rs['MaleWtKg']; ?>kg </p>


    </p>

    <!-- get subject tags to display -->
   <?php include("show_temp.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));
?>