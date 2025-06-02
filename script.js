 
    function openForm() {
      document.getElementById("popupForm").style.display = "flex";
    }

    function closeForm() {
      document.getElementById("popupForm").style.display = "none";
    }

    // Close modal when clicking outside the form
    window.onclick = function(event) {
      const modal = document.getElementById("popupForm");
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };