<html>
<head>
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>

<body>
<div id="container">
    <p>My view has been loaded</p>

    <?php foreach($rows as $r) : ?>
    <h1><?php echo $r->title; ?></h1>
    <div><?php echo $r->contents; ?></div>
    <?php endforeach; ?>

</div>

</body>
</html>