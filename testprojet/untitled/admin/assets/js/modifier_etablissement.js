document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("td[contenteditable=true]").forEach((cell) => {
        cell.addEventListener("blur", () => {
            const id = cell.id;
            const champ = cell.dataset.champ;
            const valeur = cell.innerText;

            fetch("src/php/ajax/ajax_update_etablissement.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `champ=${champ}&valeur=${encodeURIComponent(valeur)}&id=${id}`
            }).then(res => res.ok && console.log(`✅ Modifié : ${champ} -> ${valeur}`));
        });
    });
});
