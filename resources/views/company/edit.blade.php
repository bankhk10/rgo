<x-app-layout>
    <div class="container mx-auto px-6 py-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-700">แก้ไขข้อมูลบริษัท</h1>

        <form action="{{ route('company.update', $company->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">ชื่อบริษัท</label>
                <input type="text" name="name" value="{{ old('name', $company->name) }}" class="w-full border border-gray-300 p-2 rounded" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">ที่อยู่</label>
                <textarea name="address" class="w-full border border-gray-300 p-2 rounded" required>{{ old('address', $company->address) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">อีเมล</label>
                <input type="email" name="email" value="{{ old('email', $company->email) }}" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">เบอร์โทร</label>
                <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">เลขประจำตัวผู้เสียภาษี</label>
                <input type="text" name="tax_id" value="{{ old('tax_id', $company->tax_id) }}" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    อัปเดต
                </button>
                <a href="{{ route('company.index') }}" class="text-gray-600 underline ml-4">ย้อนกลับ</a>
            </div>
        </form>
    </div>
</x-app-layout>
