<h2> Random Cat Breeds </h2>

<?php

$find_sql = "SELECT * FROM `breeds`
JOIN `about` ON (`about`.`Breed_ID` = `breeds`.`Breed_ID`) ORDER BY RAND() LIMIT 10
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

        <!-- Get male weight -->
        <p><b>Male Weight:</b> <?php echo $find_rs['MaleWtKg']; ?>kg </p>

        <!-- Get avg kitten price -->
        <p><b>Average Kitten Price: </b>$<?php echo $find_rs['AvgKittenPrice']; ?> </p>



    </p>

    <!-- get subject tags to display -->
   <?php include("show_temp.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));
?>