<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AppointmentsExport implements FromQuery, WithMapping,WithHeadings
{
    use Exportable;
    protected $selectedRows;
    public function __construct($selectedRows)
    {
        $this->selectedRows = $selectedRows;
        // dd($this->selectedRows);
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Appointment::all();
    // }
    public function map($appointment): array
    {
        return [
            $appointment->id,
            $appointment->client->name,
            $appointment->date,
            $appointment->time,
            $appointment->status,
        ];
    }
    public  function headings(): array
    {
        return [
            'ID',
            'Client Name',
            'Date',
            'Time',
            'Status',
        ];
    }
    public function query()
    {
        return Appointment::with('client:id,name')->whereIn('id', $this->selectedRows);
    }
}
