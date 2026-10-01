<?php     include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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

        .form-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 12px;
            width: 400px;
            height: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            padding: 10px;
            border-radius: 20px;
            position: relative;
            color: black;
        }

        .title {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            padding-left: 30px;
            color: black;
        }

        .title::before {
            width: 18px;
            height: 18px;
        }

        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }

        .title::before,
        .title::after {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            border-radius: 50%;
            left: 0px;
            background-color: black;
        }

        .message,
        .signin {
            font-size: 14.5px;
            color: black;
        }

        .signin {
            text-align: center;
        }

        .signin a:hover {
            text-decoration: underline black;
        }

        .signin a {
            color: black;
        }

        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }

        .form label {
            position: relative;
        }

        .form label .input {
            background-color: #333;
            color: #fff;
            width: 100%;
            padding: 20px 05px 05px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }

        .form label .input+span {
            color: rgba(255, 255, 255, 0.5);
            position: absolute;
            left: 10px;
            top: 0px;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }

        .form label .input:placeholder-shown+span {
            top: 12.5px;
            font-size: 0.9em;
        }

        .form label .input:focus+span,
        .form label .input:valid+span {
            color: black;
            top: 0px;
            font-size: 0.7em;
            font-weight: 600;
        }

        .input {
            font-size: medium;
        }

        .submit {
            border: none;
            outline: none;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            transform: .3s ease;
            background-color: black;
        }

        .submit:hover {
            background-color: #42555d;
            border-color: black;
            box-shadow: 0 4px 10px 0 #42555d;
        }

        @keyframes pulse {
            from {
                transform: scale(0.9);
                opacity: 1;
            }

            to {
                transform: scale(1.8);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <?php

    $error_flag = $f_name_error = $l_name_error = $email_error = $pass_error = $c_pass_error = $pass_len_error = $success_msg = "" ;

    if(isset($_POST["submit"]))
        {
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $c_pass = $_POST['c_pass'];

            if(empty($f_name))
                {
                    $error_flag = "yes";
                    $f_name_error = "Please Enter The First Name";
                }
            if(empty($l_name))
                {
                    $error_flag = "yes";
                    $l_name_error = "Please Enter The Last Name";
                }
            if(empty($email))
                {
                    $error_flag = "yes";
                    $email_error = "Please Enter The EMAIL";
                }
            if(empty($pass))
                {
                    $error_flag = "yes";
                    $pass_error = "Please Enter The Password";

                }
                else
                    {
                        if(strlen($pass)<2)
                            {
                                $error_flag = "yes";
                                $pass_len_error = "Your password must be more than 2 digits";
                            }
                        else
                            {
                                $hashed = password_hash($pass, PASSWORD_DEFAULT);
                            }
                    }
            if(empty($c_pass))
                {
                    $error_flag = "yes";
                    $c_pass_error = "Please Enter The Confirm Password";
                }
            if(empty($error_flag))
                {
                    $query = "INSERT INTO register (f_name, l_name, email, password) 
                    VALUES ('$f_name', '$l_name', '$email', '$hashed')";
                    $result = mysqli_query($connection, $query);
                    if($result)
                        {
                            $success_msg = "Data inserted successfully";
                        } 
                        else
                            {
                            echo "Error: " . mysqli_error($connection);
                            }
                }
        }
    
    ?>
    <div class="form-container">

        <form class="form" action = "" method="POST">
            <p class="title">Register </p>
            <p class="message">Signup now and get full access to our website. </p>
            <div class="flex">
            <label>
                <input class="input" type="text" placeholder="" name="f_name" required="">
                <span>Firstname</span>
                    <?php if(!empty($f_name_error)) {echo "<p style='color:red ; font-size:0.5em'>" , $f_name_error ,"</p>"; } ?>

            </label>

            <label>
                <input class="input" type="text" placeholder="" name="l_name" required="">
                <span>Lastname</span>
                    <?php if(!empty($l_name_error)) {echo "<p style='color:red ; font-size:0.5em'>" . $l_name_error ."</p>"; } ?>
                </label>
            </div>

            <label>
                <input class="input" type="email" placeholder="" name="email" required="" >
                <span>Email</span>
                    <?php if(!empty($email_error)) {echo "<p style='color:red ; font-size:0.5em'>" . $email_error ."</p>"; } ?>
            </label>

            <label>
                <input class="input" type="password" placeholder="" name="pass" required="">
                <span>Password</span>
                    <?php if(!empty($pass_error)) {echo "<p style='color:red ; font-size:0.5em'>" . $pass_error ."</p>"; } ?>
                    <?php if(!empty($pass_len_error)) {echo "<p style='color:red ; font-size:0.5em'>" . $pass_len_error ."</p>"; } ?>
            </label>
            <label>
                <input class="input" type="password" placeholder="" name="c_pass" required="">
                <span>Confirm password</span>
                    <?php if(!empty($c_pass_error)) {echo "<p style='color:red ; font-size:0.5em'>" . $c_pass_error ."</p>"; } ?>
            </label>
            <button class="submit" name="submit" value="sub">Submit</button>
            <p class="signin">Already have an acount ? <a href="login form.php">Signin</a> </p>
        </form>
                    <?php if(!empty($success_msg)) {echo "<p style='color:black; text-align:center; margin-top:10px; font-size:14px;'>" . $success_msg . "</p>"; } ?>
    </div>
</body>

</html>