<x-app-layout>
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            เพิ่มบริษัทใหม่
        </h2>

        <form action="{{ route('company.store') }}" method="POST" class="space-y-10">
            @csrf

            {{-- General Information Section --}}
            <div>
                <h3
                    class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                    ข้อมูลทั่วไป</h3>
                <div class="grid grid-cols-2 md:grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อบริษัท</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                            placeholder="ใส่ชื่อบริษัทเต็ม"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required />
                        @error('full_name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ตัวย่อบริษัท</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="ใส่ตัวย่อบริษัท"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required />
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">อีเมล</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="ใส่อีเมล"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('email')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เบอร์โทร</label>
                        <input type="number" name="phone" value="{{ old('phone') }}" placeholder="ใส่เบอร์โทรศัพท์"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('phone')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขประจำตัวผู้เสียภาษี</label>
                        <input type="text" name="tax_id" value="{{ old('tax_id') }}"
                            placeholder="ใส่เลขประจำตัวผู้เสียภาษี"
                            class="w-full p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        @error('tax_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="col-span-2"> {{-- Makes address field span full width --}}
                        <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ที่อยู่</label>
                        <textarea name="address" placeholder="ใส่ที่อยู่บริษัท"
                            class="w-full p-3 border rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 h-24 resize-y" required>{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="flex justify-center gap-4 pt-4">
                <a href="{{ route('company.index') }}"
                    class="bg-gray-500 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">
                    บันทึก
                </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('menu-company')?.classList.add('side-menu--active');
    </script>
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
                    window.location.href = "{{ route('company.index') }}";
                }
            })
        </script>
    @endif
    <style>
        /* สไตล์ที่จำเป็นสำหรับฟอร์มเพื่อให้เหมือนกับฟอร์มสร้างผู้ใช้งาน */
        * {
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-size: 16px;
        }

        /* เพิ่มสไตล์สำหรับ textarea เพื่อให้มีขอบโค้งมน */
        textarea {
            border-radius: 20px;
        }
    </style>
</x-app-layout>
