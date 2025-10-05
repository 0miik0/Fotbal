<?php // Minimal layout template - renders sections from child views ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= isset($title) ? esc($title) : 'Fotbal' ?></title>
	<!-- Optional: include Bootstrap CSS from CDN -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>

</head>
<body class="background">
<style >
    .background{
        background-color: #b3cee9ff;
    }
    .content_background{
        background-color: #d1e7fdff;
        padding: 20px;
        border-radius: 5px;
</style>

<?= $this->include("layout/navbar"); ?> 
<div class="container mt-4 content_background">
	<?= $this->renderSection('content') ?>
</div>


</body>
</html>
