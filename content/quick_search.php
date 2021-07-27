<?php

$quick_find = mysqli_real_escape_string($dbconnect, $_POST['quick_search']);

// Find subject ID
$temp_sql = "SELECT * FROM `temprament` WHERE `Temprament` LIKE '%$quick_find%'";
$temp_query = mysqli_query($dbconnect, $temp_sql);
$temp_rs = mysqli_fetch_assoc($temp_query);

$temp_count = mysqli_num_rows($temp_query);

if ($temp_count > 0) {
    $temp_ID = $temp_rs['Temprament_ID'];
}

else {
    // if this is not set query below breaks
    // if it is set to zero, any breed which has less than three subjects will be displayed
    $temp_ID = "-1";
}

$find_sql = "SELECT * FROM `breeds`
JOIN about ON (`about`.`Breed_ID` = `breeds`.`Breed_ID`)
WHERE `Breed` LIKE '%$quick_find%'
OR `Temprament1_ID` LIKE '%$quick_find%'
OR `Temprament2_ID` = $temp_ID
OR `Temprament3_ID` = $temp_ID
OR `Temprament4_ID` = $temp_ID
OR `Temprament5_ID` = $temp_ID
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);
$count = mysqli_num_rows($find_query);


?>

<h2>Quick Search Results (Search Term: <?php echo $quick_find ?>)</h2>

<?php

if($count > 0) {

// Loop through results and display them...
do {

    $breed = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Breed']);

    // get author name to display
    include("get_about.php");

    ?>
<div class="results">
    <p>
    <!-- display cat name -->
    <a class="catdisplay" href="index.php?page=about&aboutID=<?php echo $find_rs['Breed_ID']; ?>">
            <?php echo $full_name; ?>
        </a>
    </p>

    <!-- get male weight to display -->
    <p><b>Male Weight:</b> <?php echo $find_rs['MaleWtKg']; ?>kg </p>

    <!-- Get avg kitten price -->
    <p><b>Average Kitten Price: </b>$<?php echo $find_rs['AvgKittenPrice']; ?> </p>

    
    <!-- get subject tags to display -->
   <?php include("show_temp.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));

} // end if results and display them...

else {
?>

<h2>Oops!</h2>

    <div class="error">
        Sorry - there are no cat breeds that match the search term <i><b><?php echo $quick_find
        ?> </b> </i>. Please try again.    
    </div>

<p>&nbsp;</p>
<?php
    }
?>
