<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RestrictedPdfController extends Controller
{
    // สมมุติว่าเครือข่ายภายในบริษัทใช้ IP เช่น 192.168.x.x หรือ 10.x.x.x
    protected $allowedIpPrefixes = ['172.19.0.1', '10.'];

    public function show($id)
    {
        $userIp = request()->ip();

        // ตรวจสอบว่า IP อยู่ในกลุ่มที่อนุญาต
        if (!$this->isIpAllowed($userIp)) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงไฟล์นี้');
        }

        // ค้นหาไฟล์ PDF ตาม $id
        $path = "public/chemical_documents/{$id}.pdf";

        if (!Storage::exists($path)) {
            abort(404, 'ไม่พบไฟล์');
        }

        return response()->file(storage_path("app/" . $path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"'
        ]);
    }

    private function isIpAllowed($ip)
    {
        foreach ($this->allowedIpPrefixes as $prefix) {
            if (str_starts_with($ip, $prefix)) {
                return true;
            }
        }

        return false;
    }
}
