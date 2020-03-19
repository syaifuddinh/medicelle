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
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT RUJUKAN PASIEN</span></h3>
                    <h4 style='font-weight:bold;'>{{ $letter->code }}</h4>
                </div>
                <br>
                <p>Kepada</p>
                <p>{{ $letter->additional->hospital ?? '' }}</p>
                <p>{{ $letter->additional->hospital_address ?? '' }}</p><br>

                <p>Dengan hormat, </p>
                <p>Mohon bantuan sejawat atas pasien :</p><br>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->medical_record->patient->name }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Umur</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->age }} Tahun, {{ strtolower($letter->medical_record->patient->gender) }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Alamat</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->address }} </span></p>

                <p style='padding-left:8mm'>
                    <span style='display:inline-block;width:20mm'>Untuk</span> 
                    <span style='display:inline-block;'>:</span>
                </p>
                <ol>
                    <li>Pengambilalihan kasus ini untuk tindakan selanjutnya.</li>
                    <li>Tindakan masalah medis untuk saat ini.</li>
                    <li>Atas permintaan pasien / keluarganya.</li>
                </ol>
                <br>

                <p>Keterangan klinis :</p><br>   
                <p>
                    <span style='display:inline-block;'>TD : {{$letter->additional->td ?? ''}}
                    </span>
                </p>
                <p>Diagnosa kerja : {{ $letter->additional->diagnose }}</p>
                <p>Terapi yang diberikan : {{ $letter->additional->therapy }}</p><br>

                <p>Terima kasih atas bantuan dan kerjasama yang diberikan.</p>
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
