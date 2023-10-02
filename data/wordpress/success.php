<!DOCTYPE html>
<html lang="en">
<!-- Link the CSS file -->
<link rel="stylesheet" href="style.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
</head>
<body>
    <div class="container">
        <p>Success!</p>
        <div class="menu">
            <a href="http://localhost">Home</a>
            <a href="http://localhost/create_new_site.php">Create New Site</a> <!--Add a link to the create new site page-->
            <a href="http://localhost:881">PhpMyAdmin</a> 
    <!--Add a link to the PHP info page of the new site-->
            <a href="http://localhost/<?php echo $_GET['site_name']; ?>/info.php">New Website's PHP Info</a>
        </div>
        <!--Display the site information, url, php version, etc, in a clear manner and abusing the CSS-->
        <div class="sites">
            <!-- Higlight the site name and database name in bold -->
            <p>Site Name: <b><?php echo $_GET['site_name']; ?></b></p>
            <p>Database Name: <b><?php echo $_GET['db_name']; ?></b></p>
            <p>Database User: <?php echo $_GET['db_user']; ?></p>
            <p>Database Host: <?php echo $_GET['db_host']; ?></p>
            <p>PHP Version: <?php echo $_GET['php_version']; ?></p>
            <p>Site URL: <a href="http://localhost/<?php echo $_GET['site_name']; ?>">http://localhost/<?php echo $_GET['site_name']; ?></a></p>        
            <p>PhpMyAdmin URL: <a href="http://localhost:881">http://localhost:881</a></p>
        </div>
    