<?php

// check if user is logged in 
if (isset($_SESSION['admin'])) {

    $about_ID = $_SESSION['Add_Breed'];

    if($about_ID=="unknown") {
        // get lap cat, fur and temprament lists from database
        $all_lapcat_sql="SELECT * FROM `lapcat` ORDER BY `LapCat` ASC ";
        $all_lapcat = autocomplete_list($dbconnect, $all_lapcat_sql, 'LapCat');

        $all_fur_sql="SELECT * FROM `fur`ORDER BY `Fur` ASC ";
        $all_fur = autocomplete_list($dbconnect, $all_fur_sql, 'Fur');

    }

    // // initialise author variables
    $breed = "";
    $altbreedname = "";
    $maleweight = "";
    $kittenprice = "";
    $lapcat = "";
    $fur = "";
    $temprament_1 = "";
    $temprament_2 = "";
    $temprament_3 = "";
    $temprament_4 = "";
    $temprament_5 = "";

    // // Initialise lap cat, fur and temprament ID's
    $lapcat_ID = $fur_ID = $temprament_1_ID = $temprament_2_ID = $temprament_3_ID = 
    $temprament_4_ID = $temprament_5_ID = 0;

    // // set up error fields / visibility
    $breed_error = $maleweight_error = $kittenprice_error = 
    $lapcat_error = $fur_error = $temprament_1_error = $temprament_2_error = "no-error";

    $breed_field = $maleweight_field = $kittenprice_field = "form-ok";
    $lapcat_field = $fur_field = $temprament_1_field = $temprament_2_field = "tag-ok";

// Code below excutes when the form is submitted...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //  if breed is unknown, get values from about part of form
    if($about_ID=="unknown") {
        $breed = mysqli_real_escape_string($dbconnect, $_POST['breed']);
        $altbreedname = mysqli_real_escape_string($dbconnect, $_POST['altbreedname']);
        $maleweight = mysqli_real_escape_string($dbconnect, $_POST['maleweight']);
        $kittenprice = mysqli_real_escape_string($dbconnect, $_POST['kittenprice']);

        $lapcat = mysqli_real_escape_string($dbconnect, $_POST['lapcat']);

        $fur = mysqli_real_escape_string($dbconnect, $_POST['fur']);
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
        if ($maleweight == "") {
            $has_errors = "yes";
            $maleweight_error = "error-text";
            $maleweight_field = "tag-error";
        }

        // check kitten price is not blank
        if ($kittenprice == "") {
            $has_errors = "yes";
            $kittenprice_error = "error-text";
            $kittenprice_field = "tag-error";
        }

        // check lap cat is not blank
        if ($lapcat == "") {
            $has_errors = "yes";
            $lapcat_error = "error-text";
            $lapcat_field = "tag-error";
        }

        // check fur type is not blank
        if ($fur == "") {
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


        // get country and occupation IDs
        $lapcat_ID = get_ID($dbconnect, 'lapcat', 'LapCat_ID', 'LapCat', $lapcat);
        $fur_ID = get_ID($dbconnect, 'fur', 'Fur_ID', 'Fur', $fur);

        $temprament_ID_1 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_1);
        $temprament_ID_2 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_2);
        $temprament_ID_3 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_3);
        $temprament_ID_4 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_4);
        $temprament_ID_5 = get_ID($dbconnect, 'temprament', 'Temprament_ID', 'Temprament', $temprament_5);

    } // end getting about values if 

    if($has_errors != "yes") {

        // add cat breed to database if we have a new breed
        if ($about_ID=="unknown")
        {
            // add breed to database
            $add_about_sql = "INSERT INTO `about` 
            (`Breed_ID`, `Breed`, `AltBreedName`, `LapCat_ID`, `Fur_ID`, `MaleWeightKg`, 
            `AvgKittenPrice`) 
            VALUES (NULL, '$breed', '$altbreedname', '$lapcat_ID', '$fur_ID', 
            '$maleweight', '$kittenprice');";
            $add_about_query = mysqli_query($dbconnect, $add_about_sql);
            
            // Get About ID
            $find_about_sql = "SELECT * FROM `about` WHERE `Breed` = '$breed'";
            $find_about_query = mysqli_query($dbconnect, $find_about_sql);
            $find_about_rs = mysqli_fetch_assoc($find_about_query);

            $new_aboutID = $find_about_rs['Breed_ID'];
            echo "New Breed ID:".$new_aboutID;

            $about_ID = $new_aboutID;
        }

      // add entry to database
        $addentry_sql = "INSERT INTO `breeds` (`ID`, `Breed_ID`, `Temprament1_ID`, `Temprament2_ID`, `Temprament3_ID`, `Temprament4_ID`, `Temprament5_ID`) VALUES (NULL, '$breed_ID', '$temprament_1_ID', '$temprament_2_ID', '$temprament_3_ID', '$temprament_4_ID', '$temprament_5_ID');";
        $addentry_query = mysqli_query($dbconnect, $addentry_sql);

        // get quote ID for next page
        $get_quote_sql = "SELECT * FROM `quotes` WHERE `Quote` = '$quote'";
        $get_quote_query = mysqli_query($dbconnect, $get_quote_sql);
        $get_quote_rs = mysqli_fetch_assoc($get_quote_query);

        $quote_ID = $get_quote_rs['ID'];
        $_SESSION['Quote_Success']=$quote_ID;

        // Go to success page...
        header('Location: index.php?page=quote_success');


    } // end has errors if

} // end submit button if

} // end user logged in if

else {

    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

// ?>

<h1>Add Quote...</h1>

<form autocomplete="off" method="post" action="<?php 
echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/add_entry");?>">

    <?php
    // fields to add new author information

    if ($author_ID=="unknown") {
        ?>
        <!-- Author's first name, optional -->
        <input class="add-field" type="text" name="first" value="<?php echo 
        $first; ?>" placeholder="Author's First Name" />

        <br /> <br />

        <input class="add-field" type="text" name="middle" value="<?php echo 
        $middle ?>" placeholder="Author's Middle Name (optional)" />

        <br /> <br />

        <div class="<?php echo $last_error; ?>">
            Author's last name can't be blank
        </div>

        <input class="add-field" <?php echo $last_field; ?> type="text"
        name="last" value="<?php echo $last; ?>" placeholder="Author's Last Name"
        />

        <br /> <br />

        <select class="adv gender <?php echo $gender_field; ?>" name="gender">

            <?php 
            if($gender_code=="") {
                ?>
                <option value="" selected>Gender (Choose something)...
                </option>
                <?php
            } // end gender not chose if

            else {
                ?>
                    <option value="<?php echo $gender_code; ?>" selected>
                    <?php echo $gender; ?>
                    </option>

                <?php
            } //  end gender chosen else
            ?>
            <option value="F">Female</option>
            <option value="M">Male</option>
        
        </select>

        <br /> <br />
        
        <div class="<?php echo $yob_error; ?>">
            Please enter a valid year of birth (modern author's only).
        </div>

        <input class="add-field <?php echo $yob_field; ?>" type="text" name="yob"
        value="<?php echo $yob; ?>" placeholder="Author's year of birth" />

        <br /> <br />

        <div class="<?php echo $country_1_error; ?>">
            Please enter at least one country
        </div>

        <div class="autocomplete">
            <input class="<?php $country_1_field; ?>" id="country1" type="text"
            name="country1" value="<?php echo $country_1; ?>" placeholder="Country 1 (Required, Start Typing)...">
        </div>

        <br /> <br />

        <div class="autocomplete">
            <input id="country2" type="text" name="country2" value="<?php echo $country_2; ?>"
            placeholder="Country 2 (Start Typing)...">
        </div> 

        <br /> <br />

        <div class="<?php echo $occupation_1_error; ?>">
            Please enter at least one country
        </div>

        <div class="autocomplete">
            <input class="<?php echo $occupation_1_field; ?>" id="occupation1" type="text"
            name="occupation1" value="<?php echo $occupation_1; ?>" placeholder="Occupation 1 (Required, Start Typing)...">
        </div>
        <br /> <br />

        <div class="autocomplete">
            <input type="text" id="occupation2" name="occupation2" value="<?php echo $occupation_2; ?>"
            placeholder="Occupation 2 (Start Typing...)">
        </div>

        <br /> <br />

        <?php

    } // end new author fields


    ?>

    <!-- Quote text area -->

    <!-- Quote entry in add entry - Required -->
    <div class="<?php echo $quote_error; ?>">
        This field can't be blank
    </div>

    <textarea class="add-field <?php echo $quote_field?>" name="quote" rows="6"><?php echo $quote; ?></textarea>

    <!-- Notes section in add entry -->
    <input class="add-field <?php echo $notes; ?>" type="text" name="notes" value="<?php
    echo $notes; ?>" placeholder="Notes (optional) ..."/>
    <br /> <br />

    <!-- Subject 1 entry in add entry - Required -->
    <div class="<?php echo $tag_1_error; ?>">
        Please enter at least one subject tag
    </div>
    <div class="autocomplete">
        <input class="<?php echo $tag_1_field; ?>" id="subject1" type="text" name="Subject_1" 
        value="<?php echo $tag_1; ?>" placeholder="Subject 1 (Start Typing...)">
    </div>

     <br /> <br />

    <!-- Subject 2 entry in add entry -->
    <div class="autocomplete">
    
        <input id="subject2" type="text" name="Subject_2" value="<?php echo $tag_2; ?>"
        placeholder="Subject 2 (Start Typing, optional)...">
    </div>

    <br /> <br />

    <!-- Subject 3 entry in add entry -->
    <div class="autocomplete">
    
        <input id="subject3" type="text" name="Subject_3" placeholder="Subject 3 (Start Typing, optional)...">
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
var all_tags = <?php print("$all_subjects"); ?>;
autocomplete(document.getElementById("subject1"), all_tags);
autocomplete(document.getElementById("subject2"), all_tags);
autocomplete(document.getElementById("subject3"), all_tags);

<?php

    if ($author_ID == "unknown"){

    ?>

    var all_countries = <?php print("$all_countries"); ?>;
    autocomplete(document.getElementById("country1"), all_countries);
    autocomplete(document.getElementById("country2"), all_countries);

    var all_occupations = <?php print("$all_occupations"); ?>;
    autocomplete(document.getElementById("occupation1"), all_occupations);
    autocomplete(document.getElementById("occupation2"), all_occupations);


        <?php
    } // end author unknown if

    ?>


</script>
