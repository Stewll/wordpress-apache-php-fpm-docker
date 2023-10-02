<?php
/* Listens and wait for a POST request to display the new site's information.
    Don't do any checks here. Just display the information in a comprehensive manner. */
// make sure we don't get a PHP Parse error:  syntax error, unexpected 'PhpMyAdmin' (T_STRING), expecting ';' or ',' in /var/www/html/success.php on line 12, referer: http://localhost/create_new_site.php error 
 if (isset($_POST['site_name'])) {
     $site_name = $_POST['site_name'];
     $db_name = $_POST['db_name'];
     $db_user = $_POST['db_user'];
     $db_host = $_POST['db_host'];
     $php_version = $_POST['php_version'];
     $db_password = $_POST['db_password'];
     $db_password = str_repeat('*', strlen($db_password));
 } else {
     header("Location: index.php");
 }
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Success</title>
     <style>
         body {
             font-family: Arial, sans-serif;
                text-align: center;
                background-color: #f0f0f0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }
            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }
            .menu {
                margin-bottom: 20px;
            }
            .menu a {
                display: block;
                margin-bottom: 10px;
                text-decoration: none;
                color: #007BFF;
                font-weight: bold;
            }
            .menu a:hover {
                text-decoration: underline;
            }
            .sites {
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Success!</h1>
            <div class="menu">
                <a href="http://localhost:881">PhpMyAdmin</a>
            </div>
            <div class="sites">
                <p>Site Name: <?php echo $site_name; ?></p>
                <p>Database Name: <?php echo $db_name; ?></p>
                <p>Database User: <?php echo $db_user; ?></p>
                <p>Database Host: <?php echo $db_host; ?></p>
                <p>Database Password: <?php echo $db_password; ?></p>
                <p>PHP Version: <?php echo $php_version; ?></p>
            </div>
        </div>
    </body>
</html>
