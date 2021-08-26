<?php 
    $company = Mod::company();
    //$treatments = json_decode($treatments);
 ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <style>
     * {
        margin:0;
        padding:0;
     }
     .container {
        padding:7mm;
        zoom:1.21;
        font-size:14pt;
     }
     li {
        padding-left:10mm
     }

     th, td {
        padding:1.5mm;
     }

     p, span, li {
        font-size:14pt;
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
        width:100%;
        font-size:14pt;
     }
 </style>
 <div class="container">
     
        <div class="row" style='margin-top:4mm;'><!--
            <div style='border-bottom:1px solid black;margin-bottom:6mm'>
                <div style='display:inline-block'>
                    <img src="{!! $company->logo !!}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{!! $company->name !!}</b>
                    <p>{!! $company->address !!}</p>
                    <p>Telp : {!! $company->phone_number !!} Fax : {!! $company->fax !!}</p>
                </div>
            </div>-->
            <div class="col-md-12" style='padding-left:5.5mm;margin-bottom:7mm;margin-top:25mm;'>
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:10mm'>LABORATORIUM KLINIK</p>
                <div style='border-bottom:1px solid black;margin-bottom:7mm;text-transform:uppercase;font-weight:bold'>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>No RM</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->code !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:400mm'>
                        <span class="ib" style='width:60mm'>Nama</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:300mm'>{!! $medicalRecord->patient->name !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:400mm'>
                        <span class="ib" style='width:60mm'>Alamat</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:300mm'>{!! $medicalRecord->patient->address !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Jenis Kelamin</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->patient->gender !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Umur</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->patient->age !!} Tahun</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Tanggal Periksa</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! Mod::fullDate($medicalRecord->date) !!}</span>
                    </p>
                    <p style='margin-bottom:1.2mm;width:300mm'>
                        <span class="ib" style='width:60mm'>No Telp</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->patient->phone !!}</span>
                    </p>
                </div>
                <div style='border-bottom:1px solid black;margin-bottom:10mm;text-transform:uppercase;font-weight:bold'>
                    <p style='margin-bottom:7mm'>DOKTER YANG MEMINTA :</p>
                    <p style='margin-bottom:1.2mm;width:400mm'>
                        <span class="ib" style='width:60mm'>Nama Lengkap</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:300mm'>{!! $medicalRecord->registration_detail->doctor->name !!}</span>
                    </p>
                    <p style='margin-bottom:5mm;width:300mm'>
                        <span class="ib" style='width:60mm'>Poli/Ruangan</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:100mm'>{!! $medicalRecord->registration_detail->doctor->polyclinic->name !!}</span>
                    </p>
                </div>
                <div style='border-bottom:1px solid black;margin-bottom:10mm;text-transform:uppercase;font-weight:bold'>
                    <p style='margin-bottom:1.2mm'>DOKTER PENANGGUNG JAWAB :</p>
                    <p style='margin-bottom:5mm;width:400mm'>
                        <span class="ib" style='width:60mm'>Nama Lengkap</span>
                        <span class="ib"> : </span>
                        <span class="ib" style='width:300mm'>{!!$contact_name!!}</span>
                    </p>
                </div>              
                <div>
                    <table border='1' cellspacing='0'>
                        <thead>
                            <tr>
                                <th>PEMERIKSAAN</th>
                                <th>HASIL</th>
                                <th>SATUAN</th>
                                <th>NILAI NORMAL</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($treatments as $treatment)
					<? $additional = json_decode($treatment->additional);?>
					 @foreach($additional->treatment as $adtreatment)
                                        @foreach($adtreatment->detail as $detail)
                                        @if(($detail->is_active ?? 0) == 1)
                                        <tr>
                                            <td>{!! $detail->name !!}</td>
                                            <td>{!! $detail->hasil ?? '' !!}</td>
                                            <td>{!! $detail->satuan ?? '' !!}</td>
                                            <td>{!! $detail->nilai_normal ?? '' !!}</td>
                                            <td>{!! $detail->keterangan ?? '' !!}</td>
                                        </tr>
                                        @endif
                                        @endforeach
					@endforeach
                            @endforeach
                         </tbody>
                    </table>
                </div>
    
                <div style='margin-top:50mm;width:100%'>
                    <div style='width:60%;display:inline-block'></div>
                    <div style='width:170%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>{!! Mod::company()->city !!}, {!! Mod::fullDate($medicalRecord->date) !!}</p>
                        <p style='text-align:center;'>(....................................)</p>
                    </div>
                </div>

            </div>
        </div>
 </div>
