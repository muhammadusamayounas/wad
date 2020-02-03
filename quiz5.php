<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
 $passwordErr  = $emailErr  = "";
$password= $email  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
if(!empty($_POST["password"])) {
    $password = test_input($_POST["password"]);
 
    if (strlen($_POST["password"]) <= '20') {
        $passwordErr = "Your Password Must Contain At Least 20 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
	else {
            $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
        }
}

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([ucp]+\.)+([edu]+\.)+[pk]{2}$/ix",$email))
	{
      $emailErr = "Invalid email format";
    }
  }
    

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Password: <input type="text" name="password">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $password;
echo "<br>";
echo $email;
echo "<br>";

?>

</body>
</html>