<?php include("connection.php");
  session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Stationery Login</title>
  <link rel="icon" href="Taifnaat.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&display=swap"
    rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Teachers", sans-serif;
    }

    body {
      background-color: rgb(33, 32, 32);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #000;
    }

    .login-container {
      background: #f9f9f9;
      padding: 40px;
      border-radius: 12px;
      width: 320px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 25px;
      letter-spacing: 1px;
    }

    .input-group {
      margin-bottom: 18px;
    }

    .input-group label {
      font-size: 14px;
      margin-bottom: 6px;
      display: block;
      color: #333;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      transition: 0.3s;
    }

    .input-group input:focus {
      border-color: #000;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background: #000;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .login-btn:hover {
      background: #333;
    }

    .extra-links {
      text-align: center;
      margin-top: 15px;
      font-size: 13px;
    }

    .extra-links a {
      color: #555;
      text-decoration: none;
      margin: 0 5px;
    }

    .extra-links a:hover {
      color: #000;
    }
  </style>
</head>
<body>
<?php
$errorflag = $email_error = $pass_error = $login_error = $success_msg = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $pass  = $_POST['pass'];

    if(empty($email)){
        $errorflag = "yes";
        $email_error = "Please enter your email";
    }

    if(empty($pass)){
        $errorflag = "yes";
        $pass_error = "Please enter the password";
    }

    if(empty($errorflag)){
        $query = "SELECT * FROM register WHERE email='$email'";
        $data = mysqli_query($connection , $query);

        if(mysqli_num_rows($data) == 1){
            $row = mysqli_fetch_assoc($data);

            if(password_verify($pass, $row['password'])){
                
              
                $_SESSION['user'] = $row['email'];

                $success_msg = "Login Successful";
                header("location:profile.php");
                }
            else{
                $login_error = "Wrong Password";
            }
        }
        else{
            $login_error = "Email not found";
        }
    }
}
?>

  <div class="login-container" >
    <h2> Login</h2>

    <form method="POST">
      <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
        <?php if(!empty($email_error)){echo "<p style='color:red; text-align:center;'> $email_error </p>";} ?>
      </div>

      <div class="input-group">
        <label>Password</label>
        <input type="password" name = "pass" placeholder="Enter your password" required>
        <?php if(!empty($pass_error)){echo "<p style='color:red; text-align:center;'>$pass_error</p>";} ?>
      </div>

      <button class="login-btn" name= "login">Login</button>
      <?php if(!empty($login_error)){echo "<p style='color:red; text-align:center;'>$login_error</p>";} ?>

      <div class="extra-links">
        <a href="#">Forgot Password?</a> | 
        <a href="signup.php">Sign Up</a>
      </div>
    </form>
    <?php
    if(!empty($success_msg))
      {
        echo "<p style='color:black; text-align:center; margin-top:25px;'>$success_msg</p>";
      }
    ?>
  </div>


</body>
</html>