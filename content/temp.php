<?php
if(!isset($_REQUEST['tempID'])) {
    header('Location: index.php');
}

$temp_to_find = $_REQUEST['tempID'];

    // get temprament heading...
    $temp_sql = "SELECT * FROM `temprament` WHERE `Temprament_ID` = $temp_to_find";
    $temp_query = mysqli_query($dbconnect, $temp_sql);
    $temp_rs = mysqli_fetch_assoc($temp_query);

?>

<h2> Temperament Results (<?php echo $temp_rs['Temprament']?>) </h2>

<?php

$find_sql = "SELECT * FROM `breeds`
JOIN about ON (`about`.`Breed_ID` = `breeds`.`Breed_ID`)
WHERE `Temprament1_ID` = $temp_to_find
OR `Temprament2_ID` = $temp_to_find
OR `Temprament3_ID` = $temp_to_find
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// Loop through results and display them...
do {

    $breed = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Breed']);

    // about cat name... 
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

    

    <!-- temprament tags go here -->
    <?php include("show_temp.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));
?>