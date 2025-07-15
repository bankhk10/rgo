<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChemicalRegistration;
use App\Models\DrugProgressStep; // Assuming this is the model for drug progress steps
use Illuminate\Support\Facades\Log; // For logging errors
use App\Models\Company;
use Carbon\Carbon;


class ChemicalRegistrationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $query = ChemicalRegistration::query();

        // ค้นหาตามคำค้น
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('trade_name', 'like', '%' . $search . '%')
                    ->orWhere('chemical_name_th', 'like', '%' . $search . '%')
                    ->orWhere('registration_number', 'like', '%' . $search . '%');
            });
        }

        // ค้นหาตามวันที่
        if ($request->filled('expiry_date_from') && $request->filled('expiry_date_to')) {
            $query->whereBetween('date_submit_request', [
                $request->input('expiry_date_from'),
                $request->input('expiry_date_to'),
            ]);
        }

        // ฟิลเตอร์ตามสถานะ
        $statusFilter = $request->input('status_filter');
        $today = now();
        $in180Days = now()->addDays(180);

        if ($statusFilter === 'expired') {
            $query->whereDate('expired_license_number', '<', $today);
        } elseif ($statusFilter === 'soon_expired') {
            $query->whereBetween('expired_license_number', [$today, $in180Days]);
        } elseif ($statusFilter === 'new_all') {
            $query->where('new_or_old', true)
                ->where('progress', '<', 100);
        } else {
            // ขึ้นทะเบียนใหม่ (progress < 100)
            // $query->where('progress', '<', 100);
        }

        // สถิติ
        $totalNewRegistrations = ChemicalRegistration::where('new_or_old', true)->where('progress', '<', 100)->count();
        $soonExpiredCount = ChemicalRegistration::where('new_or_old', false)
            ->whereBetween('expired_license_number', [now(), now()->addDays(180)])
            ->count();

        $expiredCount = ChemicalRegistration::where('expired_license_number', '<', $today)
            ->where('new_or_old', false)
            ->count();

        $total = ChemicalRegistration::count();
        $paginatedProducts = $query->orderBy('created_at', 'desc')->paginate(5);

        foreach ($paginatedProducts as $product) {
            // สถานะใบอนุญาต
            $expiryDate = Carbon::parse($product->expired_license_number);
            $now = Carbon::now();

            if ($expiryDate->isPast()) {
                $product->status = 'หมดอายุ';
            } elseif ($expiryDate->diffInMonths($now) <= 6) {
                $product->status = 'ใกล้หมดอายุ';
            } else {
                $product->status = 'ใช้งานอยู่';
            }

            // 👇 คำนวณ progress จริงแบบ dynamic
            $product->progress = $product->calculated_progress;

            // (ถ้าอยากเก็บ current_step_number ก็ได้)
            // $product->current_step_number = DrugProgressStep::where('chemical_registrations_id', $product->id)
            //     ->selectRaw('step_number, COUNT(*) as total, SUM(CASE WHEN checked_at IS NOT NULL THEN 1 ELSE 0 END) as done')
            //     ->groupBy('step_number')
            //     ->get()
            //     ->filter(fn($step) => $step->total == $step->done)
            //     ->pluck('step_number')
            //     ->max() ?? 1;

            $product->current_step_number  = DrugProgressStep::where('chemical_registrations_id', $product->id)
                ->max('step_number');
        }

        return view('product.new.index', [
            'total' => $total,
            'totalNewRegistrations' => $totalNewRegistrations,
            'soonExpiredCount' => $soonExpiredCount,
            'expiredCount' => $expiredCount,
            'paginatedProducts' => $paginatedProducts,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all(); // ดึงรายชื่อบริษัททั้งหมด
        // return view('import.create', compact('companies'));
        return view('product.new.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'chemical_imports_id' => 'nullable|integer', // Changed from string to integer based on schema
            'registration_number' => 'nullable|string',
            'registration_number_pass' => 'nullable|string',
            'registration_expiry_date' => 'nullable|date',
            'chemical_name_th' => 'nullable|string',
            'chemical_name_en' => 'nullable|string',
            'composition' => 'nullable|string', // text field can be validated as string
            'manufacturer' => 'nullable|string',
            'registrant' => 'nullable|string',
            'registration_type' => 'nullable|string',
            'importer' => 'nullable|string',
            'distributor' => 'nullable|string',
            'trade_name' => 'nullable|string',
            'trade_name_at' => 'nullable|string',
            'production_license_number' => 'nullable|string',
            'production_license_expiry' => 'nullable|date',
            'production_license_quantity' => 'nullable|string',
            'possession_form_wo2' => 'nullable|string',
            'possession_form_expiry' => 'nullable|date',
            'application_received_date' => 'nullable|date',
            'expired_license_number' => 'nullable|string',
            'expired_at' => 'nullable|date',
            'old_license_quantity' => 'nullable|string',
            'packaging_size' => 'nullable|string',
            'formula_of_ratio' => 'nullable|string',
            'type_registration' => 'nullable|string',
            'common_name' => 'nullable|string',
            'packaging_size_details' => 'nullable|string',
            'type_of_use' => 'nullable|string',
            'date_submit_request' => 'nullable|date',
            'request_number_1' => 'nullable|string',
            'request_number_phase_1' => 'nullable|string',
            'date_request_phase_3' => 'nullable|date',
            'request_number_phase_3' => 'nullable|string',
            'name_position' => 'nullable|string',
            'remarks' => 'nullable|string', // text field can be validated as string
            'new_or_old' => 'nullable|boolean', // boolean field
            'step' => 'nullable|string',
            'chemical_type' => 'nullable|string',
            'company' => 'nullable|string',
            'store_company_1' => 'nullable|string',
            'store_company_2' => 'nullable|string',
            'status' => 'nullable|string',
            'is_active' => 'nullable|boolean', // boolean field
            'is_deleted' => 'nullable|boolean', // boolean field
            'image' => 'nullable|string',
            'document' => 'nullable|string',
            'progress' => 'nullable|numeric', // decimal field
            'sub_progress' => 'nullable|numeric', // decimal field
            'created_by' => 'nullable|string',
            'updated_by' => 'nullable|string',
        ]);

        // 2. กำหนดค่า progress เริ่มต้น 0 (หรือจะเป็น 12.5% ถ้าต้องการ)
        $validatedData['progress'] = 0;
        try {
            $chemical_registration = ChemicalRegistration::create($validatedData);
            // 4. สร้างหัวข้อย่อยเริ่มต้นให้กับขั้นตอนที่ 1 โดยไม่มีการเลือก (checked_at = null)
            // กำหนดหัวข้อย่อยขั้นตอน 1 จำนวน 3 หัวข้อ (ตาม requirement ล่าสุด)
            $rawStructure = [
                1 => [
                    'จัดซื้อต่างประเทศ' => ['ทะเบียน', 'ใบอนุญาตในประเทศผู้ผลิต', 'เอกสารอนุญาตอื่นๆ'],
                    'ฝ่ายขาย' => ['รายชื่อผู้ขอขึ้นทะเบียน', 'ชื่อการค้า', 'Packing'],
                    'วิจัยและพัฒนา' => ['เตรียมข้อมูลผลิตตัวอย่าง'],
                    'แผนกวิชาการ' => ['แผนการทดลอง'],
                    'แผนกทะเบียน' => [
                        'ตรวจสอบเอกสารขึ้นทะเบียน',
                        'ตรวจชื่อการค้า',
                        'ขอใบอนุญาตนำเข้าตัวอย่าง',
                        'อื่นๆ',
                    ],
                ],
            ];

            // สร้างหัวข้อย่อยเริ่มต้นเฉพาะขั้นตอนที่ 1
            $stepNumber = 1;
            $subStepIndex = 0;

            foreach ($rawStructure[$stepNumber] as $department => $subSteps) {
                foreach ($subSteps as $label) {
                    DrugProgressStep::create([
                        'chemical_registrations_id' => $chemical_registration->id,
                        'step_number' => $stepNumber,
                        'sub_step_index' => $subStepIndex,
                        'sub_step_label' => $label,
                        'checked_at' => null,
                    ]);
                    $subStepIndex++;
                }
            }

            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        } catch (\Exception $e) {
            // \Log::error("Error creating product: " . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Changed from $registrationNumber to $id for consistency with route model binding
    {
        $drug = ChemicalRegistration::where('id', $id)->first();
        if (!$drug) {
            abort(404, 'ไม่พบข้อมูล');
        }

        $checkplan = $drug->checkPlan($id);
        if ($checkplan) {
            $checkplan = 'มี';
        } else {
            $checkplan = 'ไม่มี';
        }

        // $step_number = DrugProgressStep::where('chemical_registrations_id', $drug->id)
        //     ->whereNotNull('checked_at')
        //     ->first();

        $step_number  = DrugProgressStep::where('chemical_registrations_id', $drug->id)
            ->max('step_number');

        return view('product.new.show', compact('drug', 'checkplan', 'step_number'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $companies = Company::all();
        $drug = ChemicalRegistration::where('id', $id)->first();
        if (!$drug) {
            abort(404, 'ไม่พบข้อมูล');
        }

        $checkplan = $drug->checkPlan($id);
        if ($checkplan) {
            $checkplan = 'มี';
        } else {
            $checkplan = 'ไม่มี';
        }
        // ตรวจสอบว่าผู้ใช้มีสิทธิ์แก้ไขหรือไม่
        // if (!auth()->user()->can('edit', $drug)) {
        //     abort(403, 'คุณไม่มีสิทธิ์แก้ไขข้อมูลนี้');
        // }

        return view('product.new.edit', compact('drug', 'companies', 'checkplan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $drug = ChemicalRegistration::findOrFail($id);

        $rules = [
            'chemical_imports_id' => 'nullable|integer',
            'registration_number' => 'nullable|string',
            'registration_number_pass' => 'nullable|string',
            'registration_expiry_date' => 'nullable|date',
            'chemical_name_th' => 'nullable|string',
            'chemical_name_en' => 'nullable|string',
            'composition' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'registrant' => 'nullable|string',
            'registration_type' => 'nullable|string',
            'importer' => 'nullable|string',
            'distributor' => 'nullable|string',
            'trade_name' => 'nullable|string',
            'trade_name_at' => 'nullable|string',
            'production_license_number' => 'nullable|string',
            'production_license_expiry' => 'nullable|date',
            'production_license_quantity' => 'nullable|string',
            'possession_form_wo2' => 'nullable|string',
            'possession_form_expiry' => 'nullable|date',
            'application_received_date' => 'nullable|date',
            'expired_license_number' => 'nullable|string',
            'expired_at' => 'nullable|date',
            'old_license_quantity' => 'nullable|string',
            'packaging_size' => 'nullable|string',
            'formula_of_ratio' => 'nullable|string',
            'type_registration' => 'nullable|string',
            'common_name' => 'nullable|string',
            'packaging_size_details' => 'nullable|string',
            'type_of_use' => 'nullable|string',
            'date_submit_request' => 'nullable|date',
            'request_number_1' => 'nullable|string',
            'request_number_phase_1' => 'nullable|string',
            'date_request_phase_3' => 'nullable|date',
            'request_number_phase_3' => 'nullable|string',
            'name_position' => 'nullable|string',
            'remarks' => 'nullable|string',
            'new_or_old' => 'nullable|boolean',
            'step' => 'nullable|string',
            'chemical_type' => 'nullable|string',
            'company' => 'nullable|string',
            'store_company_1' => 'nullable|string',
            'store_company_2' => 'nullable|string',
            'status' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_deleted' => 'nullable|boolean',
            'image' => 'nullable|string',
            'document' => 'nullable|string',
            'progress' => 'nullable|numeric',
            'sub_progress' => 'nullable|numeric',
            'created_by' => 'nullable|string',
            'updated_by' => 'nullable|string',
        ];

        $validatedData = $request->validate($rules);

        foreach ($validatedData as $key => $value) {
            $drug->$key = $value;
        }

        if (!empty($validatedData['registration_number'])) {
            $drug->new_or_old = false;
        }

        $drug->save();
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        // return redirect()->route('newregis.index')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drug = ChemicalRegistration::findOrFail($id);

        try {
            // ลบหัวข้อย่อยที่เกี่ยวข้อง (DrugProgressStep)
            DrugProgressStep::where('chemical_registrations_id', $drug->id)->delete();

            $drug->delete();

            return redirect()->route('newregis.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            \Log::error("Error deleting chemical registration: " . $e->getMessage());
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }
    }

    public function updateSubProgress(Request $request, ChemicalRegistration $drug)
    {
        $stepNumber = (int) $request->input('step_number');
        $selectedIndexes = $request->input('sub_steps', []);
        $notes = $request->input('sub_step_notes', []);

        // Raw structure (เหมือนเดิม)
        $rawStructure = [
            1 => [
                'จัดซื้อต่างประเทศ' => ['ทะเบียน', 'ใบอนุญาตในประเทศผู้ผลิต', 'เอกสารอนุญาตอื่นๆ'],
                'ฝ่ายขาย' => ['รายชื่อผู้ขอขึ้นทะเบียน', 'ชื่อการค้า', 'Packing'],
                'วิจัยและพัฒนา' => ['เตรียมข้อมูลผลิตตัวอย่าง'],
                'แผนกวิชาการ' => ['แผนการทดลอง'],
                'แผนกทะเบียน' => [
                    'ตรวจสอบเอกสารขึ้นทะเบียน',
                    'ตรวจชื่อการค้า',
                    'ขอใบอนุญาตนำเข้าตัวอย่าง',
                    'อื่นๆ',
                ],
            ],
            2 => [
                'จัดซื้อต่างประเทศ' => ['ประสานเพื่อนำเข้าตัวอย่าง'],
                'วิจัยและพัฒนา' => ['จัดเตรียมตัวอย่าง'],
                'แผนกทะเบียน' => ['ส่งตัวอย่างให้วิจัยและพัฒนา', 'ขอใบอนุญาตผลิต', 'ตรวจ COA'],
            ],
            3 => [
                'จัดซื้อต่างประเทศ' => ['ประสานเพื่อส่งออกตัวอย่าง', 'Data requirement จากผู้ผลิต'],
                'แผนกทะเบียน' => [
                    'ประสานส่งออกตัวอย่าง',
                    'ตรวจผลการศึกษา Tox',
                    'เตรียมข้อมูลประกอบการยื่นขอขึ้นทะเบียน',
                ],
            ],
            4 => [
                'จัดซื้อต่างประเทศ' => [
                    'ทะเบียน',
                    'ใบอนุญาตในประเทศผู้ผลิต (ส่ง DOA)',
                    'เอกสารอนุญาตอื่นๆ',
                ],
                'วิจัยและพัฒนา' => ['เตรียมและส่งตัวอย่างให้ทะเบียน'],
                'แผนกวิชาการ' => ['ติดตามแผนการทดลอง Eff+ PHI (ถ้ามี)'],
                'แผนกทะเบียน' => [
                    'รวบรวมข้อมูลและเอกสารยื่นขอขขึ้นทะเบียนตามที่ DOA กำหนด',
                    'ติดตามผล Phase I',
                ],
            ],
            5 => [
                'แผนกทะเบียน' => [
                    'รวบรวมข้อมูล',
                    'เอกสารยื่นขอขึ้นทะเบียนตามที่ DOA กำหนด',
                    'ติดตามผล Phase I',
                ],
                'แผนกวิชาการ' => [
                    'รับแผนการทดลอง Eff, PHI (ถ้ามี)',
                    'ทำการทดลอง Eff และผลการทดลอง PHI (ถ้ามี)',
                ],
                'วิจัยและพัฒนา' => [
                    'รับทราบผลวิเคราะห์ในกรณีที่วิเคราะห์ไม่ผ่าน',
                    'ส่งตัวอย่างให้ทะเบียนเพื่อยื่นขอขึ้นทะเบียนใหม่',
                ],
            ],
            6 => [
                'แผนกวิชาการ' => ['ติดตามผลการทดลอง Eff', 'ผลการทดลอง PHI (ถ้ามี) จนอนุมัติ'],
                'แผนกทะเบียน' => [
                    'รวบรวมข้อมูล',
                    ' ผล Eff +ผล PHI (ถ้ามี) ที่อนุมัติ',
                    ' เอกสารตามที่ DOA กำหนด และติดตามผล Phase III',
                ],
                'จัดซื้อต่างประเทศ' => [
                    'ประสานขอเอกสารจากผู้ผลิตเพิ่มเติมในกรณีที่ผลพิจารณา Tox Phase III ไม่ผ่าน',
                ],
            ],
            7 => [
                'แผนกทะเบียน' => [
                    'แผนกทะเบียนได้รับผล Tox Phase III ที่อนุมัติ ทำการรวบรวมข้อมูลเอกสารยื่นขอเข้าประชุมพิจารณาขึ้นทะเบียนใหม่',
                ],
            ],
            8 => [
                'ฝ่ายขาย' => ['สรุป packing และจัดทำ A/W'],
                'แผนกทะเบียน' => [
                    'จัดเตรียมคำขอขึ้นทะเบียน',
                    'ร่างฉลาก',
                    'มติพิจารณาขึ้นทะเบียน',
                    ' A/W',
                ],
            ],
        ];


        $userDept = auth()->user()->department;
        $departmentMap = [
            'InternationalProcurement' => 'จัดซื้อต่างประเทศ',
            'SalesDepartment' => 'ฝ่ายขาย',
            'ResearchAndDevelopment' => 'วิจัยและพัฒนา',
            'Academic' => 'แผนกวิชาการ',
            'Registration' => 'แผนกทะเบียน',
            'IT' => 'เทคโนโลยีสารสนเทศ',
        ];
        $mappedDept = $departmentMap[$userDept] ?? $userDept;

        // ✅ ตรวจว่าแผนการทดลองเป็น "ไม่มี" หรือไม่
        $planIndex = collect($rawStructure[1])->flatten()->search('แผนการทดลอง');
        $planNoteRecord = DrugProgressStep::where('chemical_registrations_id', $drug->id)
            ->where('step_number', 1)
            ->where('sub_step_index', $planIndex)
            ->first();
        $isPlanNone = $planNoteRecord && $planNoteRecord->note === 'no';

        $stepStructure = $rawStructure[$stepNumber] ?? [];
        $flatItems = [];
        $index = 0;

        foreach ($stepStructure as $department => $subSteps) {
            foreach ($subSteps as $label) {
                // ✅ ข้ามแผนกวิชาการในขั้นตอน 4–6 ถ้า "แผนการทดลอง = ไม่มี"
                if ($isPlanNone && in_array($stepNumber, [4, 5, 6]) && $department === 'แผนกวิชาการ') {
                    $index++;
                    continue;
                }

                if ($department === $mappedDept || auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager')) {
                    DrugProgressStep::updateOrCreate(
                        [
                            'chemical_registrations_id' => $drug->id,
                            'step_number' => $stepNumber,
                            'sub_step_index' => $index,
                        ],
                        [
                            'sub_step_label' => $label,
                            'department' => $department,
                            'checked_at' => in_array($index, $selectedIndexes) ? now() : null,
                            'created_by' => $notes[$index] ?? null,
                        ]
                    );
                }
                $index++;
            }
        }
        // ✅ คำนวณ progress
        $totalSteps = count($rawStructure);
        $completedSteps = 0;
        foreach ($rawStructure as $step => $groupedItems) {
            $flat = collect($groupedItems);
            // ✅ ลบแผนกวิชาการในขั้นตอน 4–6 ถ้า "แผนการทดลอง = ไม่มี"
            if ($isPlanNone && in_array($step, [4, 5, 6])) {
                $flat = $flat->reject(fn($items, $dept) => $dept === 'แผนกวิชาการ');
            }

            $flatItems = $flat->flatten()->values();
            $countChecked = DrugProgressStep::where('chemical_registrations_id', $drug->id)
                ->where('step_number', $step)
                ->whereNotNull('checked_at')
                ->count();
            if ($flatItems->count() > 0 && $countChecked === $flatItems->count()) {
                $completedSteps++;
            }
        }
        $drug->progress = round(($completedSteps / $totalSteps) * 100, 2);
        $drug->save();
        // ✅ เช็คว่าขั้นตอนปัจจุบัน (ที่ติ๊ก) ครบหรือไม่
        $flatCurrentStep = collect($stepStructure);
        if ($isPlanNone && in_array($stepNumber, [4, 5, 6])) {
            $flatCurrentStep = $flatCurrentStep->reject(fn($items, $dept) => $dept === 'แผนกวิชาการ');
        }
        $totalSubStepsInStep = $flatCurrentStep->flatten()->count();
        $checkedCountInStep = DrugProgressStep::where('chemical_registrations_id', $drug->id)
            ->where('step_number', $stepNumber)
            ->whereNotNull('checked_at')
            ->count();

        if ($totalSubStepsInStep > 0 && $checkedCountInStep === $totalSubStepsInStep) {
            // ✅ อัปเดตค่า sub_progress ที่ ChemicalRegistration
            $drug->sub_progress = $stepNumber;
            $drug->save();

            // ✅ สร้างรายการ sub step สำหรับขั้นตอนถัดไป
            $nextStep = $stepNumber + 1;
            if (isset($rawStructure[$nextStep])) {
                $nextStepStructure = $rawStructure[$nextStep];

                if ($isPlanNone && in_array($nextStep, [4, 5, 6])) {
                    $nextStepStructure = collect($nextStepStructure)
                        ->reject(fn($_, $dept) => $dept === 'แผนกวิชาการ')
                        ->all();
                }

                $nextIndex = 0;
                foreach ($nextStepStructure as $department => $subSteps) {
                    foreach ($subSteps as $label) {
                        DrugProgressStep::firstOrCreate([
                            'chemical_registrations_id' => $drug->id,
                            'step_number' => $nextStep,
                            'sub_step_index' => $nextIndex,
                        ], [
                            'sub_step_label' => $label,
                            'department' => $department,
                        ]);
                        $nextIndex++;
                    }
                }
            }
        }


        return redirect()->back()->with('success', 'อัปเดตความคืบหน้าเรียบร้อยแล้ว');
    }
}
