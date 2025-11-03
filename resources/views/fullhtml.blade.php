<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Alpine Playground</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <div class="bg-gray-100">
      <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center text-stone-900">Alpine Playground</h1>
      </div>
    </div>

    <div x-data="{ open: false }" class="text-center py-6">
      <button @click="open=!open" x-show="">Toggle Modal</button>
      <div>
        <p x-text="open">Hey there buddy</p>
      </div>
      <hr />
    </div>

    <div x-data="{ open: false }" class="text-center py-6">
      <!-- Toggle button -->
      <button @click="open = !open">Toggle Modal</button>

      <!-- Modal content -->
      <div x-show="open" x-transition>
        <p>Hey there buddy</p>
      </div>

      <hr />

      <div x-data="{ open: false }">
        <!-- Toggle button -->
        <button @click="open = !open">Toggle Modal</button>
        <p x-text="open ? 'Open' : 'Closed'"></p>
      </div>
    </div>

    <div x-data="{ open: false }" class="text-center py-6">
      <div x-data="{ label: 'Content:' }">
        <span x-show="lable"></span>
        <span x-text="open"></span>
      </div>
    </div>
  </body>
</html>
