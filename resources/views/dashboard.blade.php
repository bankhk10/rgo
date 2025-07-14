<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-6 py-6">
            {{-- <h1 class="text-4xl font-extrabold text-center text-indigo-700 mt-5 mb-10 tracking-wide">
                <span class="inline-flex items-center gap-2">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 1.343-3 3v1c0 1.657 1.343 3 3 3s3-1.343 3-3v-1c0-1.657-1.343-3-3-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 2v2m0 16v2m8-10h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414m12.728 0l1.414 1.414M4.222 4.222l1.414 1.414" />
                    </svg>
                    แดชบอร์ด
                </span>
            </h1> --}}

            <div class="bg-white rounded-2xl shadow-md max-w-full mx-auto py-10 px-4">
                <h1 class="text-4xl font-extrabold text-center text-indigo-700 mt-5 mb-20 tracking-wide">
                    <span class="inline-flex items-center gap-2">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.657 0-3 1.343-3 3v1c0 1.657 1.343 3 3 3s3-1.343 3-3v-1c0-1.657-1.343-3-3-3z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2v2m0 16v2m8-10h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414m12.728 0l1.414 1.414M4.222 4.222l1.414 1.414" />
                        </svg>
                        แดชบอร์ด
                    </span>
                </h1>
                <div class="flex flex-wrap justify-center gap-8 mt-10 mb-10">
                    {{-- กราฟ 1 --}}
                    <div class="w-full sm:w-[300px] max-w-xs">
                        <h2 class="text-center text-lg font-bold text-blue-700 mb-4">ทะเบียนนำเข้าวัตถุดิบ</h2>
                        <hr>
                        <div class="aspect-w-1 aspect-h-1">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>

                    {{-- กราฟ 2 --}}
                    <div class="w-full sm:w-[300px] max-w-xs">
                        <h2 class="text-center text-lg font-bold text-blue-700 mb-4">ทะเบียนสินค้า</h2>
                        <hr>
                        <div class="aspect-w-1 aspect-h-1">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>

                    {{-- กราฟ 3 --}}
                    <div class="w-full sm:w-[300px] max-w-xs">
                        <h2 class="text-center text-lg font-bold text-blue-700 mb-4">ทะเบียนผลิต</h2>
                        <hr>
                        <div class="aspect-w-1 aspect-h-1">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>

                    {{-- กราฟ 4 --}}
                    <div class="w-full sm:w-[300px] max-w-xs">
                        <h2 class="text-center text-lg font-bold text-blue-700 mb-4">ขึ้นทะเบียนสินค้าใหม่</h2>
                        <hr>
                        <div class="aspect-w-1 aspect-h-1">
                            <canvas id="myChart4"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- <div class="container mx-auto px-6 py-6">
            <h2 class="text-center text-lg font-bold text-red-700 mb-5 tracking-wide">
                กราฟแท่ง
            </h2>
            <canvas id="myChart5" class="max-w-6xl mx-auto"></canvas>
        </div> --}}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataMyChart = {
            labels: [
                'ทั้งหมด',
                'ใกล้หมดอายุ',
                'หมดอายุ'
            ],
            datasets: [{
                label: 'จำนวน',
                data: [{{ $totalImport }}, {{ $soonImport }}, {{ $expiredImport }}],
                backgroundColor: [
                    'rgba(112, 217, 11, 1)', // สีเขียว (ทั้งหมด)
                    'rgba(252, 193, 4, 1)', // สีเหลือง (ใกล้หมดอายุ)
                    'rgba(252, 43, 4, 1)' // สีแดง (หมดอายุ)
                ],
                hoverOffset: 4
            }]
        };

        const configMyChart = {
            type: 'doughnut',
            data: dataMyChart,
        };

        // *** ข้อมูลและ Config สำหรับ myChart2 (ทะเบียนสินค้า) ***
        const dataMyChart2 = {
            labels: [
                'ทั้งหมด',
                'ใกล้หมดอายุ',
                'หมดอายุ'
            ],
            datasets: [{
                label: 'จำนวน',
                data: [{{ $totalRegistrations }}, {{ $soonRegistrations }}, {{ $expiredRegistrations }}],
                backgroundColor: [
                    'rgba(112, 217, 11, 1)', // สีเขียว (ทั้งหมด)
                    'rgba(252, 193, 4, 1)', // สีเหลือง (ใกล้หมดอายุ)
                    'rgba(252, 43, 4, 1)' // สีแดง (หมดอายุ)
                ],
                hoverOffset: 4
            }]
        };

        const configMyChart2 = {
            type: 'doughnut',
            data: dataMyChart2,
            // ไม่มี plugins แล้ว
        };

        // *** ข้อมูลและ Config สำหรับ myChart3 (ทะเบียนผลิต) ***
        const dataMyChart3 = {
            labels: [
                'ทั้งหมด',
                'ใกล้หมดอายุ',
                'หมดอายุ'
            ],
            datasets: [{
                label: 'จำนวน',
                data: [{{ $totalProduct }}, {{ $soonProduct }}, {{ $expiredProduct }}],
                backgroundColor: [
                    'rgba(112, 217, 11, 1)', // สีเขียว (ทั้งหมด)
                    'rgba(252, 193, 4, 1)', // สีเหลือง (ใกล้หมดอายุ)
                    'rgba(252, 43, 4, 1)' // สีแดง (หมดอายุ)
                ],
                hoverOffset: 4
            }]
        };

        const configMyChart3 = {
            type: 'doughnut',
            data: dataMyChart3,
            // ไม่มี plugins แล้ว
        };

        // *** ข้อมูลและ Config สำหรับ myChart3 (ทะเบียนผลิต) ***
        const dataMyChart4 = {
            labels: [
                'ทั้งหมด',
                'อยู่ระหว่างดำเนินการ',
                // 'สำเร็จ'
            ],
            datasets: [{
                label: 'จำนวน',
                data: [{{ $totalNewRegistrations }}, {{ $betweenNewRegistrations }}],
                backgroundColor: [
                    'rgba(112, 217, 11, 1)', // สีเขียว (ทั้งหมด)
                    'rgba(252, 193, 4, 1)', // สีเหลือง (ใกล้หมดอายุ)
                    // 'rgba(252, 43, 4, 1)' // สีแดง (หมดอายุ)
                ],
                hoverOffset: 4
            }]
        };

        const configMyChart4 = {
            type: 'doughnut',
            data: dataMyChart4,
            // ไม่มี plugins แล้ว
        };

        // *** สร้างกราฟโดนัททั้งสาม ***
        const ctx = document.getElementById('myChart');
        new Chart(ctx, configMyChart);

        const ctx2 = document.getElementById('myChart2');
        new Chart(ctx2, configMyChart2);

        const ctx3 = document.getElementById('myChart3');
        new Chart(ctx3, configMyChart3);

        const ctx4 = document.getElementById('myChart4');
        new Chart(ctx4, configMyChart4);


        // *** ข้อมูลและ Config สำหรับ myChart4 (กราฟแท่ง) ***
        const labelsBarChart = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม'];

        const dataBarChart = {
            labels: labelsBarChart,
            datasets: [{
                    label: 'ยอดขายปัจจุบัน',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                },
                {
                    label: 'ยอดขายเป้าหมาย',
                    data: [70, 65, 75, 85, 60, 60, 45],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }
            ]
        };

        const configBarChart = {
            type: 'bar',
            data: dataBarChart,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        const ctx5 = document.getElementById('myChart5');
        new Chart(ctx5, configBarChart);
    </script>
</x-app-layout>
