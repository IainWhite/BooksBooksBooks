<?php include('siteconfig.php'); ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title>404 Page Not Found - <?php echo $site_title; ?></title>
		<meta name="description" content="Page Not Found (404) for <?php echo $site_title; ?>. The White Internet book store by Iain White.">
		<meta name="keywords" content="<?php echo $site_keywords; ?>">
		<!-- CSS and Scripts -->
		<?php include 'includes/headscripts.php'; ?>
		<?php include 'ads/head_code.php'; ?>
    </head>
<body>
<?php include 'includes/header.php'; ?>

<div class="box-pagecontent">
    <div class="container">
        <div class="posttitle">
            <h1>404 Page Not Found</h1>
        </div>
        <div class="randombox">
            <p>Page not found. We are sorry, but we could not find the page you requested. Please try again or use the <?php echo $site_title; ?> site search.</p>
            <hr/>
            <p><?php echo $site_title; ?> is a <a href="https://whiteinternet.com">White Internet</a> website by <a href="https://iain-white.com">Iain White</a>.</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>