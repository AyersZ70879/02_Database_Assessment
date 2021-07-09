<?php
// cat breed name... 
    $breed = $find_rs['Breed'];
    $altname = $find_rs['AltBreedName'];

    // if alt name is not blank
    if ($altname != "") {
        $full_name = $breed." (".$altname.") ";
    }

    else {
        $full_name = $breed;
    }
    ?>