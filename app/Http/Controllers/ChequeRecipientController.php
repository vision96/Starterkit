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
                ->addColumn('action', 'cheque_recipient.action')
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('view-chequeRecipients');
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChequeRecipient  $cheque_recipient
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {
        $cheque_recipient = ChequeRecipient::findOrFail($request->id);
        return response()->json($cheque_recipient);
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
            'name'=>'required|max:100',
        ]);

        try{
           $cheque_recipient = ChequeRecipient::findOrFail($id);

            $cheque_recipient->name = $request->name;
            $cheque_recipient->save();

        return response()->json(['success'=>'تم التحديث بنجاح']);
          }
          catch(\exception $ex){
              return response()->json(['error'=>'هناك خطا ما يرجى المحاولة لاحقا']);
          }
    }
}
