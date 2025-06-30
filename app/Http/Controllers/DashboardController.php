<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChemicalRegistration;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // วันปัจจุบัน
        $today = Carbon::today();

        // 1) ทะเบียนใกล้หมดอายุในอีก 30 วัน
        $nearExpiryDrugs = ChemicalRegistration::whereDate('registration_expiry_date', '>=', $today)
            ->whereDate('registration_expiry_date', '<=', $today->copy()->addDays(30))
            ->orderBy('registration_expiry_date')
            ->get();

        // 2) ทะเบียนที่หมดอายุแล้ว
        $expiredDrugs = ChemicalRegistration::whereDate('registration_expiry_date', '<', $today)->get();

        // 3) ทะเบียนที่ยังไม่หมดอายุ
        $activeDrugs = ChemicalRegistration::whereDate('registration_expiry_date', '>', $today->copy()->addDays(30))->get();

        // Manual pagination
        $perPage = 5;
        $currentPage = request()->get('page', 1);
        $paginatedNearExpiryDrugs = new LengthAwarePaginator(
            $nearExpiryDrugs->forPage($currentPage, $perPage),
            $nearExpiryDrugs->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()],
        );

        return view('dashboard', [
            'expiredCount' => $expiredDrugs->count(),
            'nearExpiryDrugs' => $nearExpiryDrugs,
            'paginatedNearExpiryDrugs' => $paginatedNearExpiryDrugs,
            'nearExpiryCount' => $nearExpiryDrugs->count(),
            'activeCount' => $activeDrugs->count(),
        ]);
    }
}
