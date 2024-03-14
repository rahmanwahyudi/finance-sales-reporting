<div class="bg-gray-800 text-white flex justify-between items-center py-4 px-6">
    <!-- Logo on the left -->
    <div class="flex items-center">
        <img src="/assets/img/visiwhite.png" alt="App Logo" class="h-8 mr-2">
        <span>Sales Reporting</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1">
        <ul class="flex justify-center space-x-4">
            <li><a href="/dashboard" class="hover:text-gray-300">Home</a></li>
            <!-- Dropdown for Master Data -->
            <li class="group relative" id="masterDataDropdown">
                <a href="#" onclick="toggleDropdown(event, 'masterDataDropdownMenu')" class="cursor-pointer hover:text-gray-300">Master Data</a>
                <ul class="absolute hidden bg-gray-700 mt-2" id="masterDataDropdownMenu">
                    <li><a href="/master-am" class="block whitespace-nowrap hover:text-gray-300 px-4 py-2">Master AM</a></li>
                    <li><a href="/master-client" class="block whitespace-nowrap hover:text-gray-300 px-4 py-2">Master Client</a></li>
                    <li><a href="/master-currency" class="block whitespace-nowrap hover:text-gray-300 px-4 py-2">Master Currency</a></li>
                    <li><a href="/master-category" class="block whitespace-nowrap hover:text-gray-300 px-4 py-2">Master Category</a></li>
                    <li><a href="/master-status" class="block whitespace-nowrap hover:text-gray-300 px-4 py-2">Master Status</a></li>
                    <li><a href="/master-dog" class="block whitespace-nowrap hover:text-gray-300 px-4 py-2">Master DOG</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Logout Icon on the right -->
    <div>
        <a href="/logout" title="Logout">
            <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <path d="M10.09 15.59L11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59zM20 3h-7c-1.1 0-2 .9-2 2v4h2V5h7v14h-7v-4h-2v4c0 1.1.9 2 2 2h7c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
            </svg>
        </a>
    </div>
</div>

<script>
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
</script>
