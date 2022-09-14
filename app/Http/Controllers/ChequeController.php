<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Cheque;
use App\Models\ChequeRecipient;
use Carbon\Carbon;
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
                        return trans('translation.canceled');
                    }
                })
                ->addColumn('action', 'cheques.action')
                ->rawColumns(['action'])
                ->make(true);

        }
        $add_cheque = true;

        return view('view-cheques',compact('add_cheque'));
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

    public function getChequeNumber($bank_id){
        $last_cheque = Cheque::query()->where('bank_id',$bank_id)->orderBy('created_at', 'desc')->first();
        if($last_cheque != null){
            $last_cheque_number = $last_cheque->cheque_number;
            $current_cheque_number = $last_cheque_number + 1;
            return response()->json($current_cheque_number);
        }else{
            return response()->json(1);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {
        $cheque = Cheque::findOrFail($request->id);
        return response()->json($cheque);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $request->validate([
            'edit_cheque_number' => 'required|max:100',
            'edit_bank_id' => 'required|max:100',
            'edit_exchange_date' => 'required',
            'edit_cheque_recipient' => 'required|max:100',
            'editAmount' => 'required',
        ]);

        try{
            $cheque = Cheque::query()->findOrFail($id);

//            $date = date_format(date_create($request->exchange_date),"Y/m/d H:i:s");
            $cheque->cheque_number = $request->edit_cheque_number;
            $cheque->bank_id = $request->edit_bank_id;
            $cheque->exchange_date = $request->edit_exchange_date;
            $cheque->cheque_recipient = $request->edit_cheque_recipient;
            $cheque->amount = $request->editAmount;

            $cheque->save();

            return response()->json(['success'=>'تم التحديث بنجاح']);
        }
        catch(\exception $ex){
            return response()->json(['error'=>'هناك خطا ما يرجى المحاولة لاحقا']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chequesDue5Days(Request $request)
    {
        if ($request->ajax()) {

            $data = Cheque::query()->whereBetween('exchange_date',[Carbon::now(),Carbon::now()->addDays(5)])
                ->with('bank')->select('cheques.*');

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
                        return trans('translation.canceled');
                    }
                })
                ->addColumn('action', 'due5daysCheques.action')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('due-cheques');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dueCheques(Request $request)
    {
        if ($request->ajax()) {

            $data = Cheque::query()->where('exchange_date','<',Carbon::now())
                ->with('bank')->select('cheques.*');

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
                        return trans('translation.canceled');
                    }
                })
                ->addColumn('action', 'dueCheques.action')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('due-cheques');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chequesDue6Months(Request $request)
    {
        if ($request->ajax()) {

            $data = Cheque::query()->whereBetween('exchange_date',[Carbon::now(),Carbon::now()->addMonths(6)])
                ->with('bank')->select('cheques.*');

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
                        return trans('translation.canceled');
                    }
                })
                ->addColumn('action', 'due6monthsCheques.action')
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('due-cheques');
    }

}
