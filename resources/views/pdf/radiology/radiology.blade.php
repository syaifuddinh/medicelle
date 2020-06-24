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

     p, span, li {
        font-size:10px;
     }

     .indent {
        text-indent:8mm
     }
     .mt-5 {
        margin-top:5mm;
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
                <p style='text-align:center;font-weight:bold;font-size:101%;'>HASIL BACAAN </p>
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:15mm'>{{ strtoupper($radiologyType->name) }}</p>
                
                <div style='margin-bottom:4mm'>
                    <p>TS. Yth, berikut saya sampaikan hasil {{ $radiologyType->name }}</p>
                    <p class='indent mt-5'>{{ $pivotMedicalRecord->additional->radiology_description ?? ''}}</p>
                </div>

                <div style='position:absolute;bottom:28mm'>
                    <div style='width:60%;display:inline-block'></div>
                    <div style='width:40%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>{{ Mod::company()->city }}, {{ Mod::fullDate($pivotMedicalRecord->medical_record_detail->date) }}</p>
                        <p style='text-align:center;'>( {{$medicalRecord->registration_detail->doctor->name}} )</p>
                    </div>
                </div>
                
                @include('pdf/letter_footer')   
            </div>
        </div>
 </div>
