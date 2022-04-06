<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class ListUsers extends AdminComponent
{
    use WithFileUploads;
    public $user;
    public $state = [];
    public $showEditModal = false;
    public $deleteId = null;
    public $searchTerm = null;
    protected $listeners = ['deleteConfirm' => 'delete'];
    protected $queryString = ['searchTerm' => ['except' => '']];
    public $photo;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
    public function store()
    {
        $data = Validator::make(
            $this->state,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ]
        )->validate();
        $data['password'] = bcrypt($data['password']);
        if ($this->photo) {
            $data['avatar'] = $this->photo->store('/', 'avatars');
        }
        User::create($data);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully']);
        return redirect()->back();
    }
    public function edit(User $user)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }
    public function update()
    {
        $data = Validator::make(
            $this->state,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,' . $this->user->id,
                'password' => 'sometimes|confirmed',
            ]
        )->validate();
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        if ($this->photo) {
            Storage::disk('avatars')->delete($this->user->avatar);
            $data['avatar'] = $this->photo->store('/', 'avatars');
        }
        $this->user->update($data);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User update successfully']);
    }
    public function deleteConfirmation($userId)
    {
        $this->deleteId = $userId;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }
    public function delete()
    {
        $user = User::findOrFail($this->deleteId);
        $user->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'User deleted successfully']);
        return redirect()->back();
    }
    public function changeRole(User $user, $role)
    {
        Validator::make(
            ['role' => $role],
            ['role' => 'required|in:' . User::ROLE_ADMIN . ',' . User::ROLE_USER]
        )->validate();
        $user->update(['role' => $role]);
        $this->dispatchBrowserEvent('role-changed', ['message' => "Changed to {$role} role successfully"]);
    }
    public function swapSortDirection()
    {
        return  $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function sortBy($column)
    {
        if ($this->sortColumnName === $column) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortColumnName = $column;
    }
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(10);
        return view('livewire.admin.users.list-users', [
            'users' =>  $users,
        ]);
    }
}
