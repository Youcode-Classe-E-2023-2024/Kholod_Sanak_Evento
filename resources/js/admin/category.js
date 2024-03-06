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
