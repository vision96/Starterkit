<?php

namespace App\Http\Controllers;

use App\Models\ChequeRecipient;
use Illuminate\Http\Request;
use DataTables;

class ChequeRecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = ChequeRecipient::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('Y-m-d');
                })
                ->make(true);

        }
        return view('view-chequeRecipients');
    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-chequeRecipients');
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
                'name' => 'required|max:100',
            ]);

            ChequeRecipient::create([
                'name' => $request->name,
            ]);

            return response()->json(['success' => 'تمت الاضافة بنجاح']);
        } catch (\exception $ex) {
            return response()->json(['error' => 'هناك خطا ما ,حاول لاحقا', 'err' => $ex]);
        }
    }
}
