<?php
$pageTitle = 'Account Managers';
$additionalCss = [
    // Include any additional CSS files if needed, specific to the dashboard
];
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/navbar.php';
?>

<!-- Dashboard Content Below -->
<div class="p-6">
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold mb-4">Master Client List</h2>
        <button id="addNewAM" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
            Add New
        </button>
    </div>
    <table class="min-w-full table-auto" id="accountManagersTable">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Client Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Phone Number</th>
                <th class="px-4 py-2">Currency</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">PIC</th>
                <th class="px-4 py-2">Drivers of Growth</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming $accountManagers is your fetched data array
            // print_r($clients);
            foreach ($clients as $c) {
                echo "<tr class='bg-white border-b'>";
                echo "<td class='px-4 py-2'>{$c['id']}</td>";
                echo "<td class='px-4 py-2'>{$c['name']}</td>";
                echo "<td class='px-4 py-2'>{$c['email']}</td>";
                echo "<td class='px-4 py-2'>{$c['phone_number']}</td>";
                echo "<td class='px-4 py-2'>{$c['currency']}</td>";
                echo "<td class='px-4 py-2'>{$c['category']}</td>";
                echo "<td class='px-4 py-2'>{$c['status']}</td>";
                echo "<td class='px-4 py-2'>{$c['account_manager']}</td>";
                echo "<td class='px-4 py-2'>{$c['dog']}</td>";
                echo "<td class='px-4 py-2'>
                <button class='bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded editBtn' data-id='{$c['id']}'>Edit</button>
                <form method='POST' action='/master-am/delete' style='display: inline-block;'>
                    <input type='hidden' name='id' value='{$c['id']}' />
                    <button type='submit' class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded'>Delete</button>
                </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Add New Account Manager Modal -->
    <div id="addAMModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <!-- Modal content -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <!-- Inside your modal where the form is defined -->
                <form id="addAMForm" method="POST" action="/master-client/add" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Client Form</h3>
                            <div class="mt-2">
                                <input type="hidden" id="clientId" name="id" value="">
                                <input type="text" id="clientName" name="name" placeholder="Client Name" class="mt-2 p-2 w-full border rounded" required>
                                <input type="email" id="clientEmail" name="email" placeholder="Email" class="mt-2 p-2 w-full border rounded">
                                <input type="text" id="clientPhoneNumber" name="phone_number" placeholder="Phone Number" class="mt-2 p-2 w-full border rounded">

                                <!-- Dropdown for Currency -->
                                <select id="clientCurrency" name="currency_id" class="mt-2 p-2 w-full border rounded" required>
                                    <option value="">Select Currency</option>
                                    <?php foreach ($currencies as $currency) : ?>
                                        <option value="<?= $currency['id'] ?>"><?= htmlspecialchars($currency['code']) ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Dropdown for Category -->
                                <select id="clientCategory" name="category_id" class="mt-2 p-2 w-full border rounded" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Dropdown for Status -->
                                <select id="clientStatus" name="status_id" class="mt-2 p-2 w-full border rounded" required>
                                    <option value="">Select Status</option>
                                    <?php foreach ($statuses as $status) : ?>
                                        <option value="<?= $status['id'] ?>"><?= htmlspecialchars($status['status']) ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Dropdown for Account Manager (PIC) -->
                                <select id="clientAM" name="account_manager_id" class="mt-2 p-2 w-full border rounded" required>
                                    <option value="">Select Account Manager</option>
                                    <?php foreach ($accountManagers as $am) : ?>
                                        <option value="<?= $am['id'] ?>"><?= htmlspecialchars($am['full_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Dropdown for Dog (Drivers of Growth) -->
                                <select id="clientDog" name="dog_id" class="mt-2 p-2 w-full border rounded" required>
                                    <option value="">Select Driver of Growth</option>
                                    <?php foreach ($dogs as $dog) : ?>
                                        <option value="<?= $dog['id'] ?>"><?= htmlspecialchars($dog['category_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Save
                        </button>
                        <button type="button" onclick="toggleModal(false)" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // JavaScript to toggle the modal
        function toggleModal(show) {
            document.getElementById('addAMModal').style.display = show ? 'block' : 'none';
        }
        document.getElementById('addNewAM').addEventListener('click', function() {
            // Reset the form for adding
            // document.getElementById('id').value = '';
            
            document.getElementById('addAMForm').action = '/master-client/add';
            toggleModal(true)
        });
    </script>

    <script>
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function() {
                console.log("Edit button clicked");
                const id = this.getAttribute('data-id');
                const fullName = this.getAttribute('data-fullname');
                const nickName = this.getAttribute('data-nickname');
                const email = this.getAttribute('data-email');
                const phoneNumber = this.getAttribute('data-phonenumber');

                // Assuming you have input fields in your modal with these IDs
                document.getElementById('amId').value = id;
                document.getElementById('fullName').value = fullName;
                document.getElementById('nickName').value = nickName;
                document.getElementById('email').value = email;
                document.getElementById('phoneNumber').value = phoneNumber;
                document.getElementById('addAMForm').action = '/master-am/edit';

                // Show your modal here
                toggleModal(true); // You need to define this function to show the modal
            });
        });
    </script>


</div>

<?php
$additionalJs = [
    '/assets/js/datatable-am.js'
];
include __DIR__ . '/../templates/footer.php';
?>