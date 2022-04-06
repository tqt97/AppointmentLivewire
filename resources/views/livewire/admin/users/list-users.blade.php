<div>
    <x-page-header header="Users management" />
    <x-content-div>
        <x-slot name="addButton">
            <x-search-input wire:model="searchTerm" />
            <x-button.create wire:click="addNew" />
        </x-slot>
        <x-slot name="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name
                        <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
                            <i
                                class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                            <i
                                class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                        </span>
                    </th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Role</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody wire:loading.class="text-muted">
                @forelse ($users as $index => $user)
                    <tr wire:key="{{ $user->index }}">
                        <th scope="row">{{ $users->firstItem() + $index }}</th>
                        <td>
                            <img src="{{ $user->avatar_url }}" alt="avatar" width="50px" class="img-circle mr-1">
                            {{ $user->name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->created_at ? $user->created_at->toFormattedDate() : 'N/A' }}
                        </td>
                        <td>
                            <select class="form-control"
                                wire:change="changeRole({{ $user }},$event.target.value)">
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </td>
                        <td>
                            <x-button.edit wire:click.prevent="edit({{ $user }})" />
                            <x-button.delete wire:click.prevent="deleteConfirmation({{ $user->id }})" />
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">
                            <x-search-image />
                            <p>
                                No result was found
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-slot>
        <x-slot name="pagination">
            <x-pagination :pagination="$users" />
        </x-slot>

    </x-content-div>
    <x-create-modal showEditModal="{{ $showEditModal }}" addNew="Add new user" edit="Edit user">
        <x-form.input label="Name" name="name" placeholder="Enter name" />
        <x-form.input label="Email" name="email" placeholder="Enter your email address" />
        <x-form.input label="Password" name="password" type="password" placeholder="Enter password" />
        <x-form.input label="Confirm Password" name="password_confirmation" type="password"
            placeholder="Confirm Password" />
        <div class="form-group">
            <label for="customFile">Profile Photo</label>
            <div class="custom-file">
                <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false; progress = 5"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>
                    </div>
                </div>
                <label class="custom-file-label" for="customFile">
                    @if ($photo)
                        {{ $photo->getClientOriginalName() }}
                    @else
                        Choose Image
                    @endif
                </label>
            </div>
            @if ($photo)
                <div class="mt-3">
                    <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded">
                </div>
            @else
                <div class="mt-3">
                    <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mb-2 w-100 rounded">
                </div>
            @endif
        </div>
    </x-create-modal>
    <x-confirm-alert />
</div>
