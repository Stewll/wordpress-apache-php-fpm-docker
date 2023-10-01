<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordPress Sites</title>
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
        <h1>WordPress Sites</h1>
        <div class="menu">
            <a href="http://localhost:881">PhpMyAdmin</a>
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
