<x-app-layout>
    <div class="max-w-5xl mx-auto p-8 bg-white shadow-lg rounded-2xl space-y-10 mt-6">
        <h2 class="text-4xl font-extrabold text-gray-700 mb-8 pb-4 text-center border-b border-gray-300">
            รายละเอียดข้อมูลทะเบียนผลิต
        </h2>

        @php
            // ฟังก์ชันช่วยแปลงวันที่ให้เป็น พ.ศ. dd/mm/yyyy
            function beDate($value)
            {
                if (empty($value)) {
                    return '-';
                }
                try {
                    $d = \Carbon\Carbon::parse($value);
                    $yyyyBE = $d->year + 543;
                    return $d->format('d/m/') . $yyyyBE;
                } catch (\Exception $e) {
                    return '-';
                }
            }

            // แม็ปประเภททะเบียนให้ตรงกับตัวเลือกในฟอร์มแก้ไข
            $registrationTypeMap = [
                'T' => 'T : นำเข้าสารเข้มข้น',
                'I' => 'I : นำเข้าสำเร็จรูป',
                'F' => 'F : ผลิตผสมปรุงแต่ง',
                'R' => 'R : ผลิตแบ่งบรรจุ (จากนำเข้า)',
                'R(F)' => 'R(F) : ผลิตแบ่งบรรจุ (จากผสมปรุงแต่ง)',
                'F(E)' => 'F(E) : ผลิตเพื่อส่งออก',
            ];

            // ชนิดทะเบียน ให้ตรงกับดรอปดาวน์ "ชนิดทะเบียน"
            $typeProductionMap = [
                'ชนิดที่ 1' => 'ชนิดที่ 1',
                'ชนิดที่ 2' => 'ชนิดที่ 2',
                'ชนิดที่ 3' => 'ชนิดที่ 3',
                'ชนิดที่ 4' => 'ชนิดที่ 4',
            ];

            // ประเภทของการใช้ ให้ตรงกับดรอปดาวน์ "ประเภทของการใช้"
            $usageMap = [
                'A : Acaricide (สารกำจัดไรศัตรูพืช)' => 'A : Acaricide (สารกำจัดไรศัตรูพืช)',
                'F : Fungicide (สารป้องกันกำจัดโรคพืช)' => 'F : Fungicide (สารป้องกันกำจัดโรคพืช)',
                'H : Herbicide (สารกำจัดวัชพืช)' => 'H : Herbicide (สารกำจัดวัชพืช)',
                'I : Insecticide (สารกำจัดแมลง)' => 'I : Insecticide (สารกำจัดแมลง)',
                'M : Molluscicide (สารกำจัดหอย)' => 'M : Molluscicide (สารกำจัดหอย)',
                'N : Nematicide (สารกำจัดไส้เดือนฝอย)' => 'N : Nematicide (สารกำจัดไส้เดือนฝอย)',
                'P : PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)' =>
                    'P : PlantGrowthRegulators (สารควบคุมการเจริญเติบโตของพืช)',
                'R : Rodenticide (สารกำจัดหนู)' => 'R : Rodenticide (สารกำจัดหนู)',
            ];

            // ช่วยแสดงค่าโดย fallback เป็น '-' เมื่อค่าว่าง
            function showOrDash($v)
            {
                return $v === null || $v === '' ? '-' : $v;
            }

            // เตรียมค่าที่จะแสดงให้ตรงกับฟอร์มแก้ไข
            $companyName = $product->company->full_name ?? '-';
            $importerName = $product->importerCompany->full_name ?? '-';
            $distributorName = $product->distributorCompany->full_name ?? '-';

            // ประเภททะเบียน: รองรับทั้งกรณีเก็บเป็นโค้ด (T/I/...) หรือเก็บเป็นข้อความยาว
            $regTypeRaw = $product->registration_type ?? '';
            $regTypeShown =
                $registrationTypeMap[$regTypeRaw] ??
                ($registrationTypeMap[trim(explode(' ', $regTypeRaw)[0])] ?? showOrDash($regTypeRaw));

            // ชนิดทะเบียน
            $typeProdRaw = $product->type_production_registration ?? '';
            $typeProdShown = $typeProductionMap[$typeProdRaw] ?? showOrDash($typeProdRaw);

            // ประเภทของการใช้
            $usageRaw = $product->usage_production_registration ?? '';
            $usageShown = $usageMap[$usageRaw] ?? showOrDash($usageRaw);
        @endphp

        {{-- Section: ข้อมูลการนำเข้าทั่วไป (จัดหัวข้อ/ลำดับให้ตรงกับหน้าแก้ไข) --}}
        <div>
            <h3
                class="text-2xl font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-400 px-4 py-3 rounded-t-md">
                ข้อมูลการนำเข้าทั่วไป
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-4">

                {{-- เลขที่ทะเบียน --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ทะเบียน</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->registration_number) }}
                    </p>
                </div>

                {{-- วันหมดอายุ (ทะเบียน) --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุ</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ beDate($product->expired_license_date) }}
                    </p>
                </div>

                {{-- บริษัทที่ขึ้นทะเบียน --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">บริษัทที่ขึ้นทะเบียน</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">{{ $companyName }}</p>
                </div>

                {{-- เปอร์เซ็นต์และสูตร --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เปอร์เซ็นต์และสูตร</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->composition) }}
                    </p>
                </div>

                {{-- ชื่อวัตถุอันตราย (ไทย) --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (ไทย)</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->chemical_name_th) }}
                    </p>
                </div>

                {{-- ชื่อวัตถุอันตราย (อังกฤษ) --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อวัตถุอันตราย (อังกฤษ)</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->chemical_name_en) }}
                    </p>
                </div>

                {{-- ผู้ผลิตและแหล่งผลิต --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ผู้ผลิตและแหล่งผลิต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->manufacturer) }}
                    </p>
                </div>

                {{-- ประเภททะเบียน --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ประเภททะเบียน</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">{{ $regTypeShown }}</p>
                </div>

                {{-- ชื่อผู้นำเข้า --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้นำเข้า</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">{{ $importerName }}</p>
                </div>

                {{-- ชื่อผู้จำหน่าย --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อผู้จำหน่าย</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">{{ $distributorName }}</p>
                </div>

                {{-- ชื่อการค้า --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้า</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->trade_name) }}</p>
                </div>

                {{-- ชื่อการค้าที่ --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชื่อการค้าที่</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->trade_name_at) }}</p>
                </div>

                {{-- ชนิดทะเบียน --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ชนิดทะเบียน</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">{{ $typeProdShown }}</p>
                </div>

                {{-- ประเภทของการใช้ --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ประเภทของการใช้</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">{{ $usageShown }}</p>
                </div>

                {{-- กลุ่มสาร --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">กลุ่มสาร</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->group_of_substances) }}</p>
                </div>

                {{-- พืช --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">พืช</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->plant) }}</p>
                </div>

                {{-- ศัตรูพืช --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ศัตรูพืช</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->pests) }}</p>
                </div>

                {{-- ปริมาณ --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ปริมาณ</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->production_license_quantity) }}</p>
                </div>

                {{-- เลขที่ใบอนุญาต --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">เลขที่ใบอนุญาต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->registration_number_pass) }}</p>
                </div>

                {{-- วันหมดอายุใบอนุญาต --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบอนุญาต</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ beDate($product->production_license_expiry) }}</p>
                </div>

                {{-- ใบอนุญาตเลขที่เดิม --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ใบอนุญาตเลขที่เดิม</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->production_license_number) }}</p>
                </div>

                {{-- วันหมดอายุใบอนุญาตเดิม --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบอนุญาตเดิม</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">{{ showOrDash($product->expired_at) }}</p>
                </div>

                {{-- ใบแจ้งครอบครอง วอ.2 --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">ใบแจ้งครอบครอง วอ.2</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->possession_form_wo2) }}</p>
                </div>

                {{-- วันหมดอายุใบแจ้งครอบครอง วอ.2 --}}
                <div>
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">วันหมดอายุใบแจ้งครอบครอง วอ.2</label>
                    <p class="w-full p-3 border rounded-full bg-gray-100 text-gray-700">
                        {{ showOrDash($product->possession_form_expiry) }}</p>
                </div>

                {{-- รายละเอียดขนาดบรรจุ --}}
                <div class="md:col-span-2">
                    <label class="mx-3 text-base block text-gray-700 mb-1 mt-3">รายละเอียดขนาดบรรจุ</label>
                    <textarea disabled class="text-gray-700 bg-gray-100 w-full p-3 border rounded-2xl" rows="2">{{ showOrDash($product->packaging_size_details) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-center gap-4 pt-4">
            <a href="{{ route('import.index') }}"
                class="bg-gray-500 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg shadow-md flex items-center justify-center">
                ย้อนกลับ
            </a>
        </div>
    </div>

    <script>
        document.getElementById('menu-manufacture')?.classList.add('side-menu--active');
    </script>
</x-app-layout>
