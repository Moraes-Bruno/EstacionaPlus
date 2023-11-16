const togglePassword = document.querySelector('#mostrarSenha');
const passwd = document.querySelector("#senha");

togglePassword.addEventListener("click",function(){
    const type = passwd.getAttribute("type") === "password" ? "text" : "password";
    passwd.setAttribute("type", type);

    this.classList.toggle("bi-eye");
    
})