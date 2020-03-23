<html>
<head>
<title>Upload Form</title>
</head>
<body>
<?php if (!empty($error)): ?>
	
<?php echo $error;?>
<?php endif ?>

<form action="http://localhost/fansub_new/client/upload.asp" enctype="multipart/form-data" method="post" accept-charset="utf-8">

<input type="file" name="profile_pic" size="20" />

<br /><br />

<input type="submit" />

</form>

</body>
</html>