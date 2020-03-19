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
     p, span, li {
        font-size:10px;
     }
 </style>
 <div class="container">
     
        <div class="row" style='margin-top:4mm;'>
            <div style='border-bottom:1px solid black;margin-bottom:6mm'>
                <div style='display:inline-block'>
                    <img src="{{ $company->logo }}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{{ $company->name }}</b>
                    <p>{{ $company->address }}</p>
                    <p>Telp : {{ $company->phone_number }} Fax : {{ $company->fax }}</p>
                </div>
            </div>

            <div class="col-md-12" style='padding-left:5.5mm'>
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:5mm'>PEMERIKSAAN SITOLOGI</p>
                <br>
                <br>
                <br>
                
                    <div style='display:inline-block;width:45%'>
                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:30mm'>
                                NAMA
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->patient->name }}</span>
                        </p>

                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:30mm'>
                                ALAMAT
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->patient->address }}</span>
                        </p>

                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:30mm'>
                                UMUR
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->patient->age }} Tahun</span>
                        </p>

                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:30mm'>
                                KELAMIN
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->patient->gender }}</span>
                        </p>

                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:30mm'>
                                NOMOR RM
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->code }}</span>
                        </p>

                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:30mm'>
                                NO. TLP
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->patient->phone }}</span>
                        </p>

                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:30mm'>
                                STATUS
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->patient->marriage_status }}</span>
                        </p>
                    </div>

                    <div style='display:inline-block;width:55%;padding-bottom:7mm'>
                        <p style='margin-bottom:7mm'>
                            DOKTER YANG MEMINTA :
                        </p>
                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:40mm'>
                                NAMA
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->registration_detail->doctor->name }}</span>
                        </p>
                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:40mm'>
                                POLI / RUANGAN
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->registration_detail->doctor->polyclinic->name }}</span>
                        </p>
                        <p style='margin-bottom:1mm'>
                            <span style='display:inline-block;width:40mm'>
                                NO. TELP
                            </span>
                            <span style='display:inline-block;'>:</span>
                            <span style='display:inline-block;margin-left:2mm'>{{ $medicalRecord->registration_detail->doctor->phone }}</span>
                        </p>
                    </div>
                
                <div>
                    <span style="display:inline-block;width:77mm">DIAGNOSA KLINIK</span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->sitologi_diagnose ?? $dot }}
                    </span>                    
                </div>
                <div>
                    <span style="display:inline-block;width:77mm">LOKASI PENGAMBILAN</span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->sitologi_lokasi ?? $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:77mm">
                        JUMLAH VOLUME (CC)    
                    </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->sitologi_volume ?? $dot }}
                    </span>
                          
                </div>
                
                <div>
                    <span style="display:inline-block;width:77mm">INFORMASI KLINIS LAIN </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->sitologi_description ?? $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:77mm">TANGGAL & WAKTU PENGAMBILAN BAHAN <b>(WAJIB DIISI)</b>  </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->sitologi_date ? Mod::fullDate($medicalRecord->additional->sitologi_date) : $dot }}
                    </span>
                </div>
                
                <div style='margin-top:10mm'>
                    <div style='width:60%;display:inline-block'></div>
                    <div style='width:40%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>................., ...............................</p>
                        <p style='text-align:center;'>(....................................)</p>
                    </div>
                </div>

                <div style='margin-top:10mm'>
                    <p>PEMERIKSAAN – PEMERIKSAAN SEBELUMNYA :</p>
                    <p style='margin-top:1mm'>NOMOR PATOLOGI ........................NOMOR SITOLOGI ........................... / LAB LAIN ........................................................................................................</p>
                    <p style='margin-top:1mm'>TAHUN ...........................................................................................................................................................................................................................................</p>
                    <p style='margin-top:1mm'>HASIL .............................................................................................................................................................................................................................................</p>
                </div>


                <div style='margin-top:5mm'>
                    <p style='margin-bottom:1.3mm'>DIISI OLEH PETUGAS <b>LABORATORIUM</b>:</p>
                    <p style='margin-bottom:1mm'>
                        FIKSASI ALKOHOL 50% , PUKUL :
                    </p>
                </div>


                @include('pdf/letter_footer')   
            </div>
        </div>
 </div>
