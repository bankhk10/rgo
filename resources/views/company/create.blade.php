<x-app-layout>
    {{-- <div class="container mx-auto px-6 py-6"> --}}
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">เพิ่มบริษัทใหม่</h2>

        {{-- <h1 class="text-3xl font-bold mb-6 text-gray-700 text-center">เพิ่มบริษัทใหม่</h1> --}}

        <form action="{{ route('company.store') }}" method="POST" class="space-y-4 p-6">
            @csrf

            <div class="flex space-x-4"> {{-- Added flex container and spacing --}}
                <div class="flex-1"> {{-- Makes this div take up available space --}}
                    <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อบริษัท</label>
                    <input type="text" name="full_name" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div class="flex-1"> {{-- Makes this div take up available space --}}
                    <label class="block text-sm font-medium text-gray-700 mb-2">ตัวย่อบริษัท</label>
                    {{-- Corrected the name attribute for company abbreviation --}}
                    <input type="text" name="name" class="w-full border border-gray-300 p-2 rounded"
                        required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ที่อยู่</label>
                <textarea name="address" class="w-full border border-gray-300 p-2 rounded" required></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">อีเมล</label>
                <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">เบอร์โทร</label>
                <input type="text" name="phone" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">เลขประจำตัวผู้เสียภาษี</label>
                <input type="text" name="tax_id" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="pt-4 text-center">
                <a href="{{ route('newregis.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300 mr-2">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>
                <button type="submit"
                    class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline shadow-md">
                    บันทึก
                </button>
            </div>



        </form>
    </div>
</x-app-layout>
