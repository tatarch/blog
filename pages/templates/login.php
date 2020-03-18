<?php
/**
 * @var string $content
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/03f36d3c54.js" crossorigin="anonymous"></script>
    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <link href="/assets/css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <header>
                <nav class="nav-nav">
                    <a class="logo" href="/home/default">
                        <span>LOGO</span>
                    </a>
                </nav>
            </header>
        </div>
    </div>
</div>
<?= $content ?>
</body>
</html>
