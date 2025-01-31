document.addEventListener("DOMContentLoaded", function () {
  const loggedInUser = localStorage.getItem("loggedInUser");
  const loginBtn = document.getElementById("login-btn");
  const userInfo = document.getElementById("user-info");
  const usernameDisplay = document.getElementById("username-display");
  const logoutBtn = document.getElementById("logout-btn");

  if (loggedInUser) {
    if (loginBtn) loginBtn.style.display = "none"; 
    if (userInfo) userInfo.style.display = "flex"; 
    if (usernameDisplay) usernameDisplay.textContent = loggedInUser;

    if (logoutBtn) {
      logoutBtn.style.display = "inline-block"; 
      logoutBtn.addEventListener("click", function () {
        localStorage.removeItem("loggedInUser");
        alert("You have successfully logged out!");
        window.location.href = "home.php"; 
      });
    }
  }
});
document.addEventListener("DOMContentLoaded", () => {
  const doctors = document.querySelectorAll(".doctor-card");
  let currentIndex = 0;

  if (doctors.length > 0) {
      doctors[currentIndex].classList.add("active");
  }

  window.moveRight = () => {
      if (doctors.length === 0) return;

      doctors[currentIndex].classList.remove("active");
      currentIndex = (currentIndex + 1) % doctors.length;
      doctors[currentIndex].classList.add("active");
  };

  window.moveLeft = () => {
      if (doctors.length === 0) return;

      doctors[currentIndex].classList.remove("active");
      currentIndex = (currentIndex - 1 + doctors.length) % doctors.length;
      doctors[currentIndex].classList.add("active");
  };
});

