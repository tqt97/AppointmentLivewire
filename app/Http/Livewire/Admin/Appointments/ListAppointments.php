<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Exports\AppointmentsExport;
use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
use Maatwebsite\Excel\Facades\Excel;

class ListAppointments extends AdminComponent
{
    protected $listeners = ['deleteConfirm' => 'delete'];
    public $deleteId = null;
    public $status = null;
    protected $queryString = ['status'];
    public $selectedRows = [];
    public $selectPageRows = false;

    public function deleteConfirmation($id)
    {
        $this->deleteId = $id;
        $this->dispatchBrowserEvent('show-delete-confirm');
    }
    public function delete()
    {
        $appointment = Appointment::findOrFail($this->deleteId);
        $appointment->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully!']);
    }
    public function filterByStatus($status = null)
    {
        $this->resetPage();
        $this->status = $status;
    }
    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->appointments->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset([
                'selectedRows',
                'selectPageRows'
            ]);
        }
    }
    public function getAppointmentsProperty()
    {
        return Appointment::with('client')
            ->when($this->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('order_position', 'asc')
            ->paginate(10);
    }
    public function deleteSelectedRows()
    {
        Appointment::whereIn('id', $this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'All selected appointments have been deleted successfully!']);
        $this->reset([
            'selectedRows',
            'selectPageRows'
        ]);
    }
    public function markAllAsScheduled()
    {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'SCHEDULED']);
        $this->dispatchBrowserEvent('updated', ['message' => 'All selected appointments have been marked as scheduled successfully!']);
        $this->reset([
            'selectedRows',
            'selectPageRows'
        ]);
    }
    public function markAllAsClosed()
    {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'CLOSED']);
        $this->dispatchBrowserEvent('updated', ['message' => 'All selected appointments have been marked as closed successfully!']);
        $this->reset([
            'selectedRows',
            'selectPageRows'
        ]);
    }
    public function export()
    {
        return (new AppointmentsExport($this->selectedRows))->download('appointments.xlsx');
    }
    public function updateAppointmentOrder($items)
    {
        foreach ($items as $item) {
            Appointment::find($item['value'])->update(['order_position' => $item['order']]);
        }
        $this->dispatchBrowserEvent('updated', ['message' => 'Appointment order has been updated successfully!']);
    }
    public function render()
    {
        $appointment = $this->appointments;
        $appointmentCount = Appointment::count();
        $scheduledAppointmentCount = Appointment::where('status', 'SCHEDULED')->count();
        $closedAppointmentCount = Appointment::where('status', 'CLOSED')->count();

        return view('livewire.admin.appointments.list-appointments', [
            'appointments' =>  $appointment,
            'appointmentCount' => $appointmentCount,
            'scheduledAppointmentCount' => $scheduledAppointmentCount,
            'closedAppointmentCount' => $closedAppointmentCount,
        ]);
    }
}
