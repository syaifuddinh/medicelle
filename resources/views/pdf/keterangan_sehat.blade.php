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
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT KETERANGAN SEHAT</span></h3>
                    <h4 style='font-weight:bold;'>{{ $letter->code }}</h4>
                </div>
                <br>

                <p style="text-indent:8mm">Yang bertanda tangan dibawah ini, dokter {{ $company->name }} menerangkan dengan sesungguhnya bahwa bahwa : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->medical_record->patient->patient_type . ' ' . $letter->medical_record->patient->name }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Alamat</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->address }} </span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Jenis kelamin</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->gender }} </span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Tanggal lahir, umur</span> <span style='display:inline-block;'>: {{ Mod::fullDate($letter->medical_record->patient->birth_date) . ', ' . $letter->medical_record->patient->age .  ' Tahun'}} </span></p>


                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Pekerjaan</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->job }} </span></p><br>

                <p style="text-indent:8mm">Hasil pemeriksaan :</p><br>
                <p style='padding-left:8mm'>
                    <span style="display:inline-block;width:30mm">TD : {{ $letter->additional->td }}</span>
                    <span style="display:inline-block;width:30mm">N : {{ $letter->additional->n }}</span>
                    <span style="display:inline-block;width:30mm">RR : {{ $letter->additional->rr }}</span>
                    <span style="display:inline-block;width:30mm">Sh : {{ $letter->additional->sh }}</span>
                </p>
                <p style='padding-left:8mm'>
                    <span style="display:inline-block;width:30mm">BB : {{ $letter->additional->bb }}</span>
                    <span style="display:inline-block;width:30mm">TB : {{ $letter->additional->tb }}</span>
                    <span style="display:inline-block;width:30mm">Buta warna : {{ strtolower($letter->additional->buta_warna) }}</span>
                </p>
                <p style='padding-left:8mm'>
                    Pemeriksaan mata : {{ $letter->additional->eye_diagnose }} 
                </p>
                <p style='padding-left:8mm'>
                    Pemeriksaan telinga : {{ $letter->additional->ear_diagnose }} 
                </p><br>
                <p style="text-indent:8mm">Benar telah diperiksa dengan teliti dan pasien dinyatakan dalam keadaan {{ strtolower($letter->option) }}. Surat keterangan ini dipergunakan untuk {{ $letter->description }}</p><br><br>
                <p>
                    <span style='float:right;text-align:center;display:inline-block;display:inline-block'>
                        {{ $company->city . ', '. Mod::fullDate(date('Y-m-d'))  }}<br>
                        Dokter yang merawat,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{{ $letter->doctor->name }}</b> )
                        </span>
                    </span> 
                </p>
                <br>
                <br><br><br>

                @include('pdf/letter_footer') 
            </div>
        </div>
 </div>
