<!-- File: src/views/login/loginview.php -->

<?php
$pageTitle = 'Login Page';
include __DIR__ . '/../templates/header.php'; ?>

<div class="min-h-screen flex flex-col justify-center items-center">
    <div class="mb-8">
        <h1 class="text-2xl font-bold">Finance Sales Reporting</h1>
    </div>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="/login" method="post" class="w-full max-w-xs">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>