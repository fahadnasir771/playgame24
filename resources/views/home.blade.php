@extends('layouts.app')

@section('content')
<div class="container">
    <input type="text" id="input" onkeyup="search()" class="form-control" placeholder="Receipt No.">
    <br>
    
        @foreach ($filter as $f)
            @php
                $receipts = $f->with('bets')->where('only_date', $f->only_date)->get();
                // dd($receipts);
                $sum = 0;
                $win = 0;
                foreach ($receipts as $rr) {
                    $sum += $rr->amount; 
                    $win += $rr->win; 
                }
            @endphp
            <h4>{{ date( 'jS M, y', strtotime($receipts[0]['only_date'])) }} | <span style="font-size: 16px; color: royalblue">Bets: {{$sum}}</span>, <span style="color: #129649; font-size: 16px">Winnings: {{ number_format($win,2)}}</span> </h4>
            
            <div class="row" id="m">

                @foreach ($receipts as $r)
                
                
                    
                <div class="col-4 receipt">
                    <a href="" style="display: none">{{ 1000 + $r->id }}    </a>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$r->id}}" aria-expanded="true" aria-controls="collapseOne" style="color: #000; text-decoration: none;font-size: 15px ">
                                    <center>Receipt# <b>{{ 1000 + $r->id }}</b> | {{ date( 'jS M, Y',strtotime(explode(' ',$r->only_date)[0]))}}</center>
                                </button>
                                
                            </h2>
                            </div>
                        
                            <div id="collapse{{$r->id}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body" style="padding-top: 0">
                                    <br>
                                    <div  style="overflow: auto; ">
                                        <button style="display: inline-block; float: right" class="btn btn-primary btn-sm print">Print</button>
                                        <form action="{{ route('delete_receipt', $r->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" style="display:inline-block; color: #fff; float:right; margin-right: 6px" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                    <br>
                                    <div class="print-area main" style=" width: 8cm;margin-left: 10px;padding-right: 10px;padding-top: 15px; font-family: sans-serif;">
                                        <center style="font-family: monospace;font-size: 20px;"><img height="20" src="{{ asset('images/logo.png') }}" alt=""></center>
                                        <div class="logos-area" style="margin-top: 15px;">
                        
                                            <img src="{{ asset('images/AAMS.png') }}" alt=""
                                                style="width: 8.4cm; position: relative; left: -21px;">
                        
                                        </div>
                                        <div style="font-size: 11px;">
                                            <center>E-Play24 lta ltd - P.IVA91345080377 - Cono. GAD15232</center>
                                        </div>
                                        <div id="info"
                                            style="border: 1px solid #000;margin-top: 3px;padding: 5px 3px;overflow: auto;font-size: 11px;">
                                            <div class="field">
                                                <div class="item1">DATA DELLA RICEVUTA</div>
                                                <div class="item2">{{ $r->date }}</div>
                                            </div>
                                            <div class="field" style="margin-top: 18PX;">
                                                <div class="item1">CODICE RICEVUTA AAMS</div>
                                                <div class="item2">{{ $r->receipt_code }}</div>
                                            </div>
                                            <div class="field" style="margin-top: 36PX;">
                                                <div class="item1">UTENE AAMS</div>
                                                <div class="item2">{{ $r->utene_aams }}</div>
                                            </div>
                                            <div class="field" style="margin-top: 54PX;">
                                                <div class="item1">TIPOLOGIA SCOMMESSA</div>
                                                <div class="item2" id="bet-type">{{ $r->type }}</div>
                                            </div>
                                            <div class="field" style="margin-top: 72PX;">
                                                <div class="item1">IDENTITA</div>
                                                <div class="item2">CONTO GIOCO</div>
                                            </div>
                                            <div class="field" style="margin-top: 90PX;">
                                                <div class="item1">COD. FISCALE</div>
                                                <div class="item2">{{ $r->fiscale0v }}</div>
                                            </div>
                                        </div>
                                        <div style="font-size: 11px;">
                                            <center>La presente stampa e' un promemoria, non e; una ricevuta di gioco valido per la riscossione
                                                della vincita</center>
                                        </div>
                                        <div id="sec"
                                            style="border: 1px solid #000;margin-top: 3px;padding: 0px 3px 5px 3px;overflow: auto;font-size: 11px;">
                                        
                                            @foreach ($r->bets as $bet)
                                                <div class="" style="margin-top: 9px; text-transform: uppercase">
                                                    <div class="" style="font-size: 11Px;width: 57%; display:inline-block; ">{{ $bet->line1_1 }}</div>
                                                    <div class="" style="display: inline-block; text-align:right; min-width:41%">{{ $bet->line1_2 }}</div>
                                                </div>
                                                <div class="" style="margin-top:4px; text-transform: uppercase">
                                                    <div class="" style="font-size: 11Px;width: 57%; display:inline-block;">{{ $bet->line2_1 }}<div style="float:right">{{ $bet->line2_2 }}</div></div>
                                                    <div class="" style="display: inline-block; text-align:right; min-width:41%">{{ $bet->line2_3 }}</div>
                                                </div>
                                            @endforeach
                        
                                        </div>
                                        <div id="third"
                                            style="border-bottom: 1px solid #000;margin-top: 3px;padding: 10px 3px 5px 3px;overflow: auto;font-size: 12px;position: relative;border-left: 1px solid #000;border-right: 1px solid #000;top: -3px;">
                                            <div class="field">
                                                <div class="item1">Importo</div>
                                                <div class="item2"><span style="font-weight: bolder;">&euro;</span> <span id="quan">{{$r->amount}}</span></div>
                                            </div>
                                            <div class="field" style="margin-top: 20px;">
                                                <div class="item1">Quota Totale</div>
                                                <div class="item2" id="quota">{{$r->fee}}</div>
                                            </div>
                                            <div class="field" style="margin-top: 40px;">
                                            <div class="item1">Bonus</div>
                                            <div class="item2" id="bonus">{{$r->bonus}}</div>
                                            </div>
                                            <div class="field" style="margin-top: 60px;font-size: 14px;">
                                                <div class="item1">VINCITA</div>
                                                <div class="item2"><span style="font-weight: bolder;">&euro;</span> <span id="total">{{number_format($r->win,2)}}</span> </div>
                                            </div>
                                        </div>
                                        <center style="margin-top: 4px;">
                                            <img src="{{ asset('images/qr.jfif') }}" height="120" alt="">
                                        </center>
                                        <center><b>{{ 1000 + $r->id }}</b></center>
                                        <style>
                                        .main {
                                            width: 8cm;
                                            padding-left: 10px;
                                            padding-right: 10px;
                                            padding-top: 20px
                                            }
                    
                                            .field {}
                    
                                            .item1 {
                                            float: left;
                                            font-weight: 600;
                                            }
                    
                                            .item2 {
                                            float: right;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                

                @endforeach
            </div>
            
        @endforeach
        
        
   
</div>
<style>

    body {
      font-family: sans-serif;
      color: #232323;
      margin: 0;
      padding: 0;
    }
    .col-4 {
        margin-bottom: 40px
    }
    .main {

      width: 8cm;
      padding-left: 10px;
      padding-right: 10px;
        padding-top: 20px
    }
    .field{
      
    }
    .item1 {
      float: left;
      font-weight: 600;
    }
    .item2 {
      float: right;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function search() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("input");
        filter = input.value.toUpperCase();
        ul = document.getElementById("m");
        li = ul.getElementsByClassName("receipt");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    $('.print').on('click', function(){
        let index = $(this).index();
        
        print($('.print-area').eq(index));
    });

    function print(el) 
    {
        
        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">'+ el.html() + `<style>

body {
  font-family: sans-serif;
  color: #232323;
  margin: 0;
  width: 8cm;
  padding-top: 25px;
  padding-left: 10px
}
.main{
    margin-left: 10px;
    margin-top: 25px
}
.col-4 {
    margin-bottom: 40px
}

.field{
  
}
.item1 {
  float: left;
  font-weight: 600;
}
.item2 {
  float: right;
}
</style>` +'</body></html>');

        newWin.document.close();

        // setTimeout(function(){newWin.close();},100);

    }
</script>







@endsection
