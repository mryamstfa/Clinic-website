document.getElementById("appointmentForm").addEventListener("submit", function (event) {
    event.preventDefault();
    const patientName = document.getElementById("patient-name").value.trim();
    const doctorName = document.getElementById("doctor-name").value;
    const appointmentDate = document.getElementById("appointment-date").value;

    if (!patientName || !doctorName || !appointmentDate) {
        alert("Please fill in all the fields.");
        return;
    }
    const successMessage = document.getElementById("success-message");
    successMessage.classList.remove("hidden");

    setTimeout(() => {
        document.getElementById("appointmentForm").submit();
    }, 1000); 
});
