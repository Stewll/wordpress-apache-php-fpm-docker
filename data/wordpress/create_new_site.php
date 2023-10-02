<?php 
// Listen for POST requests and store the PHP version and site name in variables
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $php_version = $_POST['php_version'];
    $site_name = $_POST['site_name'];
    // Check if the PHP version is valid. If not, set it to 7
    if ($php_version != 7 && $php_version != 8) {
        $php_version = 7;
    }
    // Check if the site name is valid.Sites can only contain letters, numbers, hyphens, and underscores
    if (!preg_match('/^[a-zA-Z0-9-_]+$/', $site_name)) {
        echo "Site name is not valid.";
        exit();
    }
    // Create a directory for the new site if it does not exist
    if (!file_exists($site_name)) {
        mkdir($site_name);
    }
    // Check if the directory is empty. If not, throw an error and continue
    if (glob($site_name . "/*")) {
        echo "Directory $site_name is not empty.";
    } else {
        // Download WordPress into the new site directory using curl
        shell_exec("curl -o $site_name/wordpress.tar.gz https://wordpress.org/latest.tar.gz");
        // Extract the WordPress archive
        shell_exec("tar -xzf $site_name/wordpress.tar.gz -C $site_name --strip-components=1");
        // Remove the WordPress archive
        shell_exec("rm $site_name/wordpress.tar.gz");
        // Copy the wp-config-sample.php file to wp-config.php
        shell_exec("cp $site_name/wp-config-sample.php $site_name/wp-config.php");
        // Set the database name to the site name
        $db_name = $site_name;
        // Get database user and password from environment variables
        $db_user = getenv('DB_USER');
        $db_password = getenv('DB_PASSWORD');
        $db_host = 'mysql';
        // Check if the database user and password are valid
        if (!$db_user || !$db_password) {
            echo "Database user or password is not set.";
            exit();
        }
        // Check if the database host is valid
        if (!$db_host) {
            echo "Database host is not set.";
            exit();
        }
        /* Check if the database exists.
        If it does not exist, then create it.
        If it exists, then throw an error and continue. */
        $mysqli = new mysqli($db_host, $db_user, $db_password);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }
        $result = $mysqli->query("SHOW DATABASES LIKE '$db_name'");
        if ($result->num_rows == 0) {
            $mysqli->query("CREATE DATABASE $db_name");
        } else {
            echo "Database $db_name already exists.";
        }
        $mysqli->close();

        // Create the wp-config.php file 
        $config_content = file_get_contents("$site_name/wp-config-sample.php");
        // Replace placeholders in the config file with actual values
        $config_content = str_replace('database_name_here', $db_name, $config_content);
        $config_content = str_replace('username_here', $db_user, $config_content);
        $config_content = str_replace('password_here', $db_password, $config_content);
        $config_content = str_replace('localhost', $db_host, $config_content);
        file_put_contents("$site_name/wp-config.php", $config_content);
        // Create the info.php file in the new site directory
        $info_php = '<?php phpinfo(); ?>';
        file_put_contents("$site_name/info.php", $info_php);
        // Create the .htaccess file and add PHP 8 configuration if applicable
        if ($php_version == 8) {
            $htaccess_content = '<FilesMatch \.php$>' . PHP_EOL;
            $htaccess_content .= '    SetHandler "proxy:fcgi://php8:9000/$1"' . PHP_EOL;
            $htaccess_content .= '</FilesMatch>' . PHP_EOL;

            file_put_contents("$site_name/.htaccess", $htaccess_content, FILE_APPEND);
        }
        // Redirect the user to the success page but don't send the password
        header("Location: success.php?site_name=$site_name&db_name=$db_name&db_user=$db_user&db_host=$db_host");

        
    }
}
?>
<!--Create a sexy form to get the PHP version and site name
    First, a little bit of CSS to make it look nice-->
<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f0f0f0;
    }
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }
    input[type=text] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }
    input[type=submit] {
        padding: 10px 20px;
        border-radius: 5px;
        border: 1px solid #007BFF;
        background-color: #007BFF;
        color: #fff;
        font-weight: bold;
    }
    input[type=submit]:hover {
        cursor: pointer;
        background-color: #0069D9;
    }
</style>
<!--Create a sexy header-->
<header>
    <h1>Create a New WordPress Site</h1>
</header>
<!--Create the form, using those sexy CSS styles -->
<form method="POST">
    <label for="php_version">PHP Version</label>
    <select name="php_version" id="php_version">
        <option value="7">7</option>
        <option value="8">8</option>
    </select>
    <label for="site_name">Site Name</label>
    <input type="text" name="site_name" id="site_name" placeholder="Site Name">
    <input type="submit" value="Create Site">
</form>
<!--Create a sexy footer-->
<footer>
    <!-- feet are sexy, right? -->
    <p>footer text</p>
</footer>
