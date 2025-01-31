document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('addStaffForm').addEventListener('submit', function(e) {
      const name = document.getElementById('St_first_name').value;
      if (name === "") {
          alert("First Name is required!");
          e.preventDefault();
      }
  });
});
