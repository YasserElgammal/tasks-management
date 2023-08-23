<?php

namespace App\Http\Livewire;

use App\Models\Category as CategoryModel;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    public $name;

    protected $rules = [
        'name' => 'required|min:6',
    ];

    public function store()
    {
        $this->validate();
        CategoryModel::create(['name' => $this->name, 'user_id' => auth()->id()]);
        $this->reset();
        session()->flash('message', 'Category Created');
    }

    public function render()
    {
        return view(
            'livewire.category',
            ['categories' => CategoryModel::with('user')->paginate(15)]
        );
    }
}
