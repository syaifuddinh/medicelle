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
        font-size:12pt;
     }
     li {
        padding-left:10mm
     }

     .footerclass {
        font-size:10pt;
        margin:0;
        padding:0;
     }

     .indent {
        text-indent:8mm
     }
     .mt-5 {
        margin-top:5mm;
     }
     .mt-2 {
        margin-top:2mm;
     }
     .ib{
        display:inline-block
     }
     table {
        width:100%
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
                    <h3 style='font-weight:bold;'><span style='border-bottom:1px solid black'>SURAT KETERANGAN DOKTER</span></h3>
                    <h4 style='font-weight:bold;'>{!! $letter->code !!}</h4>
                </div>
                <br>

                <p style="text-indent:8mm">Yang bertanda tangan dibawah ini menerangkan bahwa : </p><br>
                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Nama</span> <span style='display:inline-block;font-weight:bold'>: {!! $letter->medical_record->patient->patient_type . ' ' . $letter->medical_record->patient->name !!}</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Umur</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->age !!} Tahun</span></p>

                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Alamat</span> <span style='display:inline-block;width:150mm'>: {!! $letter->medical_record->patient->address !!} </span></p>


                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Tempat / tanggal lahir</span> <span style='display:inline-block;width:150mm'>: {!! @$letter->medical_record->patient->city->name . ' / ' . Mod::fullDate($letter->medical_record->patient->birth_date) !!} </span></p>


                <p style='padding-left:8mm'><span style='display:inline-block;width:40mm'>Pekerjaan</span> <span style='display:inline-block;'>: {!! $letter->medical_record->patient->job !!} </span></p><br>

                <p style="padding-left:8mm;text-align:justify">Berdasarkan hasil pemeriksaan pasien tersebut, pasien diminta untuk beristirahat selama {!! $letter->age !!} hari, dari tanggal {!! Mod::fullDate($letter->start_date) !!} s/d {!! Mod::fullDate($letter->end_date) !!}, diagnosa : {!! $letter->description !!}</p>
                <br>
                <p style="padding-left:8mm;text-align:justify">Demikian surat keterangan ini diberikan untuk diketahui dan dipergunakan dengan semestinya.</p><br><br>
                <p style='float:right;text-align:center;display:inline-block;display:inline-block'>
                    <span style="">
                        {!! $company->city . ', '. Mod::fullDate(date('Y-m-d'))  !!}<br>
                        Dokter yang merawat,<br><br><br><br>
                        <span style='display:inline-block;'>
                           ( <b>{!! $letter->doctor->name !!}</b> )
                        </span>
                    </span> 
                </p>
                <br>
                <br><br><br>
            </div>
                @include('pdf/letter_footer')
        </div>
 </div>
