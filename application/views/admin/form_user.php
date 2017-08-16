<div id="content">
<?php if ( empty( $user['id'] ) ) { ?>
<h1 class="title">Add User </h1> 
<?php } else { ?>
<h1 class="title">Edit User</h1> 
<?php } ?>
<?php echo validation_errors(); ?>
 
<form method="post" action="<?= site_url("admin/user/form_user/$id") ?>" enctype="multipart/form-data" >
<table width="100%" border="0" >
  <tr>
    <td width="12%">Username</td>
    <td width="88%"><input type="text" name="username" class="txt1" value="<?php echo set_value('username', isset($user['username']) ? $user['username'] : '' ); ?>" ></td>
  </tr>
  <tr>
    <td width="12%">Password</td>
    <td width="88%"><input type="password" name="password" class="txt1" value="<?php echo set_value('password', isset($user['password']) ? $user['password'] : '' ); ?>" ></td>
  </tr>  

  <tr>
    <td width="12%">User level</td>
    <td width="88%">
      <label for="admin"><?= form_radio('user_level', 'Administrator', isset($user['user_level']) && $user['user_level'] == 'Administrator' ? true : false, ' id=admin');?>Admin</label>
      <label for="member"><?= form_radio('user_level', 'Member', isset($user['user_level']) && $user['user_level'] == 'Member' ? true : false, ' id=member');?>Member</label>
    </td>
  </tr>  

  <tr>
    <td valign="top" >Firstname</td>
    <td><input type="text" name="firstname"  class="txt1" value="<?php echo set_value('first_name', isset($user['first_name']) ? $user['first_name'] : '' ); ?>" /></td>
  </tr>
  <tr>
    <td valign="top" >Lastname</td>
    <td><input type="text" name="lastname"  class="txt1" value="<?php echo set_value('last_name', isset($user['last_name']) ? $user['last_name'] : '' ); ?>"></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Submit" name="submit"  /></td>
  </tr>
</table>

<input type="hidden" name="id" value="<?= isset($user['id']) ? $user['id'] : '' ?>" >
</form>

</div>