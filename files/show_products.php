<?php include("connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {
    background-color: rgb(33,32,32);
    margin: 0;
    padding: 20px;
}
.heading {
  color: white;
  text-align: center;
  width: 100%;
  margin: 40px 0 20px;
  position: relative;
  display: inline-block;
  font-family: 'poppins', sans-serif;
}

.heading::after {
  content: "";
  position: absolute;
  width: 0%;
  height: 1px;
  background: white;
  left: 50%;
  bottom: -5px;
  transform: translateX(-50%);
  transition: 0.4s;
  box-shadow: 0 0 0px white;
}

.heading:hover::after {
  width: 30%;
  box-shadow: 0 0 8px white, 0 0 15px white;
}

.cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}
.card {
  width: 190px;
  height: 254px;
  border-radius: 8px;
  background: #f5f5f5;
  position: relative;
  padding: 1.8rem;
  border: 2px solid #c3c6ce;
  transition: 0.5s ease-out;
  overflow: visible;
  grid-row: auto;
}

.card-wrapper {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  gap: 5px;
  justify-content: center;
  align-items: center;
}

.card-description {
  margin-top: 25px;
  text-align: center;
  font-size: 15px;
  color: #666;
}

.card img {
  width: 240px;
  height: 245px;
  border-radius: 8px;
}

.card-details {
  color: black;
  height: 100%;
  gap: .5em;
  display: grid;
  place-content: center;
}

.card-button {
  transform: translate(-50%, 125%);
  width: 60%;
  border-radius: 1rem;
  border: 2px solid black;
  background-color: white;
  color: black;
  font-size: 1rem;
  padding: .5rem 1rem;
  position: absolute;
  left: 50%;
  bottom: 0;
  opacity: 0;
  transition: 0.3s ease-out;
}

.text-body {
  color: rgb(87, 87, 87);
}

.text-title {
  margin-bottom: 25px;
  font-size: 1.3em;
  font-weight: bold;
}

.price {
  font-size: 1.1em;
  font-weight: 600;
  color: #333;
  margin-top: -30px;
}

.card:hover {
  border-color: #010101;
  box-shadow: 0 4px 18px 0 rgb(167, 152, 152);
}

.card:hover .card-button {
  transform: translate(-50%, 50%);
  opacity: 1;
}

 </style>
</head>
<body>

<?php

$sql = "SELECT * FROM `products` WHERE `p_category` = 'Gift Articles'";
$data = mysqli_query($connection,$sql);

?>
<h1 class="heading">Candles</h1>
<div class="cards-container">

<?php
while($product = mysqli_fetch_assoc($data)){
?>


    <div class="card-wrapper">
      <div class="card">
        <div class="card-details">
          <img src="<?php echo $product["p_img"]; ?>" alt="">
          <p class="text-title"><?php echo $product["p_name"]; ?></p>
          <p class="price"><?php echo $product["p_price"]; ?></p>
        </div>
        <button class="card-button">Buy Now</button>
      </div>
      <p class="card-description"><?php echo $product["p_description"]; ?> </p>
    </div>
<?php  } ?>
</div>

</body>
</html>