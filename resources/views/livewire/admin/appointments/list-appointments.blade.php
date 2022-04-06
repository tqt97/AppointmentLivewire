<div>
    <div wire:loading.delay>
        <div class="load-page">
            <x-page-loading />
        </div>
    </div>
    <x-page-header header="Appointments management" />
    <x-content-div>
        <x-slot name="addButton">
            <div>
                <a href="{{ route('admin.appointments.create') }}">
                    <button class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New Appointment</button>
                </a>
                @if ($selectedRows)
                    <div class="btn-group ml-2">
                        <button type="button" class="btn btn-default">Bulk Actions</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                            data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#">
                                Delete Selected
                            </a>
                            <a wire:click.prevent="markAllAsScheduled" class="dropdown-item" href="#">
                                Mark as Scheduled
                            </a>
                            <a wire:click.prevent="markAllAsClosed" class="dropdown-item" href="#">
                                Mark as Closed
                            </a>
                            <a wire:click.prevent="export" class="dropdown-item" href="#">
                                Export
                            </a>
                        </div>
                    </div>
                    <span class="ml-2">selected {{ count($selectedRows) }}
                        {{ Str::plural('appointment', count($selectedRows)) }}
                    </span>
                @endif
            </div>
            <div class="btn-group">
                <button type="button" class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}"
                    wire:click="filterByStatus">
                    <span class="mr-1">All</span>
                    <span class="badge badge-pill badge-info">{{ $appointmentCount }}</span>
                </button>

                <button type="button" class="btn {{ $status == 'scheduled' ? 'btn-secondary' : 'btn-default' }}"
                    wire:click="filterByStatus('scheduled')">
                    <span class="mr-1">Scheduled</span>
                    <span class="badge badge-pill badge-primary">{{ $scheduledAppointmentCount }}</span>
                </button>

                <button type="button" class="btn {{ $status == 'closed' ? 'btn-secondary' : 'btn-default' }}"
                    wire:click="filterByStatus('closed')">
                    <span class="mr-1">Closed</span>
                    <span class="badge badge-pill badge-success">{{ $closedAppointmentCount }}</span>
                </button>
            </div>
        </x-slot>
        <x-slot name="table">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <div class="icheck-success d-inline ml-2">
                            <input wire:model="selectPageRows" type="checkbox" value="" name="mark" id="markAll">
                            <label for="markAll"></label>
                        </div>
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">
                        Client name
                        <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer;">
                            <i class="fa fa-arrow-up text-muted"></i>
                            <i class="fa fa-arrow-down text-muted"></i>
                        </span>
                    </th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody wire:sortable="updateAppointmentOrder">
                @forelse ($appointments as $appointment)
                    <tr wire:sortable.item="{{ $appointment->id }}" wire:key="appointment-{{ $appointment->id }}">
                        <td wire:sortable.handle style="width: 10px; cursor: move;"><i
                                class="fa fa-arrows-alt text-muted"></i></td>
                        <th style="width:10px">
                            <div class="icheck-success d-inline">
                                <input wire:model="selectedRows" type="checkbox" value="{{ $appointment->id }}"
                                    name="mark" id="{{ $appointment->id }}">
                                <label for="{{ $appointment->id }}"></label>
                            </div>
                        </th>
                        <th scope="row">{{ $appointment->id }}</th>
                        <td>{{ $appointment->client->name }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td>
                            <span class="{{ $appointment->status_badge }}">{{ $appointment->status }}</span>
                        </td>
                        <td>
                            <x-button.edit-link href="{{ route('admin.appointments.edit', $appointment->id) }}" />
                            <x-button.delete wire:click.prevent="deleteConfirmation({{ $appointment->id }})" />
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">Data is empty !</td>
                    </tr>
                @endforelse
            </tbody>
        </x-slot>
        <x-slot name="pagination">
            <x-pagination :pagination="$appointments" />
        </x-slot>
    </x-content-div>
    <x-confirm-alert />
</div>
@push('styles')
    <style>
        .draggable-mirror {
            background-color: white;
            width: 950px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

    </style>
@endpush

@push('after-livewire-scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush
