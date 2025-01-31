document.getElementById("loginBtn").addEventListener("click", () => {
  const uname = document.getElementById("uname").value;
  const psw = document.getElementById("psw").value;

  if (!uname || !psw) {
    alert("Please fill in both username and password!");
    return;
  }

  const formData = new FormData();
  formData.append("uname", uname);
  formData.append("psw", psw);

  fetch("loginn.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        alert("Login successful!");

        localStorage.setItem("loggedInUser", uname);
        if (uname === "admin") {
          window.location.href = "dashboard.php";
        } else {
          window.location.href = "home.php";
        }
       
      } else {
        alert(`Error: ${data.message}`);
      }
    })
    .catch((error) => console.error("Error:", error));
});

document.addEventListener("DOMContentLoaded", function () {
  const loggedInUser = localStorage.getItem("loggedInUser");

  const loginBtn = document.getElementById("login-btn");
  const userInfo = document.getElementById("user-info");
  const usernameDisplay = document.getElementById("username-display");
  const logoutBtn = document.getElementById("logout-btn");

  if (loggedInUser) {
    loginBtn.style.display = "none";
    userInfo.style.display = "flex";
    usernameDisplay.textContent = loggedInUser;

    logoutBtn.style.display = "inline-block";
    logoutBtn.addEventListener("click", function () {
      localStorage.removeItem("loggedInUser");
      alert("You have successfully logged out!");
      window.location.href = "home.php"; 
    });
  }
});
