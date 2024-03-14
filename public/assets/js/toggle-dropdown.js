function toggleDropdown(event, menuId) {
    event.preventDefault();
    const dropdownMenu = document.getElementById(menuId);

    if (dropdownMenu.classList.contains('hidden')) {
        dropdownMenu.classList.remove('hidden');
        dropdownMenu.classList.add('block');
    } else {
        dropdownMenu.classList.add('hidden');
        dropdownMenu.classList.remove('block');
    }
}

