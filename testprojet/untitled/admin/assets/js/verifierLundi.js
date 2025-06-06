function verifierLundi(input) {
    const date = new Date(input.value);
    const jour = date.getUTCDay();
    if (jour !== 1) {
        alert("La date doit être un lundi !");
        input.value = "";
    }
}