<x-app-layout>
    <style>
        .soon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* ทำให้สูงเต็ม viewport */
            margin: 0;
        }

        .soon-text {
            font-size: 3em;
            /* ขนาดตัวอักษร (ปรับได้) */
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>

    <div class="soon-container">
        <h1 class="soon-text">กำลังดำเนินการ</h1>
    </div>
</x-app-layout>
