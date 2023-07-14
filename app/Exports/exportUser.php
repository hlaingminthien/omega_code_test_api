<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportUser implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all(['id', 'name', 'role', 'department', 'email', 'created_at', 'updated_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Role', 'Department', 'Email', 'Created At', 'Updated At'];
    }
}
