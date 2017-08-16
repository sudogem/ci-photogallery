<div id="content" >

<h1 class="title" style="float:left;">List of Users</h1>
<?php echo form_open('admin/user/searchresults'); ?>
<div style="float:right">
	<?php echo form_input('q', '', 'class=txt'); ?>
	<?php echo form_submit('search', 'Search'); ?>
</div>
<?php form_close(); ?>

<br class="clear" />
<a href="<?= site_url('admin/user/form_user') ?>" <?php echo isset($form_user_active) ? "class='$form_user_active'" : '' ?>  class="btn2" >Add User</a>

<br class="clear" />

<?php
echo "<span class='success' >" . $flash . "</span>" ;
?>
<table width="100%" border="0" class="table1" >
  <tr>
    <th width="66%">Name</th>
    <th width="12%">Created</th>
    <th width="5%">&nbsp;</th>
    <th width="5%">&nbsp;</th>
  </tr>
<?php
if ( $users )
{
	for( $i=0 ; $i < count( $users ); $i++ ) {
$id = $users[$i]['id'] ;
?>
  <tr>
    <td><?php echo $users[$i]['first_name'] . " " . $users[$i]['last_name'];?></td>
    <td><?php echo date('m/d/Y',strtotime($users[$i]['created_at']))  ?></a></td>
    <td><a href="<?= site_url("admin/user/form_user/$id") ?>"  class="btn" >Edit</a></td>
    <td><a href="<?= site_url("admin/user/form_delete/$id") ?>"  class="btn" >Delete</a></td>
  </tr>
<?php } ?>
<?php } else {  ?>
	<tr>
	<td colspan="5" >Data is empty.</td>
	</tr>
<?php } ?>
</table>

<div class="pager" ><?= $pagination ?></div>

</div>

