<div id="content">
<a href="<?= site_url('admin/gallery') ?>" >&laquo; Back</a><br /><br />
<?php if ( empty( $photos['id'] ) ) { ?>
<h1 class="title">Add Photo</h1> 
<?php } else { ?>
<h1 class="title">Edit Photo</h1> 
<?php } ?>

<?php if ($this->session->flashdata('flash_error')) { ?>
  <div class="error"><?= $this->session->flashdata('flash_error') ?></div>
<?php } ?>
<?php
echo validation_errors();
?>

<form method="post" action="<?= site_url("admin/gallery/form_gallery/$id") ?>" enctype="multipart/form-data" >
<table width="100%" border="0" >
  <tr>
    <td>Title</td>
    <td><input type="text" name="title" value="<?php echo set_value('title', isset($photos['title']) ? $photos['title'] : '' ); ?>" class="txt" ></td>
  </tr>

  <tr>
    <td>Photo</td>
    <td>  <?php if ( isset($photos['filename']) && $photos['filename'] ) { ?>
      <img src="<?= base_url() . $this->uploadpath  . $photos['filename'] ?>" width="200" height="200" /><br />
  <?php	} ?> 
      Browse photo: <br /><input type="file" name="userfile" ></td>
  </tr>
	
	<tr>
		<td>Album</td>
		<td><?= form_dropdown('album_id', $albums, !empty($photos['album_id']) ? $photos['album_id'] : '' ); ?></td>
	</tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Submit" name="submit"  /></td>
  </tr>
</table>

<input type="hidden" name="id" value="<?= isset($photos['id']) ? $photos['id'] : '' ?>" >
<input type="hidden" name="picture" value="<?= isset($photos['filename']) ? $photos['filename'] : '' ?>" >
</form>
</div>