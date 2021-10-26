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

            <div class="col-md-12" style='padding-left:5.5mm;line-height:1cm'>
                <div class="header" style='text-align:center'>
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT CUTI HAMIL</span></h3>
                    <h4 style='font-weight:bold;'>{!! $letter->code !!}</h4>
                </div>
                <br>
                <p>Yang bertanda tangan dibawah ini : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Dokter</span> <span style='display:inline-block;font-weight:bold'>: {!! $letter->doctor->name !!}</span></p><br>
                <p>Menerangkan bahwa : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {!! $letter->medical_record->patient->name !!}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Umur</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->age !!} Tahun</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Alamat</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->address !!} </span></p><br>

                <p>Berdasarkan taksiran persalinan {!! Mod::fullDate($letter->review_date) !!} dan usia kehamilannya sudah {!! $letter->age . ' ' . ucfirst(strtolower($letter->age_type)) !!}, perlu diberikan cuti hamil selama {!! $letter->duration . ' ' . ucfirst(strtolower($letter->duration_type)) !!}. Terhitung dari tanggal {!! Mod::fullDate($letter->start_date) !!} s/d {!! Mod::fullDate($letter->end_date) !!}.</p>
                <br>
                <p>Demikian surat keterangan ini diberikan untuk diketahui dan dipergunakan dengan semestinya.</p><br><br>
                <p style='float:right;text-align:center;display:inline-block;display:inline-block'>
                    <span style=''>
                        {!! $company->city . ', '. Mod::fullDate(date('Y-m-d'))  !!}<br>
                        Dokter yang merawat,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{!! $letter->doctor->name !!}</b> )
                        </span>
                    </span> 
                </p>
                <br>
                @if($letter->description != null)
                    <p style='margin-top:35mm'>*) {!! $letter->description !!}</p>
                @endif
                <br>
        
                @include('pdf/letter_footer')        
            </div>
        </div>
 </div>
