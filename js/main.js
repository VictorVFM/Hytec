function success() {
    Swal.fire({
        icon: 'success',
        title: 'Cadastrado realizado com sucesso!',
        text: 'Seus dados foram enviados com sucesso.',
        confirmButtonColor: "#FFC107",
        focusConfirm: false,
        customClass: {
            confirmButton: 'text-dark fw-bold'
        },
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        timer: 3000,
        timerProgressBar: true,

    })



}
function limparUrl() {
    let url = window.location.href;
    let novaURL = url.split('?')[0];
    window.location.replace(novaURL)
}




