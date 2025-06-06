document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchTutore');
    const cards = document.querySelectorAll('#gridTutores > div[data-nom]');

    searchInput.addEventListener('input', () => {
        const search = searchInput.value.toLowerCase();
        cards.forEach(card => {
            const nom = (card.dataset.nom || "").toLowerCase();
            card.classList.toggle('d-none', !nom.includes(search));
        });
    });
});
