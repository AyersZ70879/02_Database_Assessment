<h2> All Results </h2>

<?php

$find_sql = "SELECT * FROM `breeds`
JOIN about ON (`about`.`Breeds_ID` = `breeds`.`Breeds_ID`)
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// Loop through results and display them...
do {

    $quote = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Breed']);

    // get cat name to display
    include("get_about.php");

    ?>
<div class="results">
    <p>
        <?php echo $quote; ?> <br />
        <!-- display author name -->
        <a href="index.php?page=about&aboutID=<?php echo $find_rs['Breeds_ID']; ?>">
            <?php echo $full_name; ?> 
        </a>
    </p>

    <!-- get subject tags to display -->
   <?php include("show_temp.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));
?>