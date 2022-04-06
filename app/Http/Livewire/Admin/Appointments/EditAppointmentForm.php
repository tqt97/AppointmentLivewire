<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditAppointmentForm extends Component
{
    public $state = [];
    public $appointment;

    public function mount(Appointment $appointment)
    {
        $this->state = $appointment->toArray();
        $this->appointment = $appointment;
    }
    public function update()
    {
        Validator::make($this->state, [
            'client_id' => 'required',
            'date' => 'required',
            'members' => 'nullable',
            'time' => 'required',
            'note' => 'nullable',
            'status' => 'required|in:SCHEDULED,CLOSED',
        ], [
            'client_id.required' => 'Client is required',
        ])->validate();
        $this->appointment->update($this->state);
        $this->dispatchBrowserEvent('success', ['message' => 'Appointment updated successfully!']);

    }

    public function render()
    {
        return view('livewire.admin.appointments.edit-appointment-form', [
            'clients' => Client::all(),
        ]);
    }
}
