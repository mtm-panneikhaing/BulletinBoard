<?php

namespace App\Exports;

use App\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Post::all();
    }

    public function headings():array{
        return[
            'Id',
            'Title',
            'Description',
            'Status',
            'Create User',
            'Updated User',
            'Deleted User',
            'Created Date',
            'Updated Date',
            'Deleted Date',
        ];
    }
}