<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\ConfigController as Config;
use App\Software;
use App\UserSoftware;

class SearchUser extends Component
{
    public $users, $query, $selected, $data, $softwares, $isLoading, $showList, $added;
    public $user_id;

    public function mount() 
    {
        $this->query = '';
        $this->selected = false;
        $this->isLoading = false;
        $this->users = [];
        $this->softwares = [];
        $this->added = []; //softwares owned by a user originally
        $this->user_id = null;
    }

    public function updatedQuery()
    {
        // $this->users = ['hello'];
        $start = time();
        $config = new Config;
        $this->showList = 'd-block';
        $this->selected = false;
        $users = $config->searchUser($this->query)->toArray();
        $count = ((count($users) +1) * -1);
        $this->users = array_pad($users, $count, count($users).' result(s) returned on '.$this->query);
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
        session()->flash('user_id', $this->user_id);
        $this->softwares = Software::all();
        $this->added = UserSoftware::where('user_id', $this->data['id'])->pluck('software_id')->toArray();
        $this->isLoading = false;
        $this->clearInput();
        // $this->softwares = Software::leftjoin('user_softwares as us', 'us.software_id', 'softwares.id');
    }

    public function render()
    {
        return view('livewire.search-user');
    }
}
