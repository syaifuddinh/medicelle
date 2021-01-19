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
                    <p style='margin-left:18mm;font-size:85%'><span style='display:inline-block;width:200mm'>{{ $company->address }}</span></p>
                </div>
            </div>

            <div class="col-md-12" style='padding-left:5.5mm'>
                <div class="header" style='text-align:center'>
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT PENGANTAR MRS</span></h3>
                    <h4 style='font-weight:bold;'>{{ $letter->code }}</h4>
                </div>
                <br>
                <table>
                    <tr>
                    <td width=80>Kepada</td>
                    <td width=10>:</td>
                    <td>Bagian Pendaftaran</td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>{{ $letter->additional->hospital ?? '' }}</td>
                    </tr>
                    <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>{{ $letter->additional->type ?? '' }}</td>
                    </tr>
                </table><br><br>
                <p style=''><span style='display:inline-block;width:35mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {{ $letter->medical_record->patient->name }}</span></p>

                <p style=''><span style='display:inline-block;width:35mm'>Umur</span> <span style='display:inline-block;'>: {{ $letter->medical_record->patient->age }} Tahun, {{ strtolower($letter->medical_record->patient->gender) }}</span></p>

                <p style=''><span style='display:inline-block;width:35mm'>Diagnosa</span> <span style='display:inline-block;'>: {{ $letter->additional->diagnose ?? '' }} </span></p><br>
                    
                <p style="">Rencana tindakan : <p><br>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Hari</span> <span style='display:inline-block;'>: {{ Mod::day($letter->review_date) }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Tanggal</span> <span style='display:inline-block;'>: {{ Mod::fullDate($letter->review_date) }}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:20mm'>Pukul</span> <span style='display:inline-block;'>: {{ $letter->additional->time ?? '' }}</span></p><br>

                 <p style=''><span style='display:inline-block;width:100mm'>Tindakan operasi :</span></p><br>

                 <p style='padding-left:8mm'>{{ $letter->additional->operation_treatment }}</span></p><br>

                 <p style=''><span style='display:inline-block;width:100mm'>Jenis operasi :</span></p><br>

                 <p style='padding-left:8mm'>{{ $letter->additional->operation_type }}</span></p><br>

                 <p style=''><span style='display:inline-block;width:100mm'>Keterangan :</span></p><br>

                 <p style='padding-left:8mm'>{{ $letter->description }}</span></p><br><br><br><br>

                    <span style='float:right;text-align:center;display:inline-block;display:inline-block'>
                        {{ $company->city . ', '. Mod::fullDate(date('Y-m-d'))  }}<br>
                        Dokter yang merawat,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{{ $letter->doctor->name }}</b> )
                        </span>
                    </span> 
                </p>
                <br>
                @include('pdf/letter_footer') 
            </div>
        </div>
 </div>
