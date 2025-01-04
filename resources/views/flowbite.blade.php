<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Countdown Timer</title>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script>
    function countdown() {
      return {
        targetDate: new Date('2025-01-15T00:00:00'), // Set your target date here
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0,

        init() {
          this.updateCountdown();
          setInterval(() => {
            this.updateCountdown();
          }, 1000);
        },

        updateCountdown() {
          const now = new Date();
          const difference = this.targetDate - now;

          if (difference <= 0) {
            this.days = 0;
            this.hours = 0;
            this.minutes = 0;
            this.seconds = 0;
          } else {
            this.days = Math.floor(difference / (1000 * 60 * 60 * 24));
            this.hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            this.minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            this.seconds = Math.floor((difference % (1000 * 60)) / 1000);
          }
        }
      }
    }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
  <!-- Countdown container -->
  <div x-data="countdown()" x-init="init()" class="grid auto-cols-max grid-flow-col gap-5 text-center">
    <div class="bg-neutral rounded-box text-neutral-content flex flex-col p-5">
      <span class="countdown font-mono text-5xl">
        <span x-text="days"></span>
      </span>
      days
    </div>
    <div class="bg-neutral rounded-box text-neutral-content flex flex-col p-5">
      <span class="countdown font-mono text-5xl">
        <span x-text="hours"></span>
      </span>
      hours
    </div>
    <div class="bg-neutral rounded-box text-neutral-content flex flex-col p-5">
      <span class="countdown font-mono text-5xl">
        <span x-text="minutes"></span>
      </span>
      min
    </div>
    <div class="bg-neutral rounded-box text-neutral-content flex flex-col p-5">
      <span class="countdown font-mono text-5xl">
        <span x-text="seconds"></span>
      </span>
      sec
    </div>
  </div>
</body>
</html>
