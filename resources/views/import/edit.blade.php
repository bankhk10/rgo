<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แก้ไขข้อมูลทะเบียนนำเข้า</h2>
        <form method="POST"
              action="{{ route('import.update', $import->id) }}"
              class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 mb-1">บริษัท</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="company">
                    <option value="">-- เลือก --</option>
                    <option value="บริษัท A"
                            {{ $import->company == 'บริษัท A' ? 'selected' : '' }}>บริษัท A</option>
                    <option value="บริษัท B"
                            {{ $import->company == 'บริษัท B' ? 'selected' : '' }}>บริษัท B</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">เลขที่ทะเบียน</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="registration_number"
                       value="{{ $import->registration_number }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="expiry_date"
                       value="{{ $import->expiry_date }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (ไทย)</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="hazardous_name_th"
                       value="{{ $import->hazardous_name_th }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="hazardous_name_en"
                       value="{{ $import->hazardous_name_en }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">% และสูตร</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="percentage_formula"
                       value="{{ $import->percentage_formula }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="trade_name"
                       value="{{ $import->trade_name }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ผู้ผลิตและแหล่งผลิต</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="manufacturer_source">
                    <option value="">-- เลือก --</option>
                    <option value="บริษัท A"
                            {{ $import->manufacturer_source == 'บริษัท A' ? 'selected' : '' }}>บริษัท A</option>
                    <option value="บริษัท B"
                            {{ $import->manufacturer_source == 'บริษัท B' ? 'selected' : '' }}>บริษัท B</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ผู้จำหน่าย</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="supplier">
                    <option value="">-- เลือก --</option>
                    <option value="ตัวแทนจำหน่าย A"
                            {{ $import->supplier == 'ตัวแทนจำหน่าย A' ? 'selected' : '' }}>ตัวแทนจำหน่าย A</option>
                    <option value="ตัวแทนจำหน่าย B"
                            {{ $import->supplier == 'ตัวแทนจำหน่าย B' ? 'selected' : '' }}>ตัวแทนจำหน่าย B</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ใบอนุญาตเลขที่</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="license_number"
                       value="{{ $import->license_number }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ปริมาณนำเข้า</label>
                <input type="number"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="import_quantity"
                       value="{{ $import->import_quantity }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ปริมาณคงเหลือ</label>
                <input type="number"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="remaining_quantity"
                       value="{{ $import->remaining_quantity }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="shelf_life"
                       value="{{ $import->shelf_life }}" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="package_size"
                       value="{{ $import->package_size }}" />
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">หมายเหตุ</label>
                <textarea type="text-area"
                          class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          name="note">{{ $import->note }}</textarea>
            </div>
            <div class="text-right mt-8">
                <a href="{{ route('import.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300 ">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>
            </div>
            <div class="text-left mt-6">
                <button type="submit"
                        class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline shadow-md">
                    บันทึก
                </button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'บันทึกสำเร็จ!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = "{{ route('import.index') }}";
                }
            })
        </script>
    @endif
</x-app-layout>
