<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Cheque;
use App\Models\ChequeRecipient;
use Illuminate\Http\Request;
use DataTables;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Cheque::with('bank')->select('cheques.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('bank', function($data)
                {
                    return $data->bank->bank_name;
                })
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('Y-m-d');
                })
                ->make(true);

        }
        return view('view-cheques');
    }
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('add-cheque',compact('banks'));
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
                'cheque_number' => 'required|max:100',
                'bank_id' => 'required|max:100',
                'exchange_date' => 'required',
                'cheque_recipient' => 'required|max:100',
                'amount' => 'required',
                'status' => 'required'
            ]);

            $date = date_format(date_create($request->exchange_date),"Y/m/d H:i:s");

            Cheque::create([
                'cheque_number' => $request->cheque_number,
                'bank_id' => $request->bank_id,
                'exchange_date' => $date,
                'cheque_recipient' => $request->cheque_recipient,
                'amount' => $request->amount,
                'status' => $request->status,
            ]);

            ChequeRecipient::create([
                'name' => $request->cheque_recipient,
            ]);

            return response()->json(['success' => 'تمت الاضافة بنجاح']);
        } catch (\exception $ex) {
            return response()->json(['error' => 'هناك خطا ما ,حاول لاحقا', 'err' => $ex]);
        }
    }
}
