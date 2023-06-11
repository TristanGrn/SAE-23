// Fonction permettant de s'assurer que le captcha ai été validé avant d'envoyer le formulaire
function valideCaptcha() {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
        alert("Veuillez valider le Captcha");
        return false;
    } else {
        return true;
    }
}

// S'assure que l'utilisateur souhaite se déconnecter
function Test() {
    if (confirm("Attention vous êtes sur le point de vous déconnecter")) {
        return true;
      } else {
        return false;
      }

}
