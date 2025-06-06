document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[contenteditable=true]").forEach((cell) => {
        cell.addEventListener("blur", () => {
            const id = cell.id;
            const champ = cell.dataset.champ;
            const valeur = cell.innerText;
            const table = cell.dataset.table;

            if (!id || !champ || !table) {
                console.warn("⛔ Donnée manquante (id, champ ou table)");
                return;
            }

            fetch(`src/php/ajax/ajax_update_${table}.php`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `champ=${champ}&valeur=${encodeURIComponent(valeur)}&id=${id}`
            }).then(res => {
                if (res.ok) {
                    console.log(`✅ ${table} modifié : ${champ} -> ${valeur}`);
                } else {
                    console.warn(`❌ Échec modification ${table}`);
                }
            });
        });
    });
});
