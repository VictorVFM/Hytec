const showHide = document.getElementById('show-hide')

function togglePassword() {
  let passwordInput = document.getElementById("floatingPassword");
  let iconPassword = document.getElementById('iconPassword');
  if (passwordInput.type === "password") {
      passwordInput.type = "text";
      iconPassword.className = 'fa-solid fa-eye'
  } else {
      passwordInput.type = "password";
      iconPassword.className = 'fa-solid fa-eye-slash'
  }
}

showHide.addEventListener('click',()=>{
  togglePassword()
})



