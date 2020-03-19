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
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT KETERANGAN DOKTER</span></h3>
                    <h4 style='font-weight:bold;'>{{ $letter->code }}</h4>
                </div>
                <br>

                <p style="text-indent:8mm">Yang bertanda tangan dibawah ini menerangkan bahwa : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->medical_record->patient->patient_type . ' ' . $letter->medical_record->patient->name }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Umur</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->age }} Tahun</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Alamat</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->address }} </span></p>


                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Tempat, tanggal lahir</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->city->name . ', ' . Mod::fullDate($letter->medical_record->patient->birth_date) }} </span></p>


                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Pekerjaan</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->job }} </span></p><br>

                <p style="text-indent:8mm">Berdasarkan hasil pemeriksaan pasien tersebut selama {{ $letter->age }} hari, dari tanggal {{ Mod::fullDate($letter->start_date) }} s/d {{ Mod::fullDate($letter->end_date) }}, Diagnosa : {{ $letter->description }}</p>
                <br>
                <p style="text-indent:8mm">Demikian surat keterangan ini diberikan untuk diketahui dan dipergunakan dengan semestinya.</p><br><br>
                <p style='float:right;text-align:center;display:inline-block;display:inline-block'>
                    <span style="">
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
