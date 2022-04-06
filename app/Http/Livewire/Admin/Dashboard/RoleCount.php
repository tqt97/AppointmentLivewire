<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\User;
use Livewire\Component;

class RoleCount extends Component
{
    public $rolesCount;
    public function mount()
    {
        $this->getRolesCount();
    }
    public function getRolesCount($role = null)
    {
        $this->rolesCount = User::query()
            ->when($role, function ($query, $role) {
                return $query->where('role', $role);
            })->count();
    }
    public function render()
    {
        return view('livewire.admin.dashboard.role-count');
    }
}
