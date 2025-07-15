<div
    x-data="{ show: false, form: null }"
    x-show="show"
    @open-confirm-delete.window="show = true; form = $event.detail.form"
    x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
>
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-xl">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Confirm Deletion</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Are you sure you want to delete this user? This action cannot be undone.</p>

        <div class="flex justify-end gap-2">
            <button @click="show = false" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 rounded hover:bg-gray-300 dark:hover:bg-gray-600">Cancel</button>
            <button
                @click="show = false; form.submit();"
                class="px-4 py-2 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(form) {
        window.dispatchEvent(new CustomEvent('open-confirm-delete', {
            detail: { form }
        }));
    }
</script>
