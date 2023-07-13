<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportUser implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all(['id', 'role', 'department', 'email', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Role', 'Department', 'Email', 'Created At', 'Updated At'];
    }
}
