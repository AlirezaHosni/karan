<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    use Exportable;

    private $blade;
    private $collection;

    public function __construct($blade, $collection)
    {
        $this->blade = $blade;
        $this->collection = $collection;
    }

    public function view(): View
    {
        return view($this->blade, ['users' => $this->collection]);
    }
}

