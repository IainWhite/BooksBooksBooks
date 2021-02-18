<?php 
include('siteconfig.php');
function cano($s){
	$s = $output = trim(preg_replace(array("`'`", "`[^a-z0-9]+`"),  array("", "-"), strtolower($s)), "-");
	return $s;
}
$link = $_GET['link'];
$link = explode("/", $link);

$link_id = $link[0];
$data = file_get_contents('https://itunes.apple.com/lookup?id='.$link_id.'&entity=ebook&country='.$site_country.'');
$response = json_decode($data);

if ($response->resultCount == '0') {
$data = file_get_contents('https://itunes.apple.com/lookup?id='.$link_id.'&entity=ebook');
$response = json_decode($data);
}

$item_title = $response->results[0]->trackName . ' - ' .$response->results[0]->artistName;
$artist_id = $response->results[0]->artistId;
$artist_title = $response->results[0]->artistName;
$coll_title = $response->results[0]->trackName;
//$genre_title = $response->results[0]->primaryGenreName;
$geo_link = preg_replace('/itunes/ms', "geo.itunes", $response->results[0]->trackViewUrl);
$main_image = preg_replace('/100x100bb/ms', "270x270bb", $response->results[0]->artworkUrl100);
?>
<!doctype html>
<html>
    <head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title><?php echo $item_title;?> - <?php echo $bookpage_title;?> - <?php echo $site_title;?></title>
		<meta name="description" content="<?php echo $item_title;?> <?php echo $bookpage_title?> - <?php echo $site_title;?>" />
		<meta name="keywords" content="<?php echo $item_title;?>, <?php echo $site_keywords;?>" />
		<meta property="og:site_name" content="<?php echo $site_title; ?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:title" content="<?php echo $item_title;?> - <?php echo $bookpage_title;?> - <?php echo $site_title;?>"/>
		<meta property="og:description" content="<?php echo $item_title;?> - <?php echo $bookpage_title;?> - <?php echo $site_title;?>"/>
		<meta property="og:image" content="<?php echo $main_image;?>">
		<!-- CSS and Scripts -->
		<?php include 'includes/headscripts.php'; ?>
		<?php include 'ads/head_code.php'; ?>
	  
    </head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">
<div class="col-md-8" style="margin-top: 30px;padding-left:0px;">
<div class="postmain">

<div class="headpageimage">
<img data-src="<?php echo $main_image?>" src="<?php echo $site_url?>/images/loading.svg" width="180px" height="270px" alt="<?php echo $item_title?>">
</div>
<div class="headpageinfo">
<h1 class="product-title"><?php echo $coll_title;?></h1>
<h2 class="product-stock"><?php echo $byartist_mpage?> <?php echo $artist_title;?></h2>
<ul style="list-style:none;padding: 0px;">
<li><b><?php echo $release_mpage;?>:</b> <?php echo substr($response->results[0]->releaseDate,0,10);?></li>
<li><b><?php echo $genre_mpage;?>:</b> <?php echo $response->results[0]->genres[0];?></li>
</ul>
</div>
<?php if(isset($response->results[0]->averageUserRating) and !empty($response->results[0]->averageUserRating)): ?>
        <div class="product-rating">
		<div class="score"><span>Score: <?php echo $response->results[0]->averageUserRating;?></span></div>
		<div class="bigstarbox">
        <span class="bigstars"><?php echo $response->results[0]->averageUserRating;?></span>
		</div>
		<div class="scorecount"><span>From <?php echo number_format($response->results[0]->userRatingCount);?> Ratings</span></div>
		</div>
<?php endif; ?>



<div class="postactions">
<?php if(isset($itunes_id) and !empty($itunes_id)): ?>
<a href="<?php echo $geo_link; ?>&at=<?php echo $itunes_id;?>" target="_blank" style="margin-right: 10px;" class="btn btn-raised btn-warning"><?php echo $response->results[0]->formattedPrice;?> <?php echo $itunelink_mpage;?></a>
<?php endif; ?>
<?php if(isset($amazon_id) and !empty($amazon_id)): ?>
	<?php if ($amazon_country == 'us'): ?>
	<a href="https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'uk'): ?>
	<a href="https://www.amazon.co.uk/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'de'): ?>
	<a href="https://www.amazon.de/s/ref=nb_sb_noss?__mk_de_DE=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'fr'): ?>
	<a href="https://www.amazon.fr/s/ref=nb_sb_noss?__mk_fr_FR=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'it'): ?>
	<a href="https://www.amazon.it/s/ref=nb_sb_noss/262-1833740-9023719?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'ca'): ?>
	<a href="https://www.amazon.ca/s/ref=nb_sb_noss_1/145-6101170-9412728?url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'jp'): ?>
	<a href="https://www.amazon.co.jp/s/ref=nb_sb_noss/355-0107648-9306278?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'es'): ?>
	<a href="https://www.amazon.es/s/ref=nb_sb_noss?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'in'): ?>
	<a href="https://www.amazon.in/s/ref=nb_sb_noss/261-8220576-3831631?url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'br'): ?>
	<a href="https://www.amazon.com.br/s/ref=nb_sb_noss/145-4997234-7875245?__mk_pt_BR=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'mx'): ?>
	<a href="https://www.amazon.com.mx/s/ref=nb_sb_noss/133-2517573-6129826?__mk_es_MX=%C3%85M%C3%85%C5%BD%C3%95%C3%91&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
	<?php if ($amazon_country == 'cn'): ?>
	<a href="https://www.amazon.cn/s/ref=nb_sb_noss?__mk_zh_CN=%E4%BA%9A%E9%A9%AC%E9%80%8A%E7%BD%91%E7%AB%99&url=search-alias%3Daps&field-keywords=<?php echo urlencode($item_title);?>&tag=<?php echo $amazon_id;?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
	<?php endif; ?>
    <?php if ($amazon_country == 'au'): ?>
    <a href="https://www.amazon.com.au/gp/search?ie=UTF8&tag=<?php echo $amazon_id;?>&linkCode=ur2&linkId=ba322af38943c613ce9b1fbd0fbceefa&camp=247&creative=1211&index=books&keywords=<?php echo urlencode($item_title);?>" rel="nofollow" target="_blank" class="btn btn-raised btn-danger"><?php echo $amazonlink_mpage;?></a>
    <?php endif; ?>
<?php endif; ?>
<div style="margin-top: 10px;display: inline-block;float: right;">
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_compact"></a>
</div>
</div>
</div>

<div class="postmaintitle" style="margin-bottom: 15px;">
<h3><?php echo $descriphead_mpage;?></h3>
</div>
<div class="postmaindescr">
<p>
<?php echo $response->results[0]->description;?>
</p>
</div>
</div>
<!-- end .postmain -->

<?php 
$postad = file_get_contents("ads/singlepage_ad_728x90.php",NULL);
if(isset($postad) and !empty($postad)): ?>
<div style="margin:0px 0px 20px 0px;">
<?php echo $postad; ?>
</div>
<?php endif; ?>

<?php 
$jsonurl = "https://itunes.apple.com/$site_country/rss/customerreviews/page=1/id=$link_id/sortBy=mostRecent/json";
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json);

$counter = 0;
$max = 21;
if (!empty($json_output->feed->entry)) {
echo '<div class="postmain">
<div class="postmaintitle">
<h3>'.$reviewshead_mpage.'</h3>
</div>

<div id="reviews">
<ul style="list-style:none;padding: 0px;">';
foreach ( $json_output->feed->entry as $entry )
{
if ($counter++ == 0) continue;
	if ($counter < $max) {
	echo "<li>";
	echo "<h4 class=\"tit\">{$entry->title->label}</h4>\n";
	echo '<div class="starbox"><span class="stars">'.$entry->{'im:rating'}->label.'</span></div>';
	echo "<div class=\"auth\">{$reviewsby_mpage} {$entry->author->name->label}</div>\n";
	echo "<div class=\"cont\">{$entry->content->label}</div>\n";
	echo "</li>\n";
	}
    $counter++;	
}
echo '</ul>
</div>
</div>
<!-- end .postmain -->';
}
else {}
?>


<?php if(isset($disqus_shortname) and !empty($disqus_shortname)): ?>
<div class="postmain">
<div class="postmaintitle">
<h3><?php echo $commentbox_mpage;?></h3>
</div>
<div class="videocomments">
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = '<?php echo $disqus_shortname;?>';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</div>
</div>
<?php endif; ?>

<!-- end .postmain -->
</div>
<!-- .post-sidebar -->
<div class="col-md-4" style="padding-right:0px;">
<div class="post-sidebar">
<div class="post-sidebar-box">
<?php 
$sidead = file_get_contents("ads/sidebar_ad_336x280.php",NULL);
if(isset($sidead) and !empty($sidead)): ?>
<div style="margin:0px 0px 20px 0px;">
<?php echo $sidead; ?>
</div>
<?php endif; ?>
<h3><?php echo $morebyartist_mpage;?> <?php echo $artist_title;?></h3>
<ul class="side-itemlist">
<?php
$data_al = file_get_contents('https://itunes.apple.com/lookup?id='.$artist_id.'&entity=ebook');
$response_al = json_decode($data_al);

if (isset($response_al->results) and $response_al->results == true){
foreach ($response_al->results as $result_al)
{
	if ($result_al->kind == 'ebook') {

	$related_image = $result_al->artworkUrl100;
	echo '<li class="side-item"><div class="side-thumb"><a href="'.$site_url.'/book/'.$result_al->trackId.'/'.cano($result_al->trackName).'"><img data-src="'.$related_image.'" src="'.$site_url.'/images/loading.svg" ></a></div>
	<div class="info"><h3><a href="'.$site_url.'/book/'.$result_al->trackId.'/'.cano($result_al->trackName).'">'.$result_al->trackName.'</a></h3>
		<h4>'.$result_al->artistName.'</h4>';
		if (isset($result_al->averageUserRating) and $result_al->averageUserRating == true){
		echo '<div class="starbox"><span class="stars">'.$result_al->averageUserRating.'</span></div>';
		}
	echo '</div>
	</li>';
	}
}
}
?>
</ul>

</div>

</div>
</div>
<!-- end .post-sidebar -->
</div>
<script language="JavaScript" type="text/javascript" src="<?php echo $site_url;?>/js/bigstar-rating.js"></script>
<script type="text/javascript" language="JavaScript">
jQuery(function() {
           jQuery('span.bigstars').bigstars();
      });
</script>
<script language="JavaScript" type="text/javascript" src="<?php echo $site_url;?>/js/star-rating.js"></script>
<script type="text/javascript" language="JavaScript">
      jQuery(function() {
           jQuery('span.stars').stars();
      });
</script>
<script src="<?php echo $site_url;?>/js/imglazyload.js"></script>
<script>
			//lazy loading
			$('.container img').imgLazyLoad({
				// jquery selector or JS object
				container: window,
				// jQuery animations: fadeIn, show, slideDown
				effect: 'fadeIn',
				// animation speed
				speed: 600,
				// animation delay
				delay: 400,
				// callback function
				callback: function(){}
			});
</script>
<?php include "includes/footer.php"; ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo $addthis_id;?>"></script>
</body>
</html>