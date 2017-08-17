<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Photo Gallery</title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/slidemenu/css/style.css" />

<!-- First, add jQuery (and jQuery UI if using custom easing or animation -->
<script type="text/javascript" src="<?= base_url()?>/assets/galleryview/js/jquery1.7.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>/assets/galleryview/js/jquery1.8-ui.min.js"></script>

<!-- Second, add the Timer and Easing plugins -->
<script type="text/javascript" src="<?= base_url()?>/assets/galleryview/js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="<?= base_url()?>/assets/galleryview/js/jquery.easing.1.3.js"></script>

<!-- Third, add the GalleryView Javascript and CSS files -->
<script type="text/javascript" src="<?= base_url()?>/assets/galleryview/js/jquery.galleryview-3.0-dev.js"></script>
<link type="text/css" rel="stylesheet" href="<?= base_url()?>/assets/galleryview/css/jquery.galleryview-3.0-dev.css" />

<script type="text/javascript" src="<?php echo base_url();?>/assets/slidemenu/js/slidemenu.js"></script>

<!-- Lastly, call the galleryView() function on your unordered list(s) -->
<script type="text/javascript">
	$(function(){
		$('#myGallery').galleryView({autoplay:true, show_captions: true });
	});
</script>
</head>

<body>

  <ul id="sliding-navigation">
    <li class="sliding-element" style="margin-left: 0px;"><h3>List of all Albums</h3></li>
    <?php if($album): ?>
      <?php foreach($album['data'] as $k => $v): ?>
      <li class="sliding-element" style="margin-left: 0px;"><a href="<?php echo site_url("home/view_album/".$v['id'])?>" style="padding-left: 15px;"><?php echo $v['album_name'];?></a></li>
      <?php endforeach; ?>
  <?php endif; ?>
  </ul>

	<div id="container">
		<h1>Photo Gallery</h1>
		<ul id="myGallery" style="float:right" >
			<?php foreach($photo as $k => $v): ?>
			<li><img src="<?php echo $v['filename']; ?>" alt="<?php echo $v['title'] ?>" />
			<?php endforeach; ?>
		</ul>

    <ul id="footer">
      <li><a href="<?php echo site_url("/");?>">&laquo; Back to homepage</a></li>
      <li><a href="<?php echo site_url("account/signin");?>">Login to Admin</a></li>
    </ul>
	</div>
</body>
</html>
