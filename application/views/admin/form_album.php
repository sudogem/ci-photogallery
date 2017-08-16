<div id="content">
<?php if ( empty( $album['id'] ) ) { ?>
<h1 class="title">Add Album </h1> 
<?php } else { ?>
<h1 class="title">Edit Album</h1> 
<?php } ?>
<?php echo validation_errors(); ?>

<form method="post" action="<?= site_url("admin/album/form_album/$id") ?>">
<table width="100%" border="0" >
  <tr>
    <td width="12%">Album name</td>
    <td width="88%"><input type="text" name="album_name" value="<?php echo set_value('album_name', isset($album['album_name']) ? $album['album_name'] : '' ); ?>" class="txt1" ></td>
  </tr>
	
  <tr>
    <td valign="top" >Description</td>
    <td><textarea name="album_desc"  class="txt3" ><?php echo set_value('album_desc', isset($album['album_desc']) ? $album['album_desc'] : '' ); ?></textarea></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Submit" name="submit"  /></td>
  </tr>
</table>
<input type="hidden" name="id" value="<?= isset($album['id']) ? $album['id'] : '' ?>" >
</form>

</div>