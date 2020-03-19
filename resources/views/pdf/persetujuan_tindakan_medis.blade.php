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
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>PERSETUJUAN TINDAKAN MEDIS</span></h3>
                    <h4 style='font-weight:bold;'>{{ $letter->code }}</h4>
                </div>
                <br>
                <p>Saya yang bertanda tangan dibawah ini :</p><br>

                <p style='padding-left:8mm;margin-bottom:1mm'><span style='display:inline-block;width:40mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->additional->name }}</span></p>

                <p style='padding-left:8mm;margin-bottom:1mm'><span style='display:inline-block;width:40mm'>Alamat</span> <span style='display:inline-block;'>: {{ $letter->additional->address }}</span></p>


                <p style='padding-left:8mm;margin-bottom:1mm'><span style='display:inline-block;width:40mm'>Identitas Diri</span> <span style='display:inline-block;'>: {{ $letter->additional->identitas_diri }}</span></p>
                <br>
                <p style='margin-bottom:1mm'>
                    <b>PERSETUJUAN</b>
                </p>
                <p>Untuk melakukan tindakan medis berupa {{ $letter->description }}</p>    
                <p>Terhadap diri saya sendiri / istri / suami / anak / ibu / ayah saya * dengan </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->medical_record->patient->name }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Umur / Jenis Kelamin</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->age }} Tahun /  {{ strtolower($letter->medical_record->patient->gender) }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Alamat</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->address }} </span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>No Rekam Medis</span> <span style='display:inline-block;'>: {{ $letter->medical_record->code }} </span></p>
                <br>

                <p>Yang tujuan, sifat dan perlunya tindakan medis tersebut di atas serta risiko yang dapat ditimbulkannya telah cukup dijelaskan oleh dokter dan saya telah mengerti sepenuhnya. Demikian pernyataan ini saya buat penuh kesadaran dan tanpa paksaan. </p><br>   
                <br><br>
                <p>
                    <span style="display:inline-block;">
                        Dokter,<br><br><br><br>
                        <span style='display:inline-block;width:50mm'>
                           ( <b>{{ $letter->doctor->name }}</b> )
                        </span>
                    </span> 

                    <span style='float:right;text-align:center;display:inline-block;display:inline-block'>
                        {{ $company->city . ', '. Mod::fullDate(date('Y-m-d'))  }}<br>
                        Yang membuat pernyataan,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{{ $letter->medical_record->patient->name }}</b> )
                        </span>
                    </span> 
                </p>
                <br>
                <br>
                <p>
                    <span style="display:inline-block;margin-left:0mm">
                        Perawat,<br><br><br><br>
                        <span style='display:inline-block;width:50mm'>
                           ( .................................... )
                        </span>
                    </span> 
                    <span style="display:inline-block;margin-left:90mm">
                        Keluarga Pasien,<br><br><br><br>
                        <span style='display:inline-block;width:50mm'>
                           ( <b>{{ $letter->additional->name }}</b> )
                        </span>
                    </span> 

                </p>
                @include('pdf/letter_footer') 
            </div>
        </div>
 </div>
