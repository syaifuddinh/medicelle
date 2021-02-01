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

    .page-break {
        page-break-after: always;
    }
 </style>
 <div class="container" style='position:relative'>
     
        <div class="row" style='margin-top:4mm;'>
            <div style='border-bottom:1px solid black;margin-bottom:6mm;width:auto'>
                <div style='display:inline-block'>
                    <img src="{!! $company->logo2 !!}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm;width:120mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{!! $company->name !!}</b>
                    <p>{!! $company->address !!}</p>
                    <p>Telp : {!! $company->phone_number !!} Fax : {!! $company->fax !!}</p>
                </div>
            </div>

        </div>

        <div>
            @include('pdf/medical_resume_body')
        </div>
        
        <div style='position:relative;margin-top:45mm'>   
                @include('pdf/letter_footer')    
        </div>
 </div>