<?php 
    $company = Mod::company()
 ?>
 <style>
     * {
        margin:0;
     }
     .container {
        padding:7mm;
     }

    .page-break {
        page-break-after: always;
    }
 </style>
 <div class="container">
     
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

{!! $content !!}
                <div style='position:relative;margin-top:45mm'>   
                        @include('pdf/letter_footer')    
                </div>


            </div>
        </div>

        @if(($medicalRecord->additional->general_visual ?? false) OR ($medicalRecord->additional->head_visual ?? false) OR ($medicalRecord->additional->breast_visual ?? false) OR ($medicalRecord->additional->rectum_visual ?? false))

            <div class="page-break"></div>

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

            @if($medicalRecord->additional->general_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Umum :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->general_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
            @if($medicalRecord->additional->head_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Kepala & Leher :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->head_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
            @if($medicalRecord->additional->breast_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Payudara :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->breast_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
            @if($medicalRecord->additional->rectum_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Rectum & Anal Canal :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->rectum_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
        @endif
 </div>