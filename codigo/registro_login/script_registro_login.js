const signUpButton = document.getElementById("signUpButton");
const signInButton = document.getElementById("signInButton");
const signUpForm = document.getElementById("signup");
const signInForm = document.getElementById("signIn");

// Mostrar el formulario de registro
signUpButton.addEventListener("click", () => {
    signUpForm.style.display = "block";
    signInForm.style.display = "none";
});

// Mostrar el formulario de inicio de sesión
signInButton.addEventListener("click", () => {
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
});
