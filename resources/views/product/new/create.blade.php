<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แบบฟอร์มขึ้นทะเบียนใหม่</h2>
        <form method="POST" action="{{ route('newregis.store') }}" class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block text-gray-700 mb-1">ชื่อสามัญ</label>
                <input type="text"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="hazardous_name_th" />
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
                <label class="block text-gray-700 mb-1">สถานะความคืบหน้า</label>
                <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="company">
                    <option value="0">-- เลือก --</option>
                    <option value="10">ขั้นตอนที่ 1</option>
                    <option value="20">ขั้นตอนที่ 2</option>
                    <option value="30">ขั้นตอนที่ 3</option>
                    <option value="40">ขั้นตอนที่ 4</option>
                    <option value="50">ขั้นตอนที่ 5</option>
                    <option value="60">ขั้นตอนที่ 6</option>
                    <option value="70">ขั้นตอนที่ 7</option>
                    <option value="90">ขั้นตอนที่ 8</option>
                    <option value="100">สำเร็จ</option>
                </select>
            </div>
            <div class="text-right mt-8">
                <a href="{{ route('newregis.index') }}"
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
                if (result.isConfirmed) {
                    window.location.href = "{{ route('newregis.index') }}";
                }
            })
        </script>
    @endif
</x-app-layout>
