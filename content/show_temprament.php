 <!-- temprament tags go here -->
 <p>
        <?php
             $temp1_ID = $find_rs['Temprament1_ID'];
             $temp2_ID = $find_rs['Temprament2_ID'];
             $temp3_ID = $find_rs['Temprament3_ID'];

             $all_temp = array($temp1_ID, $temp2_ID, $temp3_ID);

             // loop through subject ID's and loop up the subject name
             foreach($all_subjects as $subject) {
                 // Get subject name
                 $sub_sql = "SELECT * FROM `subject` WHERE `Subject_ID` = $subject";
                 $sub_query = mysqli_query($dbconnect, $sub_sql);
                 $sub_rs = mysqli_fetch_assoc($sub_query);

                 if($subject != 0)
                 {

             ?>
             <!-- show subjects -->
             <span class="tag">
                <a href="index.php?page=subject&subjectID=<?php echo $sub_rs['Subject_ID']; ?>">
                    <?php echo $sub_rs['Subject']; ?>
                </a>
             </span> &nbsp; 
            
        <?php
            } // end subject exists if

            unset($subject);

            } // end subject loop

        // if logged in, show edit / delete options...
        if (isset($_SESSION['admin'])) {
            ?>

        <div class="edit-tools">

        <a href="index.php?page=../admin/editquote&ID=<?php echo $find_rs['ID']; ?>"
        title="Edit quote"><i class="fa fa-edit fa-2x"></i></a>
        
        &nbsp; &nbsp;

        <a href="index.php?page=../admin/deletequote_confirm&ID=<?php echo 
        $find_rs['ID']; ?>" title="Delete quote"><i class="fa fa-trash fa-2x"></i>
        </a>

        </div> <!-- / edit tools div -->

        <?php
        }

        ?>
    </p>