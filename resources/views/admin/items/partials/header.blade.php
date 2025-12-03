<div class="flex items-center justify-between">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Item Details') }}
    </h2>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.items.edit', $item->id) }}"
           class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Edit
        </a>
        <form action="{{ route('admin.items.destroy', $item->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Delete
            </button>
        </form>
    </div>
</div>
