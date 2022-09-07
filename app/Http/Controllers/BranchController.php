<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Branch;
use Illuminate\Http\Request;
use DataTables;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Branch::with('bank')->select('branches.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('bank', function($data)
                {
                    return $data->bank->bank_name;
                })
                ->make(true);

        }

        return view('view-branches');
    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('add-branch',compact('banks'));
    }

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
                'branch_name' => 'required|max:100',
                'branch_number' => 'required|max:100',
            ]);

           Branch::create([
                'branch_name' => $request->branch_name,
                'branch_number' => $request->branch_number,
                'bank_id' => $request->bank_id
            ]);

            return response()->json(['success' => 'تمت الاضافة بنجاح']);
        } catch (\exception $ex) {
            return response()->json(['error' => 'هناك خطا ما ,حاول لاحقا', 'err' => $ex]);
        }
    }
}
