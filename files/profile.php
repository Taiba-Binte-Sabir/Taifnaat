<?php include("connection.php");

session_start();

if(!isset($_SESSION['user'])){
    header("Location: login form.php");
    exit();
}
?>
<?php
$email = $_SESSION['user'];
$query = "SELECT * FROM register WHERE email='$email'";
$data = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TAIFNAAT | Profile</title>
  <link rel="icon" href="Taifnaat.png">
  <link rel="stylesheet" href="index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&display=swap"
    rel="stylesheet">
<style>
  .cont_shopp a button{
    align-items: center;
    text-align:center; 
    margin:0 auto;
    background-color:black;
    border:2px solid white;
    padding: 5px 5px;
    color:white
  }
.cont_shopp a button:hover{
  background-color: #fff;
  color: #000;
  border: 2px solid black;
}
</style>
</head>

<body>

  <nav class="navbar">

    <div class="logo">
      <img src="Taifnaat.png" width="100">
    </div>

    <div class="menu">

      <div class="menu-item"><a href="index.html">Home</a></div>
      <div class="menu-item"><a href="giftarticles.html">Gift Articles</a></div>

      <div class="menu-item dropdown">Toys <i class="bi bi-chevron-down"></i>
        <div class="submenu">
          <a href="dolls.html">Doll</a>
          <a href="cars.html">Cars</a>
          <a href="stuffed.html">Stuffed Toys</a>
        </div>
      </div>

      <div class="menu-item"><a href="offsup.html">Office Supplies</a></div>
      <div class="menu-item"><a href="ArtSupp.html">Art Supplies</a></div>


      <div class="menu-item dropdown"><a href="cosmetics.html">Cosmetics </a><i class="bi bi-chevron-down"></i>
        <div class="submenu">
          <a href="makeup.html">Makeup</a>
          <a href="skincare.html">Skin Care</a>
          <a href="bodycare.html">Body Care</a>
          <a href="haircare.html">Hair Care</a>
        </div>
      </div>

      <div class="menu-item dropdown"><a href="books.html">Books </a><i class="bi bi-chevron-down"></i>
        <div class="submenu">
          <a href="novel.html">Novels</a>
          <a href="KidsBooks.html">Kids Books</a>
          <a href="IslamicBooks.html">Islamic Books</a>
          <a href="ColouringBooks.html">Colouring Books</a>
        </div>
      </div>

      <div class="menu-item"><a href="gc.html">Greeting Cards </a></div>
      <div class="menu-item"><a href="bags.html">Bags</a></div>
      <div class="menu-item"><a href="wallets.html">Wallets</a></div>


    </div>

    <!-- RIGHT SIDE -->
    <div class="right-section">

      <div class="icons">

        <div class="icon cart">
          <i class="bi bi-cart"></i>
          <span class="badge">0</span>
        </div>
<?php if(empty($_SESSION["user"])) { ?>
    <a href="login form.php">
        <i class="bi bi-person"></i> Login
    </a>
<?php } else { ?>
    <a href="logout.php">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
<?php } ?>

        <div class="search-box">
          <i class="bi bi-search" id="search-icon"></i>
          <input type="text" placeholder="Search..." id="search-input">
        </div>

      </div>

      <div class="menu-toggle">
        <i class="bi bi-list"></i>
      </div>

    </div>

  </nav>

<div style="text-align:center; margin-top:20px;">

    <h2 style="color:white;">
        <?php echo $user['F_name'] . " " . $user['l_name']; ?>
    </h2>

    <p style="color:lightgray;">
        <?php echo $user['email']; ?>
    </p>
<div class="cont_shopp">
  <a href="index.html">
    <button>Continue Shopping</button>
  </a>
</div>

</div>

</body>
</html>