<?php

namespace App\Http\Livewire;

use App\Software;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Http\Controllers\ConfigController as Con;

class SetPrivileges extends Component
{

    public $spinner = '<i class="fa fa-spin fa-spinner" aria-hidden="true"></i>';
    public $modules = [];
    public $software, $isLoading, $query, $data, $selected, $showList, $users, $user_id, $module;
    public $permissions = [];
    protected $conn;

    public function mount()
    {
        $this->software = '';
        $this->users = [];
        $this->isLoading = false;
        $this->selected = false;
        $this->conn = 'mysql';
        $this->modules = ''; // changes to array/object when needed
        $this->user_id = '';
        $this->permissions = [];
    }

    

    public function updatedQuery()
    {
        $this->clearData();
        $start = time();
        $config = new Con;
        $this->showList = 'd-block';
        $this->selected = false;
        $users = $config->searchUser($this->query)->toArray();
        $count = ((count($users) +1) * -1);
        $this->users = array_pad($users, $count, count($users).' result(s) returned on '.$this->query);
    }

    public function clearData()
    {
        $this->user_id = '';
        $this->software = '';
        $this->module = '';
        $this->modules = '';
        $this->permissions = [];
    }

    public function clearInput()
    {
        $this->reset('query', 'users');
        // $this->mount();
    }

    public function fillUp($id) 
    {
        // $this->query = $id;
        $this->showList = 'd-none';
        $this->selected = true;
        $this->isLoading = true;
        $this->data = $this->users[$id];
        $this->user_id = $this->data['id'];
        $this->isLoading = false;
        $this->clearInput();
        // $this->softwares = Software::leftjoin('user_softwares as us', 'us.software_id', 'softwares.id');
    }


    public function updatedSoftware()
    {
        $this->modules = '';
        $this->getDb();
        $conn = $this->conn;
        try {
            $this->modules = $conn->table('modules')->get();
            $this->permissions = $conn->table('module_permissions')->where('user_id', $this->user_id)->get();
        } catch (\Throwable $th) {
            $this->modules = [];
        }
        // $this->isLoading = false;
    }

    public function getDb()
    {
        $soft = strtolower($this->software);
        $dbName = config('portals.'.$soft.'.database');
        Config::set('database.connections.tenant.database', $dbName);
        $this->conn = DB::connection('tenant');
    }

    public function render()
    {
        $softwares = Software::all();
        return view('livewire.set-privileges')->with([
                'softwares' => $softwares,
            ]);
    }
}
