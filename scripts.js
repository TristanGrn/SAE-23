function valideCaptcha() {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
        alert("Veuillez valider le Captcha");
        return false;
    } else {
        return true;
    }
}