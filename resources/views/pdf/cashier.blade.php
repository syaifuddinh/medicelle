<?php 
    $company = Mod::company()
 ?>
 <style>
     * {
        margin:0;
        padding:0;
     }
     .container {
        padding:7mm;
     }
     li {
        padding-left:10mm
     }
 </style>
 <div class="container">
     
        <div class="row" style='margin-top:4mm;'>
            <div style='margin-bottom:6mm'>
                <div style='display:inline-block'>
                    <img src="{{ $company->logo }}" style='width:auto;height:20mm;' alt="">
                    <p style='font-size:85%'>{{ $company->address }}</p>
                </div>
            </div>

            <div class="col-md-12" style='padding-left:5.5mm'>
                <div class="header">
                    <div style='text-align:center;display:inline-block;width:40%'></div>
                    <div style='text-align:center;display:inline-block;width:20%'>
                        
                        <h3 style='font-weight:bold;'><span>KWITANSI <br>RAWAT JALAN</span></h3>
                    </div>
                    <div style='display:inline-block;width:40%;text-align:right;'>
                        <div style='padding-left:13mm'>
                            <span style='display:inline-block;width:17mm'>No. Nota</span>
                            <span style='display:inline-block'>: {{ $data['invoice']->code }}</span>
                        </div>
                    </div>
                </div>
                <br>
                <p>Dokter</p>
                
        
                @include('pdf/letter_footer')        
            </div>
        </div>
 </div>
