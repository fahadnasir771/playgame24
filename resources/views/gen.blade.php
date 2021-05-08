@extends('layouts.app')

@section('content')
    <div class="container">
    
      <div class="row">
        <div class="col-8"> <div class="container">
          <input type="radio" class="form-control" checked style="height: 20px;display: inline-block; width: 5%" id="v1" name="type" value="v1">
          <label for="v1" style="position: relative; top: -5px">Singola/Multipla</label><br>
          <input type="radio" class="form-control" style="height: 20px;display: inline-block; width: 5%" id="v2" name="type" value="v2">
          <label for="v2" style="position: relative; top: -5px">Sistemi</label><br>

          <div class="row">
            <div class="col-6">
              <label for="">Enter Amount:</label>
              <input type="text" class="form-control" id="amt" value="2">
              
            </div>
            <div class="col-6">
              <label for="">Enter Cod. Fiscale:</label>
              <input type="text" class="form-control fiscale-in"  value="PTTGPP9026F912O">
            </div>
          </div>

          <br>
          <textarea name="" id="data" autofocus cols="30" rows="15" class="form-control" placeholder="Paste Data"></textarea>
          <br>
          <form action="{{ route('create_receipt') }}" method="POST" id="form">
            @csrf
            <button type="button" class="btn btn-lg btn-primary float-right gen-rec" style="display: none">Generate Receipt</button>
          </form>
      </div>
    </div>
        <div class="col-4">
          <div class="receipt card" style="position: relative">
            

             

              <div class="print-area main" style=" width: 8cm;margin-left: 10px;padding-right: 10px;padding-top: 20px; font-family: sans-serif; margin-left: 25px">
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
                          <div class="item2" id="date"></div>
                      </div>
                      <div class="field" style="margin-top: 18PX;">
                          <div class="item1">CODICE RICEVUTA AAMS</div>
                          <div class="item2" id="codice"></div>
                      </div>
                      <div class="field" style="margin-top: 36PX;">
                          <div class="item1">UTENE AAMS</div>
                          <div class="item2">8791036</div>
                      </div>
                      <div class="field" style="margin-top: 54PX;">
                          <div class="item1">TIPOLOGIA SCOMMESSA</div>
                          <div class="item2" id="bet-type">SINGOLA</div>
                      </div>
                      <div class="field" style="margin-top: 72PX;">
                          <div class="item1">IDENTITA</div>
                          <div class="item2">CONTO GIOCO</div>
                      </div>
                      <div class="field" style="margin-top: 90PX;">
                          <div class="item1">COD. FISCALE</div>
                          <div class="item2 fiscale" >PTTGPP9026F912O</div>
                      </div>
                  </div>
                  <div style="font-size: 11px;">
                      <center>La presente stampa e' un promemoria, non e; una ricevuta di gioco valido per la riscossione
                          della vincita</center>
                  </div>
                  <div id="sec"
                      style="border: 1px solid #000;margin-top: 3px;padding: 0px 3px 5px 3px;overflow: auto;font-size: 11px;">
                     
                      {{-- <div class="" style="margin-top: 10px">
                          <div class="" style="font-size: 11Px;width: 57%; display:inline-block;font-weight: 600 ">MACCABI TEL AVIV FC - BNEI YEHUDA (38448
                              - 31012)</div>
                          <div class="" style="display: inline-block; text-align:right; min-width:41%">07/07/2021</div>
                      </div>
                      <div class="" style="margin-top:3px">
                        <div class="" style="font-size: 11Px;width: 57%; display:inline-block; ">MACCABI TEL AVIV FC - BNEI YEHUDA (38448
                            - 31012)</div>
                        <div class="" style="display: inline-block; text-align:right; min-width:41%">1.50</div>
                      </div> --}}
  
                  </div>
                  <div id="third"
                      style="border-bottom: 1px solid #000;margin-top: 3px;padding: 10px 3px 5px 3px;overflow: auto;font-size: 12px;position: relative;border-left: 1px solid #000;border-right: 1px solid #000;top: -3px;">
                      <div class="field">
                          <div class="item1">Importo</div>
                          <div class="item2"><span style="font-weight: bolder;">&euro;</span> <span id="quan">0</span></div>
                      </div>
                      <div class="field" style="margin-top: 20px;">
                          <div class="item1">Quota Totale</div>
                          <div class="item2" id="quota">0</div>
                      </div>
                      <div class="field" style="margin-top: 40px;">
                        <div class="item1">Bonus</div>
                        <div class="item2" id="bonus">0</div>
                      </div>
                      <div class="field" style="margin-top: 60px;font-size: 14px;">
                          <div class="item1">VINCITA</div>
                          <div class="item2"><span style="font-weight: bolder;">&euro;</span> <span id="total">0</span> </div>
                      </div>
                  </div>
                  <center style="margin-top: 4px;">
                      <img src="{{ asset('images/qr.jfif') }}" height="120" alt="">
                  </center>
                  <center><b><span id="id_num">----</span></b></center>
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
    
   
    

    <style>
        #data {
            color: #495057;
            background-color: #fff;
            border-color: #a1cbef;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgb(52 144 220 / 25%);
        }
        .all-bets {
          display: none
        }
        

    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      let bets = [];
      function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
        return result;
      }
      function engine(){
        $('.all-bets').remove()
            bets = [];
            $('#sec').html('')
            let lines_length = ($('#data').val().split('\n')).length;

            let numer_of_open_brackets = ($('#data').val().split('(')).length - 1;
            let numer_of_close_brackets = ($('#data').val().split(')')).length - 1;

            // Finding bets data
            let bet = '';
            for (let i = 0; i < numer_of_open_brackets; i++) {
                
                for (j = 0; j < 4; j++) {
                    let lines = ($('#data').val().split('\n'));
                    let index = j + (i * 4);

                    if (j == 0) {
                        let last4 = lines[index].slice(-5);;
                        let last4_rem = lines[index].slice(0, -5);
                        // console.log(last4);
                        // break;
                        bet += last4_rem.trim() + '|' + last4;
                    }
                   
                    if (j == 1 || j == 2 || j == 3) {
                        bet += '|' + lines[index];
                    }
                }

               
                // Removing
                bet = bet.substring(bet.indexOf(')') + 1)
                let bet_split1 = bet.split('/')
                bet = bet.trim()

                $('#form').append(
                  `
                  <input type="text" name="bets[` + i + `]" class="all-bets" value="` + bet + `"></input>
                  `
                );
                bets.push(bet)
                // console.log(bet);
                bet = '';
            }

            // Bet type
            let type = '';
            if($('#v1').is(':checked')){
              if(bets.length == 1){
                type = "SINGOLA"
              }else{
                type = "MULTIPLA"
              }
            }else{
              type = "SISTEMI"
            }
            let sec_data = $('#data').val().split('Quota')[1]

            // Filtering
            
            let sec_data_length = sec_data.trim().split('\n');

            // Other data
            let quota = 0;
            let bonus = 0;
            let quantity = 0;
            let total = 0;
            for (let i = 0; i < sec_data_length.length; i++) {
                let line = sec_data_length[i];
                if (i == 0) {
                    quota = parseFloat(line.replace(',', '.'));
                }
                if (i == 2) {
                  
                    bonus = parseFloat(line.replace('€ ', ''))
                }
                // if (i == 4) {
                //     quantity = parseFloat(line)
                // }
                $('#data').css({
                    'border-color': '#a1cbef',
                    'box-shadow': '0 0 0 0.2rem rgb(52 144 220 / 25%)'
                })
                $('.gen-rec').css('display', 'block');
            }
            quantity = $('#amt').val()
            total = (quota * quantity) + bonus;
            // console.log(bets);
            // console.log(quota);
            // console.log(bonus);
            // console.log(parseFloat(total.toFixed(2)));

            let codice = randomString(11, '0123456789ABCDEF');
            $('#codice').text('DF07E5010' + codice);

            // DATA INSERTION
            for(let i=0; i < bets.length; i++){
              let b = bets[i].split('|');
              $('#sec').append(
                `
                <div class="" style="margin-top: 9px; text-transform: uppercase">
                  <div class="" style="font-size: 11Px;width: 57%; display:inline-block; ">` + b[0].replace('vs', '-') + `</div>
                  <div class="" style="display: inline-block; text-align:right; min-width:41%">` + b[1] + '/' + new Date().getFullYear() +`</div>
                </div>
                <div class="" style="margin-top:4px; text-transform: uppercase">
                  <div class="" style="font-size: 11Px;width: 57%; display:inline-block;">` + b[2] + `<div style="float:right">` + b[3] + `</div></div>
                  <div class="" style="display: inline-block; text-align:right; min-width:41%">` + b[4] + `</div>
                </div>
                `
              );
            }
            $('#quan').text(quantity);
            $('#quota').text(quota)
            $('#bonus').text(bonus)
            $('#total').text(total.toFixed(2))
            $('#bet-type').text(type);
            
            // alert()
            // alert()
            let d = new Date;
            $('#date').text(d.getDate() + '/' + parseInt(d.getMonth() + 1) + '/' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes())

            $('#form').append(
              `
              <input type="text" name="amount" class="all-bets" value="` + quantity + `"></input>
              <input type="text" name="fiscale" class="all-bets" value="` + $('.fiscale').text() + `"></input>
              <input type="text" name="fee" class="all-bets" value="` + quota + `"></input>
              <input type="text" name="bonus" class="all-bets" value="` + bonus + `"></input>
              <input type="text" name="win" class="all-bets" value="` + total + `"></input>
              <input type="text" name="type" class="all-bets" value="` + type + `"></input>
              <input type="text" name="code" class="all-bets" value="` + codice + `"></input>
              <input type="text" name="date" class="all-bets" value="` + d.getDate() + '/' + parseInt(d.getMonth() + 1) + '/' + d.getFullYear() + ' ' + d.getHours() + ':' + d.getMinutes() + `"></input>
              `
            );
      }
      $('#amt').on('keyup', function(){
        if($('#data').val() != ''){
          engine()
        }
       
      })
      // $('').on('input')

        $('#data').on('input', function() {
            
          engine()

        });
        $('.fiscale-in').on('input', function() {
            
          $('.fiscale').text($('.fiscale-in').val())
  
          });

        $('#v1, #v2').on('click', function(){
          let type = '';
          if($('#v1').is(':checked')){
            if(bets.length == 1){
              type = "SINGOLA"
            }else{
              type = "MULTIPLA"
            }
          }else{
            type = "SISTEMI"
          }
          $('#bet-type').text(type)
        })

        $('.gen-rec').on('click', function(){
          $.ajax({
            'url': '{{ route("get_max") }}',
            'method': 'GET',
            'success': function(res) {
              $('#id_num').text(1000 + parseInt(res) );
              $('#form').submit();


              var newWin=window.open('','Print-Window');
              newWin.document.open();

              newWin.document.write('<html><body onload="window.print()" style="width: 8cm; font-family: sans-serif">'+ $('.main').html() +'</body></html>');

              newWin.document.close();

              setTimeout(function(){newWin.close();},10);
              
            }
          })

          

        });

        window.onerror = function(msg, url, line) {
            $('#data').css({
                'border-color': '#dc3545',
                'box-shadow': '0 0 0 0.2rem rgba(220, 53, 69,0.6)'
            })
            $('.gen-rec').css('display', 'none');
        }

    </script>

@endsection
