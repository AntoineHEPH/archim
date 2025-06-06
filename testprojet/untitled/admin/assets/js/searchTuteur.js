document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchTuteur');
    const items = document.querySelectorAll('.accordion-item');

    searchInput.addEventListener('input', () => {
        const search = searchInput.value.toLowerCase().trim();
        items.forEach(item => {
            const nom = item.dataset.nom;
            item.style.display = nom.includes(search) ? '' : 'none';
        });
    });
});