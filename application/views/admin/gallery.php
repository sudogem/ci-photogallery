<div id="content" >
<h1 class="title">Photos</h1>
<?php if(isset($album_data['album_name'])): ?>
<em>Album: <?php echo $album_data['album_name'];?></em>
<?php endif; ?>
<a href="<?= site_url('admin/gallery/form_gallery') ?>" <?php echo isset($form_gallery_active) ? "class='$form_gallery_active'" : '' ?>  class="btn2"  >Add Photo</a>
<?php
echo "<span class='success' >" . $flash . "</span>" ;
?>
<table width="100%" border="0" class="table1" cellpadding="0" >
  <tr>
    <th width="76%">Title</th>
    <th width="5%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
  </tr>
<?php
if ( $gallery )
{
for( $i=0 ; $i < count( $gallery ); $i++ ) {
$id = $gallery[$i]['id'] ;
$img = base_url() . UPLOAD_LOCALPATH  . $gallery[$i]['filename']
?>
  <tr>
    <td><a class="screenshot" rel="<?= $img ?>" ><?php echo $gallery[$i]['title'] ?></a></td>
    <td><a href="<?= site_url("admin/gallery/form_gallery/$id") ?>"  class="btn" >Edit</a></td>
    <td><a href="<?= site_url("admin/gallery/form_delete/$id") ?>"  class="btn" >Delete</a></td>
  </tr>
<?php } ?>
<?php } else {  ?>
	<tr>
	<td colspan="4" >No record found.</td>
	</tr>
<?php } ?>
</table>

<div class="pager" ><?= $pagination ?></div>

</div>

