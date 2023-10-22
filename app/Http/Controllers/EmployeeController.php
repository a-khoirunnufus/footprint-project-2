<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use DB;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pegawai' => 'required|min:3',
            'email' => 'required|email|unique:tbl_pegawai,email',
            'username' => 'required|min:4|unique:tbl_pegawai,username',
            'password' => 'required|min:4',
            'nohp' => 'nullable',
        ]);

        $data = $validated;
        $data['password'] = \Hash::make($data['password']);

        try {
            DB::beginTransaction();

            Employee::create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('employees.index')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil menambahkan data pegawai baru.'
        ]);
    }

    public function edit($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404);
        }

        return view('employees.edit', ['employee' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404);
        }

        $validated = $request->validate([
            'nama_pegawai' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('tbl_pegawai', 'email')->ignore($employee->email, 'email')],
            'username' => ['required', 'min:4', Rule::unique('tbl_pegawai', 'username')->ignore($employee->username, 'username')],
            'password' => 'nullable',
            'nohp' => 'nullable',
        ]);

        $data = $validated;

        if (is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = \Hash::make($data['password']);
        }

        try {
            DB::beginTransaction();

            Employee::where('id_pegawai', $id)->update($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('employees.index')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil mengedit data pegawai.'
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404);
        }

        if ($employee->is_administrator) {
            return redirect()->route('employees.index')->with('message', [
                'type' => 'danger',
                'text' => 'Tidak dapat menghapus data administrator!'
            ]);
        }

        try {
            DB::beginTransaction();

            Employee::destroy($id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        return redirect()->route('employees.index')->with('message', [
            'type' => 'success',
            'text' => 'Berhasil menghapus data pegawai.'
        ]);
    }

    public function datatable()
    {
        $query = Employee::all();

        $datatable = datatables($query);

        return $datatable->toJson();
    }
}
