function filtrerTuteurs(type) {
    let rows = document.querySelectorAll(".tuteur-row");
    rows.forEach(row => {
        if (type === "Tous" || row.dataset.type === type) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}