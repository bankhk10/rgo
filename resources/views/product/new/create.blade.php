<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-6 mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">แบบฟอร์มขึ้นทะเบียนใหม่</h2>
        <form method="POST" action="{{ route('newregis.store') }}" class="grid grid-cols-2 md:grid-cols-2 gap-4">
            @csrf
            <div class="col-span-2 relative">
                <label class="block text-gray-700 mb-1">ค้นหาสินค้า (ชื่อสามัญ)</label>
                <input type="text" id="productSearch"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="พิมพ์ชื่อสินค้า..." oninput="autocompleteSearch(this.value)" autocomplete="off" />
                <ul id="autocomplete-list"
                    class="absolute z-10 bg-white border w-full rounded-lg shadow max-h-60 overflow-y-auto hidden"></ul>
            </div>

            {{-- <div>
                <label class="block text-gray-700 mb-1">ชื่อสามัญ</label>
                <input type="text"
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    name="hazardous_name_th" />
            </div> --}}

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



    <script>
        let typingTimer;
        const delay = 300; // ms
        const listElement = document.getElementById("autocomplete-list");

        function autocompleteSearch(keyword) {
            console.log("Searching for:", keyword);
            clearTimeout(typingTimer);

            if (!keyword.trim()) {
                listElement.innerHTML = "";
                listElement.classList.add("hidden");
                return;
            }

            typingTimer = setTimeout(() => {
                // fetch(`/api/products/search-list?name=${encodeURIComponent(keyword)}`)
                fetch('/api/products/search-list?name=' + encodeURIComponent(keyword))

                    .then(res => res.json())
                    .then(data => {
                        listElement.innerHTML = "";
                        listElement.classList.remove("hidden");

                        if (data.length > 0) {
                            data.forEach(item => {
                                const li = document.createElement("li");
                                li.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer";
                                li.textContent = item.chemical_name_th;
                                li.addEventListener("click", () => {
                                    fillProductData(item);
                                    listElement.classList.add("hidden");
                                });
                                listElement.appendChild(li);
                            });
                        } else {
                            const li = document.createElement("li");
                            li.className = "px-4 py-2 text-gray-500 text-center";
                            li.textContent = "ไม่พบข้อมูล";
                            listElement.appendChild(li);
                        }
                    })
                    .catch(err => {
                        console.error("Autocomplete error", err);
                        listElement.innerHTML = "";
                        listElement.classList.add("hidden");
                    });
            }, delay);
        }

        function fillProductData(product) {
            document.getElementById("productSearch").value = product.chemical_name_th || "";
            document.getElementById("hazardous_name_th").value = product.chemical_name_th || "";
            document.getElementById("registration_number").value = product.registration_no || "";
            document.getElementById("expiry_date").value = product.expiry_date || "";
        }

        // Close list when clicking outside
        window.addEventListener("click", function(e) {
            if (!document.getElementById("productSearch").contains(e.target)) {
                listElement.classList.add("hidden");
            }
        });
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
                    window.location.href = "{{ route('newregis.index') }}";
                }
            })
        </script>
    @endif

</x-app-layout>
