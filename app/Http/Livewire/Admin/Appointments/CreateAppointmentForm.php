<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state = [
        'status' => 'SCHEDULED',
        'order_position' => 0
    ];
    public function create()
    {
        Validator::make($this->state, [
            'client_id' => 'required',
            'members' => 'required',
            'date' => 'required',
            'color' => 'required',
            'time' => 'required',
            'note' => 'nullable',
            'status' => 'required|in:SCHEDULED,CLOSED',
        ], [
            'client_id.required' => 'Client is required',
        ])->validate();
        Appointment::create($this->state);
        $this->dispatchBrowserEvent('success', ['message' => 'Appointment created successfully!']);

        return redirect()->route('admin.appointments');
    }
    public function render()
    {
        return view('livewire.admin.appointments.create-appointment-form', [
            'clients' => Client::all(),
        ]);
    }
}
