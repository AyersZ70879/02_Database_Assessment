<h2> Success! </h2>

<p>You have put the following cat breed into the database...</p>

<?php

$breed_ID=$_SESSION['Breed_Success'];


$find_sql = "SELECT * FROM `breeds`
JOIN about ON (`about`.`Breed_ID` = `breeds`.`Breed_ID`) WHERE `ID` = $breed_ID
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);


$lapcat = $find_rs['LapCat_ID'];
$fur = $find_rs['Fur_ID'];

// Loop through results and display them...
do {

    $breed = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Breed']);

    // get about cat to display
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

        <!-- Get fur type -->
        <p>
            <?php
            // show fur type....
            fur_lap($dbconnect, $fur, "Fur Type", "fur", "Fur_ID", 
            "Fur")
            ?>
        </p>

        <!-- Get lap type -->
        <p>
            <?php
            // show lap type....
            fur_lap($dbconnect, $lapcat, "Lap Cat Type", "lapcat", "LapCat_ID", 
            "LapCat")
            ?>
        </p>
            <!-- get subject tags to display -->
            <?php include("show_temp.php"); ?>
        

</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));
?>