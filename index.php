<!DOCTYPE HTML>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cat Characteristics">
    <meta name="keywords" content="cat, cat characteristics, pet characteristics, pet, pets, cats">
    <meta name="author" content="Zarah Ayers">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Cat Characteristics</title>
    
    <!-- Edit the link below / replace with your chosen google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato%7cUbuntu" rel="stylesheet"> 
    
    <!-- Edit the name of your style sheet - 'foo' is not a valid name!! -->
    <link rel="stylesheet" href="css/cat_breeds.css"> 
        <link rel="stylesheet" href="css/font-awesome.min.css">
    
</head>
    
<body>
    
    <div class="wrapper">
    

        
        <div class="box banner">
            
    
            <h1>
                <a href="index.php" class="home" >Cat Characteristics</a>
            </h1>
        </div>    <!-- / banner -->

        <!-- Navigation goes here.  Edit BOTH the file name and the link name -->
        <div class="box nav">
            
            <div class="linkwrapper">
                <div class="commonsearches">
                    <a href="#l">Show All</a> | 
                    <a href="#">Random</a> | 
                    <a href="#">Recent</a> 
                </div>  <!-- / common searches -->
            
                <div class="topsearch">
                    
                    <!-- Quick Search -->           
                    <form method="post" action="quick_search.php" enctype="multipart/form-data">

                        <input class="search quicksearch" type="text" name="quick_search" size="40" value="" required placeholder="Quick Search..." />

                        <input class="submit" type="submit" name="find_quick" value="&#xf002;" />

                    </form>     <!-- / quick search -->
                    
                </div>  <!-- / top search -->
                
                <div class="topadmin">
                    <a href="#">Log In</a>
                    
                </div>  <!-- / top admin -->
                
            </div>  <!--- / link wrapper -->
            
        </div>    <!-- / nav -->        
        
        <div class="box main">
            <h2>Cat Characteristics Database</h2>
            
            <p>
            This website contains information about different types of cats
            </p>
            
            <p>
                It tells you about each cat type and what each are like as a pet    
            </p>
            
            <p>
                You can view all the cat types in the show all tag, or you can find a random or recent cat types that have been added into the database    
            </p>

            <p>
                If you are an admin you can also sign in and edit (by adding or removing) different types of cats  
            </p>
            
        </div>    <!-- / main -->
        

        <div class="box footer">
            CC Zarah Ayers 2021
        </div>    <!-- / footer -->
    
    </div>  <!-- / wrapper  -->
    
</body>        
