<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileEdit extends Component
{

    public $depts, $desigs, $dept, $deptId, $deptName;

    public function mount()
    {
        $this->deptId = Auth::user()->department? : 0;
        $this->desigs = $this->getDesignation();
        $this->deptName = $this->getDepartmentName();
        // $this->depts = [];
    }

    public function updatedDeptId()
    {
        $this->deptName = $this->getDepartmentName();
        $this->desigs = $this->getDesignation();
    }

    public function getDesignation()
    {
        return \App\Designation::where('dept_id', $this->deptId)->get()->toArray();
    }

    public function getDepartmentName()
    {
        // dd($this->deptId);
        $dept = \App\Department::whereId($this->deptId);
        if ($dept->exists())
            return $dept->first()->name;
        return 'invalid department name';
    }

    public function render()
    {
        return view('livewire.profile-edit');
    }
}
