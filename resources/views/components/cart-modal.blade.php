<div x-data="{ showModal: false, selectedItem: null }">
  <div
    x-show="showModal"
    x-transition
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
  >
    <div @click.away="showModal = false" class="bg-white p-6 rounded shadow-md max-w-md w-full">
      <h2 class="text-xl font-bold mb-4">Add to Cart</h2>
      <p>
        <strong>Product:</strong>
        <span x-text="selectedItem.name"></span>
      </p>
      <p>
        <strong>Price:</strong>
        <span x-text="selectedItem.price"></span>
      </p>
      <!-- Add more fields or interactions as needed -->
      <button @click="showModal = false" class="mt-4 px-4 py-2 bg-gray-300 rounded">Cancel</button>
    </div>
  </div>
</div>
