<?php

namespace App\Http\Controllers;

use App\Models\Ms_category;
use App\Models\Transaction_detail;
use App\Models\Transaction_header;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaction_list = Transaction_detail::search()->paginate(5);
        // dd($transaction_list);
        $rank = $transaction_list->firstItem();
        // dd($transaction_list);
        return view('transaksi.index', compact('transaction_list', 'rank'));
    }




    public function rekap()
    {
        // dd($transaction_list);
        return view('transaksi.rekap');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required',
            'rate_euro' => 'required|numeric',
            'code' => 'required|numeric',
            'date_paid' => 'required|date',
        ]);

        // insert ke table transaction header
        $transaction_header = new Transaction_header();
        $transaction_header->description = $request->description;
        $transaction_header->rate_euro = $request->rate_euro;
        $transaction_header->code = $request->code;
        $transaction_header->date_paid =  Carbon::parse($request->date_paid)->toDateString();

        $transaction_header->save();

        // insert ke table transaction detail 1
        $rows = $request->input('detail');

        foreach ($rows as $row)
        {
            $items[] = [
                'transaction_id' => $transaction_header->id,
                'transaction_category_id' => $row['category'],
                'name' => $row['name'],
                'rate_idr' => $row['rate_idr']
            ];
        }
        
        Transaction_detail::insert($items);


        // insert ke table transaction detail 2
        $rows_2 = $request->input('detail_2');

        foreach ($rows_2 as $row)
        {
            $items_2[] = [
                'transaction_id' => $transaction_header->id,
                'transaction_category_id' => $row['category'],
                'name' => $row['name'],
                'rate_idr' => $row['rate_idr']
            ];
        }
        
        Transaction_detail::insert($items_2);

        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Transaction_detail::find($id);
        $category = Ms_category::get();
        return view('transaksi.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'description' => 'required',
            'rate_euro' => 'required|numeric',
            'code' => 'required|numeric',
            'date_paid' => 'required|date',
        ]);

        $detail = Transaction_detail::find($id);
        // transaction_id
        // update header
        $header = Transaction_header::find($detail->transaction_id);
        $header->description = $request->description;
        $header->code = $request->code;
        $header->rate_euro = $request->rate_euro;
        $header->date_paid = Carbon::parse($request->date_paid)->toDateString();

        $header->update();


        // update detail
        $detail = Transaction_detail::find($detail->transaction_id);
        $detail->transaction_category_id = $request->category;
        $detail->name = $request->name;
        $detail->rate_idr = $request->rate_idr;
        $detail->update();

        session()->flash('success', 'Berhasil simpan data');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // header
        // transaction_id
        // delete detail
        Transaction_detail::find($id)->delete();
        
        return redirect()->route('transaction.index')->with('success', 'Berhasil hapus Data');
    
    }
}
