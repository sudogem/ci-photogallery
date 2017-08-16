<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css" >
body { background:#000000 url(../../themes/prizzy/images/patt_4a7c5cf0a909c.jpg) ;}
/* Login */
.loginbox { width:300px ; color:#fff ;  margin:0 auto ; margin-top:10% ;  }
.login {text-decoration:none; background:#444 ; 
-moz-border-radius:5px; border:1px solid #333 ; -webkit-border-radius:3px;
opacity:0.90; _filter: alpha(opacity=80); font:normal 18px Arial, Helvetica, sans-serif; 
padding:20px; 
}
.title { color:#fff ; text-align:center; margin:0; padding: 0; font:normal 20px Arial, Helvetica, sans-serif !important }

</style>
</head>

<body>
<div class="loginbox" >
<div class="login" >
<?php
echo "<p style='color:white; background:red; margin:0; padding: 0' >" . $this->session->flashdata( 'flash' ) . "</p>" ;
?>
<form method="post" action="<?= site_url(ACCOUNT_SIGNIN_PATH) ?>" >
<table width="200" border="0" >
  <tr>
    <td colspan="2"></td>
    </tr>
  <tr>
    <td>Username </td>
    <td><input name="username" type="text"  /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input name="password" type="password" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="login" value="Login&raquo;"  /></td>
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>
