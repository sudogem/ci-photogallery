<div id="content" >
<h1 class="title">Album</h1>
<a href="<?= site_url('admin/album/form_album') ?>" <?php echo isset($form_album_active) ? "class='$form_album_active'" : '' ?>  class="btn2">Add Album</a>
<?php
echo "<span class='success' >" . $flash . "</span>" ;
?>
<table width="100%" border="0" class="table1" >
  <tr>
    <th width="5%">Album name</th>
    <th width="5%">Description</th>
    <th width="5%">Date Created</th>
    <th width="5%">Total photos</th>
    <th width="1%">&nbsp;</th>
    <th width="1%">&nbsp;</th>
  </tr>
<?php
if ( $album )
{
for( $i=0 ; $i < count( $album ); $i++ ) {
$id = $album[$i]['id'] ;
?>
  <tr>
    <td><?php echo anchor("/admin/gallery/album/$id/1", $album[$i]['album_name']);?></td>
    <td><?php echo $album[$i]['album_desc'] ?></td>
    <td><?php echo date('m/d/Y',strtotime($album[$i]['created_at']))  ?></a></td>
		<td><?php echo $album[$i]['total_photos'] ?></td>
    <td><a href="<?= site_url("admin/album/form_album/$id") ?>"  class="btn" >Edit</a></td>
    <td><a href="<?= site_url("admin/album/form_delete/$id") ?>"  class="btn" >Delete</a></td>
  </tr>
<?php } ?>
<?php } else {  ?>
	<tr>
	<td colspan="6" >No record found.</td>
	</tr>
<?php } ?>
</table>

<div class="pager" ><?= isset($pagination) ? $pagination : '' ?></div>

</div>

