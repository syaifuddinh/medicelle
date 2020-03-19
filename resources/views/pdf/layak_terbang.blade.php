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
                <div class="header" style='text-align:center'>
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT LAYAK TERBANG</span></h3>
                    <h4 style='font-weight:bold;'>{{ $letter->code }}</h4>
                </div>
                <br>
                <p>Yang bertanda tangan dibawah ini menerangkan bahwa : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->medical_record->patient->name }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Umur</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->age }} Tahun</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Alamat</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->address }} </span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Umur kehamilan</span> <span style='display:inline-block;'>: {{ $letter->age . 
                ' ' . $letter->age_type }} </span></p>
                <p style='padding-left:8mm;text-decoration:italic'>(Untuk ibu hamil)</p><br>

                <p style="text-indent:8mm">Telah diperiksa dan dinyatakan dalam kondisi sehat (khusus untuk ibu hamil : ibu dan janin dalam kondisi sehat) dan dinyatakan <b>{{ $letter->option }}</b> dari {{ $company->city }} menuju {{ $letter->additional->destination }}. {{ ucfirst($letter->description) }}.</p>
                <br><br>
                <p>
                    <span style='float:right;text-align:center;display:inline-block;display:inline-block'>
                        {{ $company->city . ', '. Mod::fullDate(date('Y-m-d'))  }}<br>
                        Dokter yang merawat,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{{ $letter->doctor->name }}</b> )
                        </span>
                    </span> 
                </p>
                @include('pdf/letter_footer') 
            </div>
        </div>
 </div>
