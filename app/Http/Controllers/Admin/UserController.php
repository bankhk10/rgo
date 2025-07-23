<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;



class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('role_or_permission:User read|User create|User update|User delete', ['only' => ['index', 'show']]);
        // $this->middleware('role_or_permission:User create', ['only' => ['create', 'store']]);
        // $this->middleware('role_or_permission:User update', ['only' => ['edit', 'update']]);
        // $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->paginate(10);
        return view('setting.user.index', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $companies = Company::get();
        return view('setting.user.new', ['roles' => $roles, 'companies' => $companies]);
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
        try {
            // $request->validate([
            //     'name' => 'required',
            //     'email' => 'required|email|unique:users',
            //     'password' => 'required|confirmed',
            //     'department' => 'nullable|string|max:255',
            //     'position' => 'nullable|string|max:255',
            //     'employee_id' => 'nullable|string|max:255|unique:users',
            //     'phone_number' => 'nullable|string|max:20',
            //     'employment_status' => 'nullable|string|max:255',
            //     'role_id' => 'required|exists:roles,id',
            // ]);

            $user = User::create([
                'prefix' => $request->prefix,
                'name' => $request->name,
                'email' => $request->email,
                'profile' => 'aa_user.png',
                'password' => bcrypt($request->password),
                'department' => $request->department,
                'affiliation' => $request->affiliation,
                'position' => $request->position,
                'employee_id' => $request->employee_id,
                'phone_number' => $request->phone_number,
                'employment_status' => $request->employment_status,
            ]);

            $user->syncRoles([$request->role_id]); // ใช้ role เดียวจาก dropdown

            return redirect()->back()->with('success', 'บันทึกเรียบร้อยแล้ว');
        } catch (\Throwable $th) {
            Log::error('User Create Error: ' . $th);
            return redirect()->back()->withErrors(['เกิดข้อผิดพลาด'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $role = Role::get();
        $user->roles;
        $companies = Company::get();
        return view('setting.user.edit', ['user' => $user, 'roles' => $role, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            // 'prefix' => 'required',
            // 'name' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $user->id,
            // 'password' => 'nullable|confirmed',
            // 'department' => 'nullable|string|max:255',
            // 'position' => 'nullable|string|max:255',
            // 'employee_id' => 'nullable|string|max:255|unique:users,employee_id,' . $user->id,
            // 'phone_number' => 'nullable|string|max:20',
            // 'employment_status' => 'nullable|string|max:255',
            // 'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'prefix' => $request->prefix,
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'position' => $request->position,
            'employee_id' => $request->employee_id,
            'phone_number' => $request->phone_number,
            'employment_status' => $request->employment_status,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        $user->syncRoles([$request->role_id]);
        return redirect()->back()->with('success', 'บันทึกเรียบร้อยแล้ว');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
