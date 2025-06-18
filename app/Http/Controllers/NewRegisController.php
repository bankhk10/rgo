<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Product; // Assuming you have a Product model

class NewRegisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // Start with a base query for 'new_or_old' products
        $query = Product::where('new_or_old', true);

        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('registration_number', 'like', '%' . $search . '%');
            });
        }

        // Count for summary cards - these should NOT be affected by the search query
        $totalNewRegistrations = Product::where('new_or_old', true)->count();
        $pendingCount = Product::where('progress', '<', 100)
            ->where('new_or_old', true)
            ->count();
        $approvedCount = Product::where('progress', 100)
            ->where('new_or_old', true)
            ->count();

        // Paginate the results using the $query that now includes search conditions
        // Remove the additional ->where('status', 'pending') or ->where('progress', '<', 100)
        // unless you specifically want to filter the main table by that status by default.
        // Based on your original template, the table should show all new registrations,
        // and the status is indicated by the progress bar.
        $paginatedProducts = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('product.new.index', [
            'totalNewRegistrations' => $totalNewRegistrations,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
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
        return view('product.new.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newRegis = new Product();
        $newRegis->name = $request->hazardous_name_th;
        $newRegis->registration_number = $request->registration_number;
        $newRegis->registration_date = $request->expiry_date; // This seems incorrect, should be a dedicated date field
        $newRegis->expiry_date = $request->expiry_date;
        $newRegis->progress = $request->company; // This seems incorrect, should be a progress value
        $newRegis->new_or_old = true; // Make sure new registrations are marked as 'true'
        $newRegis->save();

        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Changed from $registrationNumber to $id for consistency with route model binding
    {
        $drug = Product::where('id', $id)->first();
        if (!$drug) {
            abort(404, 'ไม่พบข้อมูลยา');
        }

        return view('product.new.show', compact('drug'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
