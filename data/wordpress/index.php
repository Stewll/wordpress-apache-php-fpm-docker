<?php

/* Add a menu to the top of the page. The menu will contain links to the
PhpMyAdmine docker container "pma:881" */
echo "<h1>Wordpress Sites</h1>";
echo "<a href='http://pma:881'>PhpMyAdmin</a><br>";



/* List Files and directories inside the data/wordpress directory
and create a browsable link for each file and directory. Each sub folder 
will be a potential wordpress site. */
$dir = "data/wordpress";
$files = scandir($dir);
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        echo "<a href='http://localhost:8080/$file'>$file</a><br>";
    }
}
?>

