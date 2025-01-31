<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylepage.css">
  <link rel="stylesheet" href="shared.css">
  <title>GoodHealth Clinic</title>
</head>
<body>
  <nav class="navbar">
    <div class="logo">
      <img src="images/logo2.jpg" alt="GoodHealth Logo" class="logo">
    </div>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="book_appointment.php">Appointment</a></li>
      <li><a href="page2.php">Drugs</a></li>
    </ul>
    <div id="user-info" style="display: none; align-items: center;">
      <img src="images/user.png" alt="User Icon" id="user-icon" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 8px;">
      <span id="username-display"></span>
      <button id="logout-btn" style="margin-left: 10px; display: none;">Logout</button>
    </div>
    <a href="login.html" id="login-btn" class="login-btn">Login</a>
  </nav>

  <header>
    <div id="hero-section">
      <img src="images/clinic.jpg" alt="Clinic" class="hero-image">
      <div class="hero-text">
        <h1>Welcome to GoodHealth Clinic</h1>
        <p>Your trusted healthcare provider</p>
        <a href="book_appointment.php" class="btn-primary">Book Appointment</a>
      </div>
    </div>
  </header>

  <section id="doctors">
    <h1>Meet Our Expert Doctors</h1>
    <div class="doctor-container">

        <button class="arrow-btn left-arrow" onclick="moveLeft()">&#8592;</button>

        <div class="doctor-grid">
            <?php
            include('db_config.php');
            $sql = "SELECT D_Name, Specialization, D_Image FROM Doctor";
            $result = $conn->query($sql);

            if (!$result) {
                echo "<p>Error retrieving doctors: " . $conn->error . "</p>";
                exit();
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="doctor-card">';
                    echo '<img src="images/' . htmlspecialchars($row['D_Image']) . '" alt="' . htmlspecialchars($row['D_Name']) . '">';
                    echo '<p class="doctor-name">' . htmlspecialchars($row['D_Name']) . '</p>';
                    echo '<p class="doctor-specialty">' . htmlspecialchars($row['Specialization']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No doctors found.</p>';
            }
            $conn->close();
            ?>
        </div>

        <button class="arrow-btn right-arrow" onclick="moveRight()">&#8594;</button>
    </div>
</section>

  <section id="services">
    <h2 style="color: #0047ab;">Our Services</h2>
    <ul class="services-list">
      <li><a href="health_tips.html">Health Tips</a></li>
      <li><a href="blogpost.html">Blog Posts</a></li>
      <li>Diagnostic Tests</li>
      <li>Preventive Care</li>
    </ul>
  </section>

  <div id="modal" class="modal">  
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2 id="modal-doctor-name"></h2>
      <p id="modal-doctor-specialty"></p>
    </div>
  </div>

  <footer>
    <p>&copy; 2024 GoodHealth Clinic. All Rights Reserved.</p>
    <p>Contact: 01777777770 | Email: info@goodhealthclinic.com</p>
    <p>Hours: Mon-Fri 8:00 AM - 8:00 PM</p>
  </footer>

  <script defer src="jv.js"></script>
</body>
</html>
