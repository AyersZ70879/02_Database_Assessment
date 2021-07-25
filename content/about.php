<?php

if(!isset($_REQUEST['aboutID']))
{
    header('Location: index.php');
}

$about_to_find = $_REQUEST['aboutID'];

$find_sql = "SELECT * FROM `about`
WHERE `Breed_ID` = $about_to_find
";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

$lapcat = $find_rs['LapCat_ID'];
$fur = $find_rs['Fur_ID'];

// get cat name to display
include("get_about.php");

?>
<br />
<div class="about">
    <h2>
        <?php echo $full_name ?> - About
    </h2>

    <?php

    // if logged in, show edit / delete options... 
    if (isset($_SESSION['admin'])) {

        ?>

        <div class="edit-tools">

        <a href="index.php?page=../admin/editabout&aboutID=<?php echo 
        $find_rs['Breed_ID']; ?>" title="Edit cat breed"><i class="fa fa-edit fa-
        2x"></i></a>

        &nbsp; &nbsp;

        <a href="index.php?page=../admin/deleteabout_confirm&ID=<?php echo 
        $find_rs['Breed_ID']; ?>" title="Delete cat breed"><i class="fa fa-trash fa-
        2x"></i></a>
        
        </div> <!-- cat edit tools -->

        <?php

    } //  end edit cat tools

?>

</div> <!-- / about cat div -->

<br />

<?php

// see if there are any cat breeds
$find_breeds_sql = "SELECT * FROM `breeds` WHERE `Breed_ID` = 
$about_to_find";
$find_breeds_query = mysqli_query($dbconnect, $find_breeds_sql);
$find_breeds_rs = mysqli_fetch_assoc($find_breeds_query);

$count = mysqli_num_rows($find_breeds_query);

    if($count > 0) {
        // find cat breeds if they exist... 
        $find_sql = "SELECT * FROM `breeds`
        JOIN about ON (`about`.`Breed_ID` = `breeds`.`Breed_ID`) WHERE `breeds`.`Breed_ID` = $about_to_find";
        $find_query = mysqli_query($dbconnect, $find_sql);
        $find_rs = mysqli_fetch_assoc($find_query);
    

// Loop through results and display them...
do {

    $breed = preg_replace('/[^A-Za-z0-9.,?\s\'\-]/', ' ', $find_rs['Breed']);
    

    ?>
<div class="results">
    <!-- get male weight to display -->
    <p><b>Male Weight:</b> <?php echo $find_rs['MaleWtKg']; ?>kg </p>

    <!-- Get avg kitten price -->
    <p><b>Average Kitten Price: </b>$ <?php echo $find_rs['AvgKittenPrice']; ?> </p>

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
        fur_lap($dbconnect, $fur, "Lap Cat Type", "lapcat", "LapCat_ID", 
        "LapCat")
        ?>
    </p>

    <!-- get temprament tags to display -->
   <?php include("show_temp.php"); ?>
    
</div>
<br />

<?php
} // end of display results 'do'

while($find_rs = mysqli_fetch_assoc($find_query));

} // end find quotes if
?>