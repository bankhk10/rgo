<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แบบฟอร์มข้อมูลทะเบียนนำเข้า</h2>
        <form method="POST"
              action="{{ route('import.store') }}"
              class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block text-gray-700 mb-1">บริษัท</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="company">
                    <option value="">-- เลือก --</option>
                    <option>บริษัท A</option>
                    <option>บริษัท B</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">เลขที่ทะเบียน</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="registration_number" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="expiry_date" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (ไทย)</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="hazardous_name_th" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="hazardous_name_en" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">% และสูตร</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="percentage_formula" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="trade_name" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ผู้ผลิตและแหล่งผลิต</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="manufacturer_source">
                    <option value="">-- เลือก --</option>
                    <option>บริษัท A</option>
                    <option>บริษัท B</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ผู้จำหน่าย</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="supplier">
                    <option value="">-- เลือก --</option>
                    <option>ตัวแทนจำหน่าย A</option>
                    <option>ตัวแทนจำหน่าย B</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ใบอนุญาตเลขที่</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="license_number" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ปริมาณนำเข้า</label>
                <input type="number"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="import_quantity" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ปริมาณคงเหลือ</label>
                <input type="number"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="remaining_quantity" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="shelf_life" />
            </div>

            <div>
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
                <input type="text"
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       name="package_size" />
            </div>

            <div class="md:col-span-2">
                <label class="block text-gray-700 mb-1">หมายเหตุ</label>
                <textarea type="text-area"
                          class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          name="note"></textarea>
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
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif


</x-app-layout>
