<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Customer') }}
        </h2>
    </x-slot>
    <div class="bootstrap-wrapper">
        <div class="container">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <!-- customerFirstName -->
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="customerFirstName" required>
                </div>

                <!-- customerLastName -->
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="customerLastName" required>
                </div>

                <!-- city -->
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>

                <!-- customerEmail -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="customerEmail">
                </div>

                <!-- customerPhoneNo -->
                <div class="mb-3">
                    <label for="phoneno" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phoneno" name="customerPhoneNo" required>
                </div>

                <!-- button -->
                <button type="submit" class="btn btn-primary">Add Customer</button>
            </form>
        </div>
    </div>
</x-app-layout>
