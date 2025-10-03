<?php
// package.php - Hamara master package page

// Session start karna zaroori hai taki agar user logged in ho to booking.php usey aage process kar sake
session_start(); 

// Sabse pehle, packages ka data include karein
require 'packages_data.php';

// URL se country ka ID lein (e.g., 'france', 'uk')
$package_id = isset($_GET['id']) ? $_GET['id'] : '';

// Check karein ki woh ID hamare data mein hai ya nahi
if (!array_key_exists($package_id, $packages)) {
    die("Error: Package not found!"); // Agar galat ID hai to error dikhayein
}

// Sahi package ki details ek variable mein store karein
$package = $packages[$package_id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($package['name']); ?> Package</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="package_style.css">
</head>
<body>

  <div class="package-container">
    <a href="packages.html" class="back-btn">
      <i class="fa-solid fa-arrow-left"></i>
    </a>

    <!-- Left side: Package Details -->
    <div class="package-details">
      <img src="<?php echo htmlspecialchars($package['image']); ?>" alt="A scenic view of <?php echo htmlspecialchars($package['name']); ?>">
      <h3><?php echo htmlspecialchars($package['name']); ?></h3>
      <p><?php echo htmlspecialchars($package['description']); ?></p>
      <div class="star">
        <?php echo generate_stars($package['stars']); ?>
      </div>
      <h3>Price: <strong>$<?php echo htmlspecialchars($package['price']); ?></strong></h3>
    </div>

    <!-- Right side: Booking form -->
    <div class="booking-form">
      <h3>Book Your Trip</h3>
      <form action="php/booking.php" method="POST">
          <div class="input-group">
              <input type="hidden" name="destination" value="<?php echo htmlspecialchars($package['name']); ?>">
              <input type="text" value="Destination: <?php echo htmlspecialchars($package['name']); ?>" disabled>
          </div>
          <div class="input-group">
              <input type="number" name="how_many" placeholder="How Many People" required>
          </div>
          <div class="input-group">
              <input type="text" name="start_date" placeholder="Arrival Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
          </div>
          <div class="input-group">
              <input type="text" name="end_date" placeholder="Leaving Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
          </div>
          <div class="input-group">
              <textarea name="details" rows="5" placeholder="Enter Your Name & Details"></textarea>
          </div>
          <button type="submit" class="submit">Book Now</button>
      </form>
    </div>

  </div>

</body>
</html>

