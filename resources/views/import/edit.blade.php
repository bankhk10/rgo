<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แก้ไขข้อมูลทะเบียนนำเข้า</h2>

        <form method="POST" action="{{ route('import.update', $import->id) }}" class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')

            {{-- บริษัท (company_id) --}}
            <div>
                <label class="block text-gray-700 mb-1">บริษัท</label>
                <select name="company_id" class="w-full p-2 border rounded-lg">
                    <option value="">-- เลือก --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $import->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- เลขที่ทะเบียน --}}
            <div>
                <label class="block text-gray-700 mb-1">เลขที่ทะเบียน</label>
                <input type="text" name="registration_no" value="{{ old('registration_no', $import->registration_no) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- วันหมดอายุ --}}
            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ</label>
                <input type="date" name="expiry_date" value="{{ old('expiry_date', $import->expiry_date) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ชื่อวัตถุอันตราย (ไทย) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (ไทย)</label>
                <input type="text" name="chemical_name_th" value="{{ old('chemical_name_th', $import->chemical_name_th) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                <input type="text" name="chemical_name_en" value="{{ old('chemical_name_en', $import->chemical_name_en) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- % และสูตร --}}
            <div>
                <label class="block text-gray-700 mb-1">% และสูตร</label>
                <input type="text" name="formula" value="{{ old('formula', $import->formula) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ชื่อการค้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ชื่อการค้า</label>
                <input type="text" name="trade_name" value="{{ old('trade_name', $import->trade_name) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ผู้ผลิต --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้ผลิต</label>
                <input type="text" name="manufacturer" value="{{ old('manufacturer', $import->manufacturer) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ผู้จำหน่าย --}}
            <div>
                <label class="block text-gray-700 mb-1">ผู้จำหน่าย</label>
                <input type="text" name="supplier" value="{{ old('supplier', $import->supplier) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ใบอนุญาต --}}
            <div>
                <label class="block text-gray-700 mb-1">ใบอนุญาต</label>
                <input type="text" name="license_no" value="{{ old('license_no', $import->license_no) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ปริมาณนำเข้า --}}
            <div>
                <label class="block text-gray-700 mb-1">ปริมาณนำเข้า</label>
                <input type="number" step="0.01" name="import_quantity" value="{{ old('import_quantity', $import->import_quantity) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ปริมาณคงเหลือ --}}
            <div>
                <label class="block text-gray-700 mb-1">ปริมาณคงเหลือ</label>
                <input type="text" name="remaining_quantity" value="{{ old('remaining_quantity', $import->remaining_quantity) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- วันหมดอายุ (สำรอง) --}}
            <div>
                <label class="block text-gray-700 mb-1">วันหมดอายุ (สำรอง)</label>
                <input type="date" name="second_expiry_date" value="{{ old('second_expiry_date', $import->second_expiry_date) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- ขนาดบรรจุ --}}
            <div>
                <label class="block text-gray-700 mb-1">ขนาดบรรจุ</label>
                <input type="text" name="packaging" value="{{ old('packaging', $import->packaging) }}"
                       class="w-full p-2 border rounded-lg" />
            </div>

            {{-- หมายเหตุ --}}
            <div class="col-span-2">
                <label class="block text-gray-700 mb-1">หมายเหตุ</label>
                <textarea name="note" rows="3" class="w-full p-2 border rounded-lg">{{ old('note', $import->note) }}</textarea>
            </div>

            {{-- ปุ่มกด --}}
            <div class="col-span-2 flex justify-between mt-6">
                <a href="{{ route('import.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    <i class="fa-solid fa-arrow-left mr-2"></i> ย้อนกลับ
                </a>

                <button type="submit"
                        class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    บันทึก
                </button>
            </div>
        </form>
    </div>

    {{-- SweetAlert2 --}}
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
