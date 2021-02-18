<script src="<?php echo $site_url;?>/material/js/bootstrap.min.js"></script>
<script src="<?php echo $site_url;?>/material/js/ripples.min.js"></script>
<script src="<?php echo $site_url;?>/material/js/material.min.js"></script>
<script>
$.material.init();
</script>
<script src="<?php echo $site_url;?>/material/js/jquery.dropdown.js"></script>
<script>
  $(".navbar-form select").dropdown();
</script>
<footer>
<div class="footcontent">
<div class="pull-left">
&copy; <?php echo date("Y"); ?> <a href="https://whiteinternet.com">White Internet</a> by <a href="https://iain-white.com">Iain White</a>.
</div>
<div class="pull-right">
<a href="<?php echo $site_url;?>"><?php echo $footnav_home; ?></a>
    <span class="footsep"></span><a href="<?php echo $site_url;?>/privacy"><?php echo $footnav_privacy; ?></a>
    <span class="footsep"></span><a href="<?php echo $site_url;?>/dmca"><?php echo $footnav_dmca; ?></a>
    <span class="footsep"></span><a href="<?php echo $site_url;?>/contact"><?php echo $footnav_contact; ?></a>
    <span class="footsep"></span><a href="<?php echo $site_url;?>/whiteinternet">White Internet</a>
</div>
</div>
</footer>
