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
     .footerclass {
        font-size:10pt;
        margin:0;
        padding:0;
     }

 </style>
 <div class="container">
     
        <div class="row" style='margin-top:4mm;'>
            <div style='margin-bottom:6mm;'>
                <div style='display:inline-block'>
                    <img src="{!! $company->logo2 !!}" style='width:auto;height:15mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm;width:500px;font-size:14px;'>
                    <b style='font-size:110%;text-transform:uppercase'>{!! $company->name ?? '' !!}</b>
                    <p>{!! $company->address !!}</p>
                    <p>Telp : {!! $company->phone_number !!} Fax : {!! $company->fax !!}</p>
                </div>
            </div>

            <div class="col-md-12" style='padding-left:5.5mm;padding-right:8mm;line-height:1cm'>
                <div class="header" style='text-align:center'>
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT LAYAK TERBANG</span></h3>
                    <h4 style='font-weight:bold;'>{!! $letter->code !!}</h4>
                </div>
                <br>
                <p>Yang bertanda tangan dibawah ini menerangkan bahwa : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:50mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {!! $letter->medical_record->patient->name !!}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:50mm'>Umur</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->age !!} Tahun</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:50mm'>Alamat</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->address !!} </span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:50mm'>Umur kehamilan</span> <span style='display:inline-block;'>: {!! $letter->age . 
                ' ' . $letter->age_type !!} </span></p>
                <p style='padding-left:8mm;text-decoration:italic'>(Untuk ibu hamil)</p><br>

                <p>Telah diperiksa dan dinyatakan dalam kondisi sehat (khusus untuk ibu hamil : ibu dan janin dalam kondisi sehat) dan dinyatakan <b>{!! $letter->option !!}</b> dari {!! $company->city !!} menuju {!! $letter->additional->destination !!}. {!! ucfirst($letter->description) !!}.</p>
                <br><br>
                <p>
                    <span style='float:right;text-align:center;display:inline-block;display:inline-block'>
                        {!! $company->city . ', '. Mod::fullDate(date('Y-m-d'))  !!}<br>
                        Dokter yang merawat,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{!! $letter->doctor->name !!}</b> )
                        </span>
                    </span> 
                </p>
            </div>
                @include('pdf/letter_footer') 
        </div>
 </div>
