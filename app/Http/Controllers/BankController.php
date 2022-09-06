<?php

namespace App\Http\Controllers;


use App\DataTables\BankDatatable;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankDatatable $dtable)
    {
        return $dtable->render('view-banks');
    }

//
//    /**
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        return view('add-bank');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'bank_name' => 'required|max:100',
                'bank_number' => 'required|max:100',
                'branch_name' => 'required|max:100',
                'branch_number' => 'required|max:100',
            ]);

           Bank::create([
                'bank_name' => $request->bank_name,
                'bank_number' => $request->bank_number,
                'branch_name' => $request->branch_name,
                'branch_number' => $request->branch_number,
            ]);

            return response()->json(['success' => 'تمت الاضافة بنجاح']);
        } catch (\exception $ex) {
            return response()->json(['error' => 'هناك خطا ما ,حاول لاحقا', 'err' => $ex]);
        }
    }
}
