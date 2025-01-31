document.getElementById("signupBtn").addEventListener("click", () => {
  const email = document.getElementById("email").value;
  const uname = document.getElementById("uname").value;
  const psw = document.getElementById("psw").value;
  const pswRepeat = document.getElementById("psw-repeat").value;
  const dob = document.getElementById("dob").value;
  const gender = document.getElementById("gender").value;
  const contactNumber = document.getElementById("contactNumber").value;
  const address = document.getElementById("address").value;
  const medicalHistory = document.getElementById("medicalHistory").value;

  if (psw !== pswRepeat) {
      alert("Passwords do not match!");
      return;
  }

  const formData = new FormData();
  formData.append("email", email);
  formData.append("uname", uname);
  formData.append("psw", psw);
  formData.append("dob", dob);
  formData.append("gender", gender);
  formData.append("contactNumber", contactNumber);
  formData.append("address", address);
  formData.append("medicalHistory", medicalHistory);

  fetch("signup.php", {
      method: "POST",
      body: formData,
  })
      .then((response) => response.json())
      .then((data) => {
          if (data.status === "success") {
              alert("Signup successful!");
              window.location.href = "login.html";
          } else {
              alert(`Error: ${data.message}`);
          }
      })
      .catch((error) => console.error("Error:", error));
});
