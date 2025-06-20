<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-700">เพิ่มบริษัทใหม่</h1>

        <form action="{{ route('company.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">ชื่อบริษัท</label>
                <input type="text" name="name" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">ที่อยู่</label>
                <textarea name="address" class="w-full border border-gray-300 p-2 rounded" required></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">อีเมล</label>
                <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">เบอร์โทร</label>
                <input type="text" name="phone" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">เลขประจำตัวผู้เสียภาษี</label>
                <input type="text" name="tax_id" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    บันทึก
                </button>
                <a href="{{ route('company.index') }}" class="text-gray-600 underline ml-4">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</x-app-layout>
