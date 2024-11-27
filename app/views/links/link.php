<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Encurtar Links</title>
    <style>
      <?php include 'style.css';?>
    </style>
</head>
<body>
    <form action="/link" method="POST">
        <h1>Encurtador de Links</h1>
        <p>Seu link: <?php echo $_SESSION['shortlink']?></p>
    </form>
</body>
</html>