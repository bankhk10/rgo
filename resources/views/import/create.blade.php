<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แบบฟอร์มข้อมูลทะเบียนนำเข้า</h2>

        <form method="POST" action="{{ route('import.store') }}" class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf

            {{-- บริษัท (company_id) --}}
            <div>
                <label class="block text-gray-700 mb-1">บริษัท</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="company_id">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- เลขที่ทะเบียน --}}
            <div>
                <label class="block text-gray-700 mb-1">เลขที่ทะเบียน</label>
                <input type="text" name="registration_no"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- วันหมดอายุ --}}
            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date" name="expiry_date"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อวัตถุอันตราย (ไทย) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (ไทย)</label>
                <input type="text" name="chemical_name_th"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                <input type="text" name="chemical_name_en"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- % และสูตร --}}
            <div>
                <label class="block text-gray-700 mb-1">% และสูตร</label>
                <input type="text" name="formula"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ชื่อการค้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text" name="trade_name"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ผู้ผลิต --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้ผลิต</label>
                <input type="text" name="manufacturer"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ผู้จำหน่าย --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้จำหน่าย</label>
                <input type="text" name="supplier"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ใบอนุญาต --}}
            <div>
                <label class="block text-gray-700 mb-1">ใบอนุญาตเลขที่</label>
                <input type="text" name="license_no"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ปริมาณนำเข้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ปริมาณนำเข้า</label>
                <input type="number" name="import_quantity"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- ปริมาณคงเหลือ --}}
            <div>
                <label class="block text-gray-700 mb-1">ปริมาณคงเหลือ</label>
                <input type="text" name="remaining_quantity"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            {{-- <div>
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
                <input type="text" name="packaging"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div> --}}

            {{-- ขนาดบรรจุ --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
                <textarea name="packaging" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="2"></textarea>
            </div>

            {{-- หมายเหตุ --}}
            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">หมายเหตุ</label>
                <textarea name="note" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="2"></textarea>
            </div>

            {{-- ปุ่ม --}}
            <div class="text-right mt-8">
                <a href="{{ route('import.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>
            </div>
            <div class="text-left mt-6">
                <button type="submit"
                    class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                    บันทึก
                </button>
            </div>
        </form>
    </div>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'บันทึกสำเร็จ!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('import.index') }}";
                }
            });
        </script>
    @endif
</x-app-layout>
