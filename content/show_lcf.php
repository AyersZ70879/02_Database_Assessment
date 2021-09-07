 <!-- subject tags go here -->
 <p>
        <?php
             $lapcat_ID = $find_rs['LapCat_ID'];
             $fur_ID = $find_rs['Fur_ID'];
 
             
             
                 // Get lap cat name
                 $lapcat_sql = "SELECT * FROM `lapcat` WHERE `LapCat_ID` = $lapcat_ID";
                 $lapcat_query = mysqli_query($dbconnect, $lapcat_sql);
                 $lapcat_rs = mysqli_fetch_assoc($lapcat_query);

                 if($lapcat_ID != 0)
                 {

             ?>
             <!-- show lapcat -->
             
            <b> Lap Cat: </b><a class="lcf" href="index.php?page=lap&lapID=<?php echo $lapcat_rs['LapCat_ID']; ?>">
                  <?php echo $lapcat_rs['LapCat']; ?>
                </a>
              &nbsp; 
            <br /> <br />
        <?php
            } // end lap exists if

            unset($lapcat);

           
                // Get fur name
                $fur_sql = "SELECT * FROM `fur` WHERE `Fur_ID` = $fur_ID";
                $fur_query = mysqli_query($dbconnect, $fur_sql);
                $fur_rs = mysqli_fetch_assoc($fur_query);

                if($fur_ID != 0)
                {

            ?>
            <!-- show fur -->
            
            <b>Fur Type: </b><a class="lcf" href="index.php?page=fur&furID=<?php echo $fur_rs['Fur_ID']; ?>">
                   <?php echo $fur_rs['Fur']; ?>
               </a>
             &nbsp; 
           
       <?php
           } // end fur exists if

           unset($fur);

           
           ?>
    </p>