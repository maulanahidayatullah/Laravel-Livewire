<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama;
    public $email;
    public $alamat;
    public $updatedData = false;
    public $employee_id;
    public $search_nama;

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required'
        ];

        $message = [
            'nama.required' => 'Tolong Inputkan Nama',
            'email.required' => 'Tolong Inputkan Email',
            'email.email' => 'Format Email Tidak Sesuai',
            'alamat.required' => 'Tolong Inputkan Alamat',
        ];

        $validated = $this->validate($rules, $message);
        Employee::create($validated);
        session()->flash('message', 'Data Berhasil Di Input');
        $this->clear();
    }

    public function edit($id)
    {
        $data = Employee::find($id);
        $this->nama = $data->nama;
        $this->email = $data->email;
        $this->alamat = $data->alamat;
        $this->updatedData = true;
        $this->employee_id = $id;
    }

    public function update()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required'
        ];

        $message = [
            'nama.required' => 'Tolong Inputkan Nama',
            'email.required' => 'Tolong Inputkan Email',
            'email.email' => 'Format Email Tidak Sesuai',
            'alamat.required' => 'Tolong Inputkan Alamat',
        ];

        $validated = $this->validate($rules, $message);
        $data = Employee::find($this->employee_id);
        $data->update($validated);
        session()->flash('message', 'Data Berhasil Di Edit');
        $this->clear();
    }

    public function delete()
    {
        Employee::find($this->employee_id)->delete();
        session()->flash('message', 'Data Berhasil Di Hapus');
        $this->clear();
    }

    public function delete_confirm($id)
    {
        $this->employee_id = $id;
    }

    public function clear()
    {
        $this->nama = '';
        $this->email = '';
        $this->alamat = '';

        $this->updatedData = false;
        $this->employee_id = '';
    }

    public function render()
    {
        $query = Employee::query();

        if (isset($this->search_nama) && ($this->search_nama != null)) {
            $query->where('nama', 'like', '%' . $this->search_nama . '%');
        }

        // if (isset($request->status) && ($request->status != null)) {
        //     $query->where('status', $request->status);
        // }

        // if (isset($request->name) && ($request->name != null)) {
        //     $query->whereHas('User', function ($q) use ($request) {
        //         $q->where('name', '=', $request->name);
        //     });
        // }

        $dataEmployee = $query->orderBy('nama', 'desc')->paginate(3);
        return view('livewire.employee', ['dataEmployee' => $dataEmployee]);
    }
}
