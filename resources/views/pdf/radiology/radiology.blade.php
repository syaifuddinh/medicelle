<?php 
    $company = Mod::company()
 ?>
 <style>
     * {
        margin:0;
        padding:0;
        font-size:14pt;
     }
     .container {
        padding:7mm;
     }
     li {
        padding-left:10mm
     }

     p, span, li {
        font-size:14pt;
     }

     .indent {
        text-indent:8mm
     }
     .mt-5 {
        margin-top:5mm;
     }
     .mt-2 {
        margin-top:2mm;
     }
     .ib{
        display:inline-block
     }
 </style>
 <div class="container" style='position: relative'>
     
        <div class="row" style='margin-top:4mm;'><!--
            <div style='margin-bottom:6mm'>
                <div style='display:inline-block'>
                    <img src="{!! $company->logo !!}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{!! $company->name ?? '' !!}</b>
                    <p>{!! $company->address !!}</p>
                    <p>Telp : {!! $company->phone_number !!} Fax : {!! $company->fax !!}</p>
                </div>
            </div>-->

            <div class="col-md-12" style='margin-top:25mm;padding-left:5.5mm;border-bottom:1px solid black;margin-bottom:7mm'>
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:10mm'>UNIT RADIOLOGI</p>

                <div style='margin-bottom:7mm;text-transform:uppercase;font-weight:bold'>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>No RM</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->code !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Nama Lengkap</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->patient->name !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Umur</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->patient->age !!} Tahun</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Tanggal Periksa</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! Mod::fullDate($medicalRecord->date) !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Klinis</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $pivotMedicalRecord->additional->klinis ?? '' !!}</span>
                    </p>
                </div>
            </div>
            <div class="col-md-12" style='padding-left:5.5mm'>
                
                <div style='margin-bottom:4mm'>
                    <p>TS. Yth, hasil pemeriksaan {!! $radiologyType->name ?? '' !!}</p>
                    <p class='mt-5'>
                        <b style='margin-bottom:1.4mm'>Hasil pemeriksaan :</b> <br> {!! $pivotMedicalRecord->additional->hasil_pemeriksaan ?? ''!!}
                    </p>
                    <p class='mt-2'>
                        <b style='margin-bottom:1.4mm'>Saran :</b> <br> {!! $pivotMedicalRecord->additional->saran ?? ''!!}
                    </p>
                    <p class='mt-2'>
                        <b style='margin-bottom:1.4mm'>Keterangan :</b> <br> {!! $pivotMedicalRecord->additional->radiology_description ?? ''!!}
                    </p>
                </div>
            </div>

                <div style='margin-top:1mm;padding-left:5.5mm'>
                <p style='margin-bottom:25mm'>{!! Mod::company()->city !!}, {!! Mod::fullDate($pivotMedicalRecord->medical_record_detail->date) !!}</p>

                <p style='font-weight:bold;'>
                    <span>
                        ( {!!$contact_name!!} )
                    </span>
                </p>
                </div>

        </div>
 </div>

