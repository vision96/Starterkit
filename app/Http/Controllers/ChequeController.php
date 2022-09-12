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
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('Y-m-d');
                })
                ->editColumn('bank', function($data)
                {
                    return $data->bank->bank_name;
                })
                ->editColumn('status', function($data)
                {
                    if($data->status == 0){
                        return trans('translation.paid');
                    }elseif ($data->status == 1){
                        return trans('translation.returned');
                    }elseif ($data->status == 2){
                        return trans('translation.canceled');
                    }
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
                'cheque_number' => 'required|max:100|unique:cheques,cheque_number',
                'bank_id' => 'required|max:100',
                'exchange_date' => 'required',
                'cheque_recipient' => 'required|max:100',
                'amount' => 'required',
            ]);

            $date = date_format(date_create($request->exchange_date),"Y/m/d H:i:s");

            Cheque::create([
                'cheque_number' => $request->cheque_number,
                'bank_id' => $request->bank_id,
                'exchange_date' => $date,
                'cheque_recipient' => $request->cheque_recipient,
                'amount' => $request->amount,
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
