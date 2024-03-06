<!-- The Modal -->
<div id="addCategoryModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto p-4">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg">
            <!-- Add Category Form -->
            <form id="addCategoryForm" method="post" action="{{ route('add_category') }}">
                @csrf
                <div class="mb-4">
                    <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name:</label>
                    <input type="text" id="categoryName" name="category_name" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white font-bold rounded hover:bg-green-700 cursor-pointer">
                        Save
                    </button>
                    <button type="button" id="closeModalBtn" class="ml-2 px-4 py-2 bg-red-500 text-white font-bold rounded hover:bg-red-700 cursor-pointer">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to show the modal
    function showModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }

    // Function to hide the modal
    function hideModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    // Add event listener to hide the modal when the close button is clicked
    document.getElementById('closeModalBtn').addEventListener('click', hideModal);
</script>
