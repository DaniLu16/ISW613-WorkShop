<?php
  $name = @$_REQUEST['name'];
  $lastName = @$_REQUEST['lastname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Save in Database</title>
</head>
<body>
<form action="/utils/print.php" method="POST">
  <div class="form-group">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="name" id="" value="<?php echo $name; ?>"  placeholder="Your name">
    <input type="text" class="form-control" name="lastname" id="" value="<?php echo $lastName; ?>"  placeholder="Your last name">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>