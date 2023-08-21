<?php

namespace App\Http\Livewire;

use App\Models\Category as CategoryModel;
use Livewire\Component;

class Category extends Component
{
    public $categories;
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
            ['categories' => $this->categories = CategoryModel::with('user')->get()]
        );
    }
}
