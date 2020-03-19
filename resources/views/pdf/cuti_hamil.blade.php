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
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT CUTI HAMIL</span></h3>
                    <h4 style='font-weight:bold;'>{{ $letter->code }}</h4>
                </div>
                <br>
                <p>Yang bertanda tangan dibawah ini : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Dokter</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->doctor->name }}</span></p><br>
                <p>Menerangkan bahwa : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->medical_record->patient->name }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Umur</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->age }} Tahun</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Alamat</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->address }} </span></p><br>

                <p style="text-indent:8mm">Berdasarkan taksiran persalinan {{ Mod::fullDate($letter->review_date) }} dan usia kehamilannya sudah {{ $letter->age . ' ' . ucfirst(strtolower($letter->age_type)) }}, perlu diberikan cuti hamil selama {{ $letter->duration . ' ' . ucfirst(strtolower($letter->duration_type)) }}. Terhitung dari tanggal {{ Mod::fullDate($letter->start_date) }} s/d {{ Mod::fullDate($letter->end_date) }}.</p>
                <br>
                <p style="text-indent:8mm">Demikian surat keterangan ini diberikan untuk diketahui dan dipergunakan dengan semestinya.</p><br><br>
                <p style='float:right;text-align:center;display:inline-block;display:inline-block'>
                    <span style=''>
                        {{ $company->city . ', '. Mod::fullDate(date('Y-m-d'))  }}<br>
                        Dokter yang merawat,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{{ $letter->doctor->name }}</b> )
                        </span>
                    </span> 
                </p>
                <br>
                @if($letter->description != null)
                    <p style='margin-top:35mm'>*) {{ $letter->description }}</p>
                @endif
                <br>
        
                @include('pdf/letter_footer')        
            </div>
        </div>
 </div>
