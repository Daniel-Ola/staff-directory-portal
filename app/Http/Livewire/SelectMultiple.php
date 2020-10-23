<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ConfigController as Config;

use Livewire\Component;

class SelectMultiple extends Component
{
    public $query, $selected, $results;

    public function mount()
    {
        $this->query = '';
        $this->selected = [];
        $this->results = [];
    }

    public function updatedQuery()
    {
        $config = new Config;
        $results = $config->searchUser($this->query)->toArray();
        $count = ((count($results) +1) * -1);
        $this->results = array_pad($results, $count, count($results).' result(s) returned on '.$this->query);
    }

    public function getSelected($i)
    {
        if(!in_array($this->results[$i], $this->selected))
        {
            array_push($this->selected, $this->results[$i]);
        }
        // array_unique($this->selected, SORT_REGULAR);
        array_splice($this->results, $i, 1);
        $this->clearInputs(['query', 'results']);
    }

    public function clearInputs($inputs)
    {
        $this->reset($inputs);
    }
    
    public function removeSelected($i)
    {
        array_splice($this->selected, $i, 1);
    }

    public function render()
    {
        return view('livewire.select-multiple');
    }
}
