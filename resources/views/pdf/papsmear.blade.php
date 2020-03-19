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
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:5mm'>PEMERIKSAAN PAPSMEAR / VAGINAL SMEAR</p>
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
                    <span style="display:inline-block;margin-right:1mm">HARI PERTAMA HAID TERAKHIR / MENOPAUSE</span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                         {{ Mod::fullDate($medicalRecord->hpht) ?? $dot }}
                    </span>                    
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">RIWAYAT KONTRASEPSI</span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->papsmear_kontrasepsi ?? $dot }}
                    </span>                    
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">RIWAYAT VAKSINASI</span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->riwayat_vaksinasi ?? $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">
                        RIWAYAT PAPSMEAR(TANGGAL & HASIL)    
                    </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->obgyn_papsmear ?? $dot }}
                    </span>
                          
                </div>
                
                <div>
                    <span style="display:inline-block;width:54mm">KELUHAN SAAT INI</span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->papsmear_keluhan ?? $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">TANGGAL PENGAMBILAN PAPSMEAR  </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ null != ($medicalRecord->additional->papsmear_date ?? null) ? Mod::fullDate($medicalRecord->additional->papsmear_date) : $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">JUMLAH SLIDE PAPSMEAR  </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->papsmear_jumlah_slide ?? $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">LOKASI PENGAMBILAN  </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->papsmear_lokasi ?? $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">GAMBARAN PORTIO CERVIX / VAGINA  </span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->papsmear_cervix ?? $dot }}
                    </span>
                </div>
                <div>
                    <span style="display:inline-block;width:54mm">INFORMASI KLINIS LAIN</span>
                    <span style="display:inline-block;">:</span>
                    <span style="display:inline-block;margin-left:1mm">
                        {{ $medicalRecord->additional->papsmear_description ?? $dot }}
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
                    <p style='margin-bottom:1.3mm'>DIISI OLEH PETUGAS :</p>
                    <p style='margin-bottom:1mm'>
                        NOMOR LABORATORIUM : ....................................TGL TERIMA .........................................TGL HASIL .......................................
                    </p>
                </div>


                @include('pdf/letter_footer')   
            </div>
        </div>
 </div>
