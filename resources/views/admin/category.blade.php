<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Writer Dashboard</title>
</head>
<body>

<div class="mt-20 bg-gray-50/50">
    <!-- Sidebar -->
    @include('inc/sidebar')

    <!-- Main Content -->
    <div class="xl:w-full mb-4 grid grid-cols-1 gap-6 xl:grid-cols-3 ml-80">
        <!-- Category Section -->
        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md overflow-hidden xl:col-span-2">
            <div class="relative bg-clip-border rounded-xl overflow-hidden bg-transparent text-gray-700 shadow-none m-0 flex items-center justify-between p-6">
                <div></div>
                <button id="addCategoryBtn" class="relative mt-4 px-4 py-2 bg-blue-500 text-white font-bold rounded hover:bg-blue-700 cursor-pointer">
                    Add Category
                </button>
            </div>
            <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                <!-- Table -->
                <table class="w-full min-w-[640px] table-auto">
                    <thead>
                    <tr>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Categories</p>
                        </th>
                        <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                            <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">Action</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Categories loop -->
                    @foreach($categories as $category)
                        <tr>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">{{ $category->name }}</p>
                            </td>
                            <td class="py-3 px-5 border-b border-blue-gray-50">
                                <div class="flex gap-2">
                                    <form id="deleteForm{{ $category->id }}" method="post" action="{{ route('delete_category', ['id' => $category->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteCategory('{{ $category->id }}')" class="mt-2 px-2 py-1 bg-red-500 text-white font-bold rounded hover:bg-red-700 cursor-pointer">Delete</button>
                                    </form>
                                    <button type="button" onclick="updateCategory('{{ $category->id }}', '{{ $category->name }}')" class="mt-2 px-2 py-1 bg-yellow-500 text-white font-bold rounded hover:bg-yellow-700 cursor-pointer">Update</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto p-4">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg">
            <h2 id="modalTitle" class="text-lg font-bold mb-4"></h2>
            <!-- Add Category Form -->
            <form id="addCategoryForm" method="post" action="">
                @csrf
                <div class="mb-4">
                    <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name:</label>
                    <input type="text" id="categoryName" name="category_name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white font-bold rounded hover:bg-green-700 cursor-pointer">Save</button>
                    <button type="button" onclick="hideModal()" class="ml-2 px-4 py-2 bg-red-500 text-white font-bold rounded hover:bg-red-700 cursor-pointer">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentCategoryId = null; // Variable to store the current category ID for update operation

    // Function to show the modal for adding or updating
    function showModal(action, categoryId = null, categoryName = '') {
        currentCategoryId = categoryId; // Store the current category ID

        // Update modal title and input value based on action
        document.getElementById('modalTitle').innerText = action === 'add' ? 'Add Category' : 'Update Category';
        document.getElementById('categoryName').value = categoryName;

        // Update form action based on action
        const form = document.getElementById('addCategoryForm');
        form.action = action === 'add' ? '{{ route("add_category") }}' : '/update_category/' + categoryId;

        // Show the modal
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }

    // Function to hide the modal
    function hideModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    // Function to delete category
    function deleteCategory(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            document.getElementById('deleteForm' + categoryId).submit();
        }
    }

    // Function to update category
    function updateCategory(categoryId, categoryName) {
        showModal('update', categoryId, categoryName);
    }

    // Function to handle form submission for adding or updating category
    function handleSubmit(event) {
        event.preventDefault();

        // Get the form data
        let formData = new FormData(this);

        // Append the category ID if it's an update operation
        if (currentCategoryId) {
            formData.append('id', currentCategoryId);
        }

        // Perform AJAX request to add or update the category
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                if (response.ok) {
                    // Category added or updated successfully, close the modal
                    hideModal();
                } else {
                    // Handle errors if any
                    console.error('Failed to add or update category');
                }
            })
            .catch(error => {
                console.error('Error occurred while adding or updating category:', error);
            });
    }

    // Add event listener to the Add Category button
    document.getElementById('addCategoryBtn').addEventListener('click', function() {
        showModal('add');
    });

    // Add event listener to the form submission
    document.getElementById('addCategoryForm').addEventListener('submit', handleSubmit);
</script>


</body>
</html>
