<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">


                <h1 class="text-6xl font-bold text-center text-indigo-600 mt-8 mb-8">
                    ยินดีต้อนรับแอดมิน
                </h1>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-indigo-600 text-white text-left">
                                <th class="py-3 px-6">ลำดับ</th>
                                <th class="py-3 px-6">ชื่อสามัญ</th>
                                <th class="py-3 px-6">เลขที่ทะเบียน</th>
                                <th class="py-3 px-6">สถานะ</th>
                                <th class="py-3 px-6 text-center">ดู</th>
                                <th class="py-3 px-6 text-center">แก้ไข</th>
                                <th class="py-3 px-6 text-center">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">1</td>
                                <td class="py-3 px-6">ยาเม็ดวิตามินรวม</td>
                                <td class="py-3 px-6">123456</td>
                                <td class="py-3 px-6">
                                    <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Active</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="#" class="text-blue-500 hover:underline">ดู</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="#" class="text-yellow-500 hover:underline">แก้ไข</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="#" class="text-red-500 hover:underline">ลบ</a>
                                </td>
                            </tr>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="py-3 px-6">2</td>
                                <td class="py-3 px-6">น้ำมันตับปลาชนิดแคปซูล</td>
                                <td class="py-3 px-6">654321</td>
                                <td class="py-3 px-6">
                                    <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">Inactive</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="#" class="text-blue-500 hover:underline">ดู</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="#" class="text-yellow-500 hover:underline">แก้ไข</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="#" class="text-red-500 hover:underline">ลบ</a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>
