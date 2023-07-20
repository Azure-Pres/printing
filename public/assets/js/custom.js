window.addEventListener('messageTriggered', (e) => {
    if(e.detail.success){
        showSuccess(e.detail.message)
    }else{
        showError(e.detail.message)
    }
});

window.addEventListener('openLink', (e) => {
    if(e.detail.url){
        window.open(e.detail.url, '_blank').focus();
    }
});


function showError(message,delay=3000){
    Swal.fire({
        text:message,
        icon:"error",
        buttonsStyling:!1,
        confirmButtonText:"Ok, got it!",
        customClass:{confirmButton:"btn btn-primary"}
    })
}

function showSuccess(message,delay=3000){
    Swal.fire({
      icon: 'success',
      title: message,
      showConfirmButton: false,
      timer: 3000
  })
}