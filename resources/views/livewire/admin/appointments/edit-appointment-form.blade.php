<div>
    <x-page-header header="Edit appointment" />
    <x-content-div>
        <form wire:submit.prevent="update" autocomplete="off">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client">Client:</label>
                                <select class="form-control @error('client_id') is-invalid @enderror"
                                    wire:model.defer="state.client_id">
                                    <option value="">Select Client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select team member</label>
                                <x-form.input-select-2 wire:model="state.members" id="member">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>Dom</option>
                                    <option>Test</option>
                                </x-form.input-select-2>
                            </div>
                            @error('members')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="appointmentDate">Appointment Date</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <x-datepicker wire:model.defer="state.date" id="appointmentDate"
                                        :error="'date'" />
                                    @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="appointmentTime">Appointment Time</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <x-timepicker wire:model.defer="state.time" id="appointmentTime"
                                        :error="'time'" />
                                    @error('time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" wire:ignore>
                                <label for="note">Note:</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" wire:model.defer="state.note" id="note"
                                    data-note="@this">{!! $state['note'] !!}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Select status:</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                    wire:model.defer="state.status">
                                    <option value="">Select Client</option>
                                    <option value="SCHEDULED">Scheduled</option>
                                    <option value="CLOSED">Closed</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="submit" class="btn btn-success mr-2"><i class="fas fa-save"></i>
                        Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </x-content-div>
    @include('livewire.admin.appointments.appointment-css')
    @include('livewire.admin.appointments.appointment-js')
</div>
