function generateSlug(nameId, slugId) {
    let name = document.getElementById(nameId).value;

    // Convert to lowercase, remove diacritics, replace spaces with hyphens
    let slug = name.toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove accents
        .replace(/\s+/g, '-') // Replace spaces with hyphens
        .replace(/[^a-z0-9\-]/g, ''); // Remove non-alphanumeric characters except hyphens

    document.getElementById(slugId).value = slug;
}