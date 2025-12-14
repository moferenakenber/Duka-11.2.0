{{-- resources/views/admin/variants/_messages.blade.php --}}

{{-- Success Message --}}
@if (session('success'))
    <div x-data="{ showToast: true }" x-show="showToast" x-transition
         class="p-4 mb-4 text-green-700 bg-green-100 rounded"
         x-init="setTimeout(() => showToast = false, 3000)">
        {{ session('success') }}
    </div>
@endif

{{-- Error Message --}}
@if (session('error'))
    <div x-data="{ showToast: true }" x-show="showToast" x-transition
         class="p-4 mb-4 text-red-700 bg-red-100 rounded"
         x-init="setTimeout(() => showToast = false, 3000)">
        {{ session('error') }}
    </div>
@endif
