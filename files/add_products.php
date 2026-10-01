<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
        body
        {
            height: 100vh;
            width: 100vw;
            margin: 0;padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form
        {
            width: 40%;
            height: auto;
            padding: 30px 0px;
            border: 2px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
            border-radius: 15px;
        }
        div
        {

            width: 100%;
        }

        div label
        {
            margin-left: 10%;
        }
        .inp
        {
            border: none;
            border-bottom: 2px solid black;
        }
        .bbn
        {
            padding: 10px 14px;
            background-color: transparent;
            border: 2px solid black;
            border-radius: 10px;
        }

    </style>
</head>
<body>
    <?php
    if(isset($_POST["sub"]))
        {
            $p_category = $_POST["p_category"];
            $p_name = $_POST["p_name"];
            $p_desc = $_POST["p_desc"];
            $p_price = $_POST["p_price"];
            $p_img = $_FILES["p_img"];
            $p_img_name = $_FILES["p_img"]["name"];
            $p_img_tmp_name = $_FILES["p_img"]["tmp_name"];

            move_uploaded_file($p_img_tmp_name,"products_up_img/".$p_img_name);
            $img_path = "products_up_img/$p_img_name";

            $sql = "INSERT INTO `products`(`p_category`,`p_name`,`p_description`,`p_price` , `p_img`)VALUES ('$p_category','$p_name','$p_desc','$p_price', '$img_path')";
            mysqli_query($connection,$sql);

        }
    
    ?>
   <form action="" method="post" enctype="multipart/form-data">
     
        <h1>ADD PRODUCT</h1>
        <div>       
        <label for="">Category:</label>
            <select name="p_category" id="">
            <option>CHOOSE A CATEGORY</option>
            <option value="Gift Articles">Gift Articles</option>
            <option value="dolls">dolls</option>
            <option value="cars">cars</option>
            <option value="stuffed toys">stuffed toys</option>
            <option value="off supplies">off supplies</option>
            <option value="art supplies">art supplies</option>
            <option value="makeup">makeup</option>
            <option value="skincare">skincare</option>
            <option value="bodycare">bodycare</option>
            <option value="haircare">haircare</option>
            <option value="novels">novels</option>
            <option value="kids book">kids book</option>
            <option value="islamic book">islamic book</option>
            <option value="colouring book">colouring book</option>
            <option value="greeting card">greeting card</option>
            <option value="bags">bags</option>
            <option value="wallets">wallets</option>
        </select>
        </div>
        <div>
        <label for="">Product Name:</label>
        <input type="text" name="p_name" class="inp">
        </div>
        <div>
        <label for="">Product Description:</label>
        <input type="text" name="p_desc" class="inp">
        </div> 
        <div>
        <label for="">Product Price</label>
        <input type="text" name="p_price" class="inp">
        </div>
        <div>
        <label for="">Product Images</label>
        <input type="file" name="p_img" class="inp" accept="image/*">
        </div>
        <input type="submit" value="Submit" name="sub" class="bbn">
    </form>


</body>
</html>