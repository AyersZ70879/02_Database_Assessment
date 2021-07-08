 <!-- subject tags go here -->
 <p>
        <?php
             $temp1_ID = $find_rs['Temprament1_ID'];
             $temp2_ID = $find_rs['Temprament2_ID'];
             $temp3_ID = $find_rs['Temprament3_ID'];
             $temp4_ID = $find_rs['Temprament4_ID'];
             $temp5_ID = $find_rs['Temprament5_ID'];

             $all_temp = array($temp1_ID, $temp2_ID, $temp3_ID, $temp4_ID, $temp5_ID);

             // loop through temprament ID's and loop up the subject name
             foreach($all_temp as $temp) {
                 // Get temprament name
                 $temp_sql = "SELECT * FROM `temprament` WHERE `Temprament_ID` = $temp";
                 $temp_query = mysqli_query($dbconnect, $temp_sql);
                 $temp_rs = mysqli_fetch_assoc($temp_query);

                 if($temp != 0)
                 {

             ?>
             <!-- show temprament -->
             <span class="tag">
                <a href="index.php?page=temp&tempID=<?php echo $temp_rs['Temprament_ID']; ?>">
                    <?php echo $temp_rs['Temprament']; ?>
                </a>
             </span> &nbsp; 
            
        <?php
            } // end temprament exists if

            unset($temp);

            } // end temprament loop

        // if logged in, show edit / delete options...
        if (isset($_SESSION['admin'])) {
            ?>

        <div class="edit-tools">

        <a href="index.php?page=../admin/editbreed&ID=<?php echo $find_rs['ID']; ?>"
        title="Edit Breed"><i class="fa fa-edit fa-2x"></i></a>
        
        &nbsp; &nbsp;

        <a href="index.php?page=../admin/deletebreed_confirm&ID=<?php echo 
        $find_rs['ID']; ?>" title="Delete Breed"><i class="fa fa-trash fa-2x"></i>
        </a>

        </div> <!-- / edit tools div -->

        <?php
        }

        ?>
    </p>