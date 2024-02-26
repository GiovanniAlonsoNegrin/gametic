<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $search;

    // public function updatingSearch() {
    //     $this->resetPage();
    // }

    public function render()
    {
        $roles = Role::where('name', 'LIKE', '%'.$this->search.'%')
            ->latest('id')->paginate();

        return view('livewire.admin.roles-index', compact('roles'));
    }
}
