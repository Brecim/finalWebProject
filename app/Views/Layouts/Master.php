<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web</title>
    <?=$this->include("Layouts/Links");?>
</head>
<body>
    <?=$this->include("Layouts/Navbar");?>
    
    <?= $this->renderSection("content"); ?>
</body>
</html>