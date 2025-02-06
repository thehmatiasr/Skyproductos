document.querySelectorAll('.cantidad').forEach(input => {
    input.addEventListener('input', () => {
        if (input.value.trim() !== "") {
            input.style.backgroundColor = "#e0f7e0"; // Verde claro
        } else {
            input.style.backgroundColor = "white";
        }
    });
});

document.getElementById('enviar').addEventListener('click', () => {
    let mensaje = "Lista de Compras:\n";
    document.querySelectorAll('.cantidad').forEach(input => {
        if (input.value.trim() !== "") {
            mensaje += `${input.previousElementSibling.innerText} ${input.value.trim()}\n`;
        }
    });

    let url = `https://api.whatsapp.com/send?phone=+5493764369900&text=${encodeURIComponent(mensaje)}`;
    window.open(url, "_blank");
});
