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

            <div class="col-md-12" style='padding-left:5.5mm;line-height:0.7cm'>
                <div class="header" style='text-align:center'>
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT RUJUKAN PASIEN</span></h3>
                    <h4 style='font-weight:bold;'>{!! $letter->code !!}</h4>
                </div>
                <br>
                <p>Kepada</p>
                <p>{!! $letter->additional->hospital ?? '' !!}</p>
                <p>{!! $letter->additional->hospital_address ?? '' !!}</p><br>

                <p>Dengan hormat, </p>
                <p>Mohon bantuan sejawat atas pasien :</p><br>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {!! $letter->medical_record->patient->name !!}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Umur</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->age !!} Tahun, {!! strtolower($letter->medical_record->patient->gender) !!}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Alamat</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->address !!} </span></p>

                <p style='padding-left:8mm'>
                    <span style='display:inline-block;width:20mm'>Untuk</span> 
                    <span style='display:inline-block;'>:</span>
                </p>
                <ol style='padding-left:20mm'>
                    <li>Pengambilalihan kasus ini untuk tindakan selanjutnya.</li>
                    <li>Tindakan masalah medis untuk saat ini.</li>
                    <li>Atas permintaan pasien / keluarganya.</li>
                </ol>
                <br>

                <p>Data klinis :</p><br>   
                <p style='padding-left:8mm'>
                    <span style="display:inline-block;width:30mm">TD : {!! $letter->additional->td !!}</span>
                    <span style="display:inline-block;width:30mm">N : {!! $letter->additional->n !!}</span>
                    <span style="display:inline-block;width:30mm">RR : {!! $letter->additional->rr !!}</span>
                    <span style="display:inline-block;width:30mm">GCS : {!! $letter->additional->gcs !!}</span>
                </p><br>
                <p>Diagnosa kerja : {!! $letter->additional->diagnose !!}</p>
                <p>Terapi yang diberikan : {!! $letter->additional->therapy !!}</p>
                <p>Keterangan : {!! $letter->description !!}</p><br>

                <p>Terima kasih atas bantuan dan kerjasama yang diberikan.</p>
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
                @include('pdf/letter_footer') 
            </div>
        </div>
 </div>
