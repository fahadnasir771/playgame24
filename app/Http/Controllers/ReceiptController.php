<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function get_max(){
        return Receipt::max('id') +1;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // dd($request->all());
        // Saving receipt
        $receipt = new Receipt();
        $receipt->date = $request->date;
        $receipt->receipt_code = $request->code;
        $receipt->utene_aams = '8791036';
        $receipt->type = $request->type;
        $receipt->amount = $request->amount;
        $receipt->fee = $request->fee;
        $receipt->bonus = $request->bonus;
        $receipt->win = $request->win;
        $receipt->fiscale = $request->fiscale;
        $receipt->only_date = date('Y-m-d');
        $receipt->save();

        // Saving bets
        for ($i=0; $i < count($request->bets); $i++) { 
            $line = explode('|',$request->bets[$i]);

            $bet = new Bet();
            $bet->receipt_id = $receipt->id;
            $bet->line1_1 = $line[0]; 
            $bet->line1_2 = $line[1]; 
            $bet->line2_1 = $line[2]; 
            $bet->line2_2 = $line[3]; 
            $bet->line2_3 = $line[4]; 
            $bet->save();
        }

        return redirect()->route('home');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt, $id)
    {
        Receipt::find($id)->delete();
        Bet::where('receipt_id', $id)->delete();

        return redirect()->back();
    }
}
