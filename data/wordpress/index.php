<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordPress Sites</title>
<!--Add a link to the CSS file-->
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>WordPress Sites</h1>
        <!-- Header style menu with links to PhpMyAdmin and the create new site page next one to another -->
        <div class="menu">
            <a href="http://localhost:881">PhpMyAdmin</a>
            <a href="http://localhost/create_new_site.php">Create New Site</a>
        </div>
        

        <div class="sites">
            <?php
            $dir = ".";
            $files = array_diff(scandir($dir), array('..', '.'));
            foreach ($files as $file) {
                if (is_dir($file)) {
                    echo "<a href='http://localhost/$file/'>$file/</a><br>";
                } else {
                    echo "<a href='http://localhost/$file'>$file</a><br>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
