<?php
require 'vendor/autoload.php';

header("Content-Type: text/html");

// Swagger UI na files load karo
$swagger_ui_url = "https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui-bundle.js";
$swagger_css_url = "https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui.css";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swagger API Documentation</title>
    <link rel="stylesheet" href="<?= $swagger_css_url ?>">
</head>

<body>
    <div id="swagger-ui"></div>
    <script src="<?= $swagger_ui_url ?>"></script>
    <script>
        window.onload = function() {
            const ui = SwaggerUIBundle({
                url: "/swagger/swagger.json", // Tamara Swagger JSON file nu path
                dom_id: '#swagger-ui',
            });
        };
    </script>
</body>

</html>