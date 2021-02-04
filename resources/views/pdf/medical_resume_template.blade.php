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

            <div class="col-md-12" style='padding-left:5.5mm'>
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:5mm'>RESUME MEDIS</p>
                <div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>No Rekam Medis</b>
                        </div>
                        <div style="display:inline-block;">
                            : {!! $medicalRecord->code !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div style="display:inline-block;width:45mm">
                            <b>Nama</b>
                        </div>
                        <div style="display:inline-block;width:150mm">
                            : {!! $medicalRecord->registration->patient->patient_type !!} {!! $medicalRecord->registration->patient->name !!}
                        </div>
                    </div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>Tanggal lahir</b>
                        </div>
                        <div style="display:inline-block;width:150mm">
                            : {!! Mod::fullDate($medicalRecord->registration->patient->birth_date) !!}
                        </div>
                    </div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>Alamat</b>
                        </div>
                        <div style="display:inline-block;width:150mm">
                            : {!! $medicalRecord->registration->patient->address !!}
                        </div>
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