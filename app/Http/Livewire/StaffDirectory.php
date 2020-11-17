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

    public $limit, $query, $fname;//, //, $staffs;

    public function mount()
    {
        $this->limit = 4;
    }

    public function updatedQuery()
    {
        $config = new Config;
        $this->searchResults = $config->searchUserNoFullTextWithPagination($this->query, $this->limit);
        $this->resetPage();
        $this->render();
    }

    public function getStaffs()
    {
        return \App\User::subsidiary()->designation()->paginate($this->limit);
    }

    public function openModal($i)
    {
        $this->fname = $i;
    }

    public function render()
    {
        if($this->query == '')
        {
            return view('livewire.staff-directory', [
                'staffs' => $this->getStaffs(),
            ]);
        } else {
            return view('livewire.staff-directory', [
                'staffs' => $this->searchResults,
            ]);
        }
    }
}
