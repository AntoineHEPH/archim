
function changerNbTutores(id, delta) {
fetch('src/php/ajax/ajax_update_nb_tutores.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
        id: id,
        delta: delta
    })
})
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`nb_${id}`).innerText = data.nouveau;
        } else {
            alert("Erreur : " + (data.error || "échec de la requête"));
        }
    });
}
