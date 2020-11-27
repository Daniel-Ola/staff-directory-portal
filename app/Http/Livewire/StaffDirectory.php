<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\ConfigController as Config;
use Livewire\WithPagination;

class StaffDirectory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $searchResults;

    public $limit, $query;

    public function mount()
    {
        $this->limit = 20;
    }

    public function updatedQuery()
    {
        $this->resetPage();
        $this->render();
    }

    public function getStaffs()
    {
        return \App\User::leftjoin('subsidiaries as sub', 'subsidiary', 'sub.id')
        ->leftjoin('designations as des', 'designation', 'des.id')
        ->select('users.*', 'sub.name as subname', 'des.name as desname')
        ->paginate($this->limit); //subsidiary()->designation()->paginate($this->limit);
    }
    
    public function render()
    {
        $config = new Config;
        return view('livewire.staff-directory', [
            'staffs' => $config->searchUserNoFullTextWithPagination($this->query, $this->limit),
        ]);
    }
}
