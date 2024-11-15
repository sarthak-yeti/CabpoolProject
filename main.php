<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cab Sharing Navbar</title>
  <link rel="stylesheet" href="style/main.css">
</head>
<body>

  <!-- Success/Error Message Box -->
  <div id="messageBox" class="message-box">
    <span id="messageText"></span>
    <span class="close-message-btn" onclick="closeMessageBox()">&times;</span>
  </div>
  <!-- Navbar -->
  <div class="navbar">
    <!-- Logo on Left -->
    <div class="logo">
      <a href="#" style="color: white; text-decoration: none;">MyLogo</a>
    </div>

    <!-- Right Side: Create Ride Button and Dropdown Menu -->
    <div class="navbar-right">
      <!-- Create Ride Button -->
      <button id="createRideBtn" class="create-ride-btn">Create Ride</button>

      <!-- Dropdown Menu -->
      <div class="dropdown">
        <a href="#" style="color: white; text-decoration: none;">Menu</a>
        <div class="dropdown-content">
          <a href="#">Profile</a>
          <a href="#">My Bookings</a>
          <a href="#">My Rides</a>
          <a href="#">History</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Create Ride Modal -->
<div id="createRideModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h2>Create a New Ride</h2>
    <form id="rideForm">
      <label for="owner_name">Name:</label>
      <input type="text" name="owner_name" id="owner_name" required>

      <label for="enrollment_num">Enrollment Number:</label>
      <input type="text" name="enrollment_num" id="enrollment_num" required>

      <label for="leaving_from">Leaving From:</label>
      <input type="text" name="leaving_from" id="leaving_from" required>

      <label for="going_to">Going To:</label>
      <input type="text" name="going_to" id="going_to" required>

      <label for="ride_time">Date and Time:</label>
      <input type="datetime-local" name="ride_time" id="ride_time" required>

      <label for="seats_available">Seats Available:</label>
      <input type="number" name="seats_available" id="seats_available" required min="1">

      <button type="button" onclick="submitRideForm()">Submit</button>
    </form>
  </div>
</div>


  <!-- Main Content -->
  <div class="main-content">
    <!-- Search Bar -->
    <div class="search-bar">
      <input type="text" placeholder="Leaving From">
      <input type="text" placeholder="Going To">
      <input type="date" placeholder="Date">
      <select>
        <option value="">Passengers</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5+</option>
      </select>
    </div>

    <!-- Search Button -->
    <button class="search-btn">Search</button>
  </div>

 <!-- Upcoming Rides Section -->
 <div class="ride-list">
    <?php
    // PHP to fetch ride data from MySQL and display each ride
    $conn = new mysqli("localhost", "root", "", "cabpoolproject");

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT leaving_from, going_to, owner_name, ride_time, seats_available FROM rides WHERE ride_time >= NOW() ORDER BY ride_time ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='ride-card'>";
        echo "<div class='ride-info'>";
        echo "<span><strong>From:</strong> " . $row["leaving_from"] . "</span>";
        echo "<span><strong>To:</strong> " . $row["going_to"] . "</span>";
        echo "<span class='ride-owner'>Driver: " . $row["owner_name"] . "</span>";
        echo "<span><strong>Time:</strong> " . $row["ride_time"] . "</span>";
        echo "<span><strong>Seats Available:</strong> " . $row["seats_available"] . "</span>";
        echo "</div>";
        echo "<button class='join-btn'>Join Ride</button>";
        echo "</div>";
      }
    } else {
      echo "<p>No upcoming rides available.</p>";
    }

    $conn->close();
    ?>
  </div>
  <script src="javascript/main.js"></script>
</body>
</html>
