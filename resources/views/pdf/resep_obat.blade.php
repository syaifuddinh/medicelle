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

     p, span, li, td, th, div {
        font-size:11px;
     }

     th, td {
        padding:1mm;
     }
    
     table {
        width:100%
     }

     .w30 {
        width:30mm;
     }
     .inline-block {
        display:inline-block;
     }
     .mb1 {
        margin-bottom:1mm;
     }

 </style>
 <div class="container">
     
        <div class="row" style='margin-top:4mm;'>
            <div style='border-bottom:1px solid black;margin-bottom:6mm'>
                <div style='display:inline-block'>
                    <img src="{{ $company->logo }}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{{ $company->name }}</b>
                    <p>{{ $company->address }}</p>
                    <p>Telp : {{ $company->phone_number }} Fax : {{ $company->fax }}</p>
                </div>
            </div>

            <div class="col-md-12" style='padding-left:5.5mm'>
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:15mm'>SALINAN RESEP</p>
            
                <div class='mb1' style='position:relative;'>
                    <div class="inline-block w30">
                        No
                    </div>
                    <div class="inline-block"> : </div>
                    <div class="inline-block">
                        {{ $formula->medical_record->code }}
                    </div>

                    <div style='position: absolute;right:0mm'>
                        Tanggal : {{ Mod::now() }}
                    </div>
                </div>
            
                <div class='mb1'>
                    <div class="inline-block w30">
                        Dari Dokter
                    </div>
                    <div class="inline-block"> : </div>
                    <div class="inline-block">
                        {{ $formula->registration_detail->doctor->name }}
                    </div>
                </div>
            
                <div class='mb1'>
                    <div class="inline-block w30">
                        Untuk
                    </div>
                    <div class="inline-block"> : </div>
                    <div class="inline-block">
                        {{ $formula->registration_detail->doctor->name }}
                    </div>
                </div>
                
                <div style='margin-bottom:25mm;margin-top:10mm'>
                    @foreach($formula->detail as $detail)
                        <div style='font-style:italic;width:100%;margin-bottom:2.5mm'>
                            <div class="inline-block" style='font-size:101%'>
                                R / 
                            </div>
                            <div class="inline-block"  style='font-size:101%'>{{ $detail->item->name }}</div>
                            <div  class="inline-block" style='font-size:101%'>{{ number_format($detail->qty) }}</div>
                            <div class="inline-block"  style='font-size:101%'>{{ $detail->item->piece->name }}</div>
                            <div style='display:flex;position:relative'>
                                <div style='position:absolute;left:0;top:0.2mm;border-bottom:1px solid black;height:1mm;width:96%'></div>
                                <div style="float:right;font-size:101%;">
                                    det
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style='margin-top:10mm'>
                    <div style='width:30%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>{{ Mod::company()->city }}, {{ Mod::today() }}</p>
                        <p style='text-align:center;'>( {{ $formula->contributor->name }} )</p>
                    </div>
                </div>

                @include('pdf/letter_footer')   
            </div>
        </div>
 </div>
