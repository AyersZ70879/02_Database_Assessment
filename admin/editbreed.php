<?php

// check if user is logged in 
if (isset($_SESSION['admin'])) {

$breed_ID = $_REQUEST['ID'];

    // Get author ID
    $find_sql = "SELECT * FROM `breeds`
    JOIN about ON (`breeds`.`Breed_ID` = `about`.`Breed_ID`) WHERE `breeds`.`Breed_ID` = $breed_ID 
    ";

    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);

    $all_lapcat_sql="SELECT * FROM `lapcat` ORDER BY `LapCat` ASC ";
    $all_lapcat = autocomplete_list($dbconnect, $all_lapcat_sql, 'LapCat');

    $all_fur_sql="SELECT * FROM `fur` ORDER BY `Fur` ASC ";
    $all_fur = autocomplete_list($dbconnect, $all_fur_sql, 'Fur');

    // Initialise all variables
    $breed = $find_rs['Breed'];
    $altbreedname = $find_rs['AltBreedName'];
    $maleweight = $find_rs['MaleWtKg'];
    $kittenprice = $find_rs['AvgKittenPrice'];

    $lapcat_code_ID = $find_rs['LapCat_ID'];
    $lapcat_code_rs = get_rs($dbconnect, "SELECT * FROM `lapcat` WHERE 
    `LapCat_ID` = $lapcat_code_ID");
    $lapcat_code = $lapcat_code_rs['LapCat'];
    $lapcat = $lapcat_code;
    
    $fur_code_ID = $find_rs['Fur_ID'];
    $fur_code_rs = get_rs($dbconnect, "SELECT * FROM `fur` WHERE 
    `Fur_ID` = $fur_code_ID");
    $fur_code = $fur_code_rs['Fur'];
    $fur = $fur_code;

    $temprament_1_ID = $find_rs['Temprament1_ID'];
    $temprament_2_ID = $find_rs['Temprament2_ID'];
    $temprament_3_ID = $find_rs['Temprament3_ID'];
    $temprament_4_ID = $find_rs['Temprament4_ID'];
    $temprament_5_ID = $find_rs['Temprament5_ID'];

    $temprament_1_rs = get_rs($dbconnect, "SELECT * FROM `temprament` WHERE 
    `Temprament_ID` = $temprament_1_ID");
    $temprament_2_rs = get_rs($dbconnect, "SELECT * FROM `temprament` WHERE 
    `Temprament_ID` = $temprament_2_ID");
    $temprament_3_rs = get_rs($dbconnect, "SELECT * FROM `temprament` WHERE 
    `Temprament_ID` = $temprament_3_ID");
    $temprament_4_rs = get_rs($dbconnect, "SELECT * FROM `temprament` WHERE 
    `Temprament_ID` = $temprament_4_ID");
    $temprament_5_rs = get_rs($dbconnect, "SELECT * FROM `temprament` WHERE 
    `Temprament_ID` = $temprament_5_ID");

    $temprament_1 = $temprament_1_rs['Temprament'];
    $temprament_2 = $temprament_2_rs['Temprament'];
    $temprament_3 = $temprament_3_rs['Temprament'];
    $temprament_4 = $temprament_4_rs['Temprament'];
    $temprament_5 = $temprament_5_rs['Temprament'];

// set up error fields / visibility
$breed_error = $maleweight_error = $kittenprice_error = 
$lapcat_error = $fur_error = $temprament_1_error = $temprament_2_error = "no-error";

$breed_field = $maleweight_field = $kittenprice_field = "form-ok";
$lapcat_field = $fur_field = $temprament_1_field = $temprament_2_field = "tag-ok";

// Get temprament list from database
$all_tags_sql = "SELECT * FROM `temprament` ORDER BY `Temprament` ASC";
$all_temprament = autocomplete_list($dbconnect, $all_tags_sql, 'Temprament');

$has_errors = "no";

// Code below excutes when the form is submitted...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $breed = mysqli_real_escape_string($dbconnect, $_POST['breed']);
    $altbreedname = mysqli_real_escape_string($dbconnect, $_POST['altbreedname']);

    $maleweight = mysqli_real_escape_string($dbconnect, $_POST['maleweight']);
    $kittenprice = mysqli_real_escape_string($dbconnect, $_POST['kittenprice']);
    $lapcat_code = mysqli_real_escape_string($dbconnect, $_POST['lapcat']);
    $fur_code = mysqli_real_escape_string($dbconnect, $_POST['fur']);

    $temprament_1 = mysqli_real_escape_string($dbconnect, $_POST['temprament1']);
    $temprament_2 = mysqli_real_escape_string($dbconnect, $_POST['temprament2']);
    $temprament_3 = mysqli_real_escape_string($dbconnect, $_POST['temprament3']);
    $temprament_4 = mysqli_real_escape_string($dbconnect, $_POST['temprament4']);
    $temprament_5 = mysqli_real_escape_string($dbconnect, $_POST['temprament5']);

    // Error checking goes here
    
    // check breed name is not blank
    if ($breed == "") {
        $has_errors = "yes";
        $breed_error = "error-text";
        $breed_field = "tag-error";
    }

    // check male weight is not blank
    if (!ctype_digit($maleweight) || $maleweight < 1) {
        $has_errors = "yes";
        $maleweight_error = "error-text";
        $maleweight_field = "tag-error";
    }

    // check kitten price is not blank
    if (!ctype_digit($kittenprice) || $kittenprice < 1) {
        $has_errors = "yes";
        $kittenprice_error = "error-text";
        $kittenprice_field = "tag-error";
    }

    // check lap cat is not blank
    if ($lapcat_code == "") {
        $has_errors = "yes";
        $lapcat_error = "error-text";
        $lapcat_field = "tag-error";
    }

    // check fur type is not blank
    if ($fur_code == "") {
        $has_errors = "yes";
        $fur_error = "error-text";
        $fur_field = "tag-error";
    }

    // check temprament 1 is not blank
    if ($temprament_1 == "") {
        $has_errors = "yes";
        $temprament_1_error = "error-text";
        $temprament_1_field = "tag-error";
    }

    // check temprament is not blank
    if ($temprament_2 == "") {
        $has_errors = "yes";
        $temprament_2_error = "error-text";
        $temprament_2_field = "tag-error";
    }

    if($has_errors != "yes") {

        // get all IDs
        $lapcat_ID = get_ID($dbconnect, 'lapcat', 'LapCat_ID', 'LapCat', $lapcat_code);
        $fur_ID = get_ID($dbconnect, 'fur', 'Fur_ID', 'Fur', $fur_code);
        $temprament_ID_1 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_1);
        $temprament_ID_2 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_2);
        $temprament_ID_3 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_3);
        $temprament_ID_4 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_4);
        $temprament_ID_5 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_5);

        // add about edit to database
        $add_about_sql = "UPDATE `about` SET `Breed` = '$breed', `AltBreedName` = '$altbreedname', `LapCat_ID` = '$lapcat_ID', `Fur_ID` = '$fur_ID', `MaleWtKg` = '$maleweight', `AvgKittenPrice` = '$kittenprice' WHERE `about`.`Breed_ID` = $breed_ID;";
        $add_about_query = mysqli_query($dbconnect, $add_about_sql);

        // add breed edit to database
        $addentry_sql = "UPDATE `breeds` SET `Temprament1_ID` = '$temprament_ID_1', `Temprament2_ID` = '$temprament_ID_2', `Temprament3_ID` = '$temprament_ID_3', `Temprament4_ID` = '$temprament_ID_4', `Temprament5_ID` = '$temprament_ID_5' WHERE `breeds`.`Breed_ID` = $breed_ID;";
        $addentry_query = mysqli_query($dbconnect, $addentry_sql);
 
        // get quote ID for next page
        $get_breed_sql = "SELECT * FROM `breeds` WHERE `Breed_ID` = $breed_ID";
        $get_breed_query = mysqli_query($dbconnect, $get_breed_sql);
        $get_breed_rs = mysqli_fetch_assoc($get_breed_query);

        $ID = $get_breed_rs['ID'];
        $_SESSION['Breed_Success']=$ID;

        // Go to success page...
        header('Location: index.php?page=add_success&breed_ID='.$ID);


    } // end has errors if

} // end submit button if

} // end user logged in if

else {

    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

// ?>

<h1>Edit Cat Breed...</h1>

<form autocomplete="off" method="post" action="<?php 
echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/editbreed&ID=$breed_ID");?>">

        <!-- Cat Breed Name, required -->
        <div class="<?php echo $breed_error; ?>">
            Cat breed name can't be blank
        </div>
        <h3> Cat breed </h3>
        <input class="add-field <?php echo $breed_field; ?>" type="text" name="breed" value="<?php echo 
        $breed; ?>" placeholder="Cat Breed Name" />

        <br /> <br />

        <h3>Alt cat breed name </h3>
        <input class="add-field" type="text" name="altbreedname" value="<?php echo 
        $altbreedname ?>" placeholder="Alternate Cat Breed Name (optional)" />

        <br /> <br />
        <br /> <br />

        <div class="<?php echo $fur_error; ?>">
           Fur type can't be blank
        </div>

        <select class="add-field adv type <?php echo $fur_field; ?>" name="fur">

        <?php 
            if($fur_code=="") {
                ?>
                <option value="" selected>Type of Fur (Choose something)...
                </option>
                <?php
            } // end fur not chose if

            else {
                ?>
                    <option value="<?php echo $fur_code; ?>" selected>
                    <?php echo $fur; ?>
                    </option>

                <?php
            } //  end fur chosen else
            ?>
            <option value="Bald">Bald (no fur)</option>
            <option value="Long">Long Fur</option>
            <option value="Medium">Medium Fur</option>
            <option value="Short">Short Fur</option>
        
        </select>

        <br /> <br />
    
        <div class="<?php echo $lapcat_error; ?>">
            Lap Cat field name can't be blank
        </div>

        <select class="add-field adv type <?php echo $lapcat_field; ?>" name="lapcat">

            <?php 
            if($lapcat_code=="") {
                ?>
                <option value="" selected>Lap Cat? (Choose something)...
                </option>
                <?php
            } // end lapcat not chose if

            else {
                ?>
                    <option value="<?php echo $lapcat_code; ?>" selected>
                    <?php echo $lapcat; ?>
                    </option>

                <?php
            } //  end fur chosen else
            ?>
            <option value="Lap">Lap (cat likes company)</option>
            <option value="Non Lap">Non-Lap (cat is solitary)</option>
            <option value="Rodent">Rodent (it is a rodent catcher)</option>
            <option value="Generic">Generic (likes company and is solitary)</option>
        
        </select>
        
        <br /> <br />
        <br /> <br />
    
        <h3>Average Male Cat Weight (kg)</h3>
    <!-- Male Weight in add entry - Required -->
    <div class="<?php echo $maleweight_error; ?>">
        This field can't be blank, please enter a valid integer
    </div>

    <input class="add-field <?php echo $maleweight_field; ?>" type="text" name="maleweight" value="<?php echo 
        $maleweight; ?>" placeholder="Average Male Cat Weight (kg)" />
    <br /> <br />

    <h3>Average Kitten Price ($)</h3>

    <!-- Avg Kitten Price in add entry - Required -->
    <div class="<?php echo $kittenprice_error; ?>">
        This field can't be blank, please enter a valid integer
    </div>

    <input class="add-field <?php echo $kittenprice_field; ?>" type="text" name="kittenprice" value="<?php echo 
        $kittenprice; ?>" placeholder="Average Kitten Price ($)" />
    <br /> <br />
    <br /> <br />

    <h3>Cat Tempraments...</h3>

        <div class="<?php echo $temprament_1_error; ?>">
            Please enter at least two tempraments for the cat breed
        </div>

        <div class="autocomplete">
            <input class="add-field <?php $temprament_1_field; ?>" id="temprament1" type="text"
            name="temprament1" value="<?php echo $temprament_1; ?>" placeholder="Temprament 1 (Required, Start Typing)...">
        </div>

        <br /> <br />
        
        <div class="<?php echo $temprament_2_error; ?>">
            Please enter at least two tempraments for the cat breed
        </div>

        <div class="autocomplete">
            <input class="add-field <?php $temprament_1_field; ?>" id="temprament2" type="text" name="temprament2" value="<?php echo $temprament_2; ?>"
            placeholder="Temprament 2 (Required, Start Typing)...">
        </div> 

        <br /> <br />

        <div class="autocomplete">
            <input class="add-field" id="temprament3" type="text" name="temprament3" value="<?php echo $temprament_3; ?>"
            placeholder="Temprament 3 (Start Typing)...">
        </div> 

        <br /> <br />

        <div class="autocomplete">
            <input class="add-field" id="temprament4" type="text" name="temprament4" value="<?php echo $temprament_4; ?>"
            placeholder="Temprament 4 (Start Typing)...">
        </div> 

        <br /> <br />

        <div class="autocomplete">
            <input class="add-field" id="temprament5" type="text" name="temprament5" value="<?php echo $temprament_5; ?>"
            placeholder="Temprament 5 (Start Typing)...">
        </div> 

        <br /> <br />

    <!-- Submit Button -->
    <p>
        <input type="submit" value="Submit" />
    </p>


</form>

<!-- script to make autocomplete work -->
<script>
<?php include("autocomplete.php"); ?>

/* Arrays containing lists */
var all_tags = <?php print("$all_temprament"); ?>;
autocomplete(document.getElementById("temprament1"), all_tags);
autocomplete(document.getElementById("temprament2"), all_tags);
autocomplete(document.getElementById("temprament3"), all_tags);
autocomplete(document.getElementById("temprament4"), all_tags);
autocomplete(document.getElementById("temprament5"), all_tags);

</script>
