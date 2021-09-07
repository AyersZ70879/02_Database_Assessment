<?php
if(!isset($_REQUEST['furID'])) {
    header('Location: index.php');
}

$fur_to_find = $_REQUEST['furID'];

    // Find lapcat ID
$fur_sql = "SELECT * FROM `fur` WHERE `Fur_ID` LIKE '%$fur_to_find%'";
$fur_query = mysqli_query($dbconnect, $fur_sql);
$fur_rs = mysqli_fetch_assoc($fur_query);

?>

<h2> Fur Results (<?php echo $fur_rs['Fur']?>) </h2>

<?php

$find_sql = "SELECT * FROM `breeds`
JOIN about ON (`about`.`Breed_ID` = `breeds`.`Breed_ID`)
WHERE `Fur_ID` = $fur_to_find
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

    <!-- Get fur type -->
    <p>
        
            <!-- get lapcat and fur tags to display -->
        <?php include("show_lcf.php"); ?>
        </p>
    

    <!-- temprament tags go here -->
    <?php include("show_temp.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));
?>