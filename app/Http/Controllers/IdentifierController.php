<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\User;
use App\UserMeta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class IdentifierController extends Controller
{
    public function index()
    {
        $identifierIds = UserMeta::all()->pluck('identifier_id')->toArray();

        $identifiers = UserMeta::whereIn('id', $identifierIds)->get();

        return view('backEnd.identifier.index', compact('identifiers'));
    }

    public function listUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::with('userMeta', 'userMeta.grade')->latest()->get();
            session()->put('identifiedUsers', $data);

            if (!empty($request->get('identifier_id'))) {
                $identifier = $request->get('identifier_id');
                $data = $data->where('userMeta.identifier_id', $identifier);
                session()->put('identifiedUsers', $data);
            }

            $dataTable = Datatables::of($data);

            $dataTable
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('created_at', function ($row) {
                    return jalaliDate($row->created_at, "%Y / %m / %d");
                })
                ->addColumn('fullName', function ($row) {
                    return $row->fullName;
                })
                ->addColumn('national_code', function ($row) {
                    return $row->national_code;
                })
                ->addColumn('phoneNumber', function ($row) {
                    return $row->phoneNumber;
                })
                ->addColumn('province', function ($row) {
                    return $row->userMeta->province;
                })
                ->addColumn('city', function ($row) {
                    return $row->userMeta->city;
                })
                ->addColumn('grade', function ($row) {
                    return $row->userMeta->grade ? $row->userMeta->grade->title : '';
                })
                ->addColumn('buy_price', function ($row) {
                    return '0';
                });

            return $dataTable->make(true);
        }
    }

    public function excel()
    {
        return Excel::download(new UsersExport('backEnd.tables.identifier-table', session()->get('identifiedUsers')), 'users.xlsx');
    }
}
