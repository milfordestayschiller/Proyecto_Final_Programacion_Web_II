document.getElementById("loginForm").addEventListener("submit", function(e) {
    const password = document.getElementById("password").value;
  
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
    if (!regex.test(password)) {
      alert("La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas y números.");
      e.preventDefault();
    }
  });
  