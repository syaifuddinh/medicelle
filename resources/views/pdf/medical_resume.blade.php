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
 </style>
 <div class="container">
     
        <div class="row" style='margin-top:4mm;'>
            <div style='border-bottom:1px solid black;margin-bottom:6mm;width:auto'>
                <div style='display:inline-block'>
                    <img src="{{ $company->logo2 }}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm;width:120mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{{ $company->name }}</b>
                    <p>{{ $company->address }}</p>
                    <p>Telp : {{ $company->phone_number }} Fax : {{ $company->fax }}</p>
                </div>
            </div>

            <div class="col-md-12" style='padding-left:5.5mm'>
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:5mm'>RESUME MEDIS</p>
                <div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>No Rekam Medis</b>
                        </div>
                        <div style="display:inline-block;">
                            : {{ $medicalRecord->code }}
                        </div>
                    </div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>Nama</b>
                        </div>
                        <div style="display:inline-block;">
                            : {{ $medicalRecord->registration->patient->patient_type }} {{ $medicalRecord->registration->patient->name }}
                        </div>
                    </div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>Tanggal lahir</b>
                        </div>
                        <div style="display:inline-block;">
                            : {{ Mod::fullDate($medicalRecord->registration->patient->birth_date) }}
                        </div>
                    </div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>Alamat</b>
                        </div>
                        <div style="display:inline-block;">
                            : {{ $medicalRecord->registration->patient->address }}
                        </div>
                    </div>
                </div>

                <p style='margin-top:3mm'>Datang dengan keluhan utama {{ $medicalRecord->main_complaint ?? $dot }}, riwayat penyakit sekarang {{ $medicalRecord->current_disease ?? $dot }}.</p>
                <p>Keluhan (obgyn) : {{ $medicalRecord->obgyn_main_complaint ?? $dot }}</p>
                <p>Penyakit dahulu :</p>
                <ol style='margin-top:3mm;margin-left:6mm'>
                   @foreach($medicalRecord->disease_history as $unit)
                        <li>{{ $unit->disease_name }}</li>
                   @endforeach
                </ol>
                <br>
                <p>Pemeriksaan fisik didapatkan :</p>
                <p>Tensi : {{ $medicalRecord->blood_pressure ?? $shortDot }} mmHg, Nadi : {{ $medicalRecord->pulse ?? $shortDot }} x/menit, Suhu badan : {{ $medicalRecord->temperature ?? $shortDot }} <sup>o</sup>C, Nafas : {{ $medicalRecord->breath_frequency ?? $shortDot }} x/menit</p>
                <p>Keterangan : {{ $medicalRecord->physique }}</p>
                <br>
                <p>Diagnosis :</p>
                <ol style='margin-top:3mm;margin-left:6mm'>
                    @foreach($medicalRecord->diagnose_history as $unit)
                        <li>{{ $unit->disease->name ?? '' }}</li>
                   @endforeach
                </ol>
                <br>
                <p>{{ $medicalRecord->usg ?? '' }}</p>
                <br>
                <div style='margin-bottom:5mm'>
                    <p>Terapi :</p>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->drug as $unit)
                            <li>{{ $unit->item->name ?? '' }} sebanyak {{ $unit->qty . ' ' . ($unit->item->piece->name ?? '') }}</li>
                       @endforeach
                    </ol>
                    <p style='margin-top:3mm'>Jadwal kontrol selanjutnya pada hari {{ $medicalRecord->next_schedule->date ? Mod::day($medicalRecord->next_schedule->date) : $shortDot }}, tanggal {{ $medicalRecord->next_schedule->date ? Mod::fullDate($medicalRecord->next_schedule->date) : $shortDot }}</p>
                    <br>
                    <p>Keterangan :</p>
                    <div style='margin-top:3mm;'>
                        {{ $resume_description }}
                    </div>
                </div>
                <div style='margin-top:1mm'>
                    <p>Visual :</p>
                    <div style='margin-top:1mm'>
                        <img style='width:auto;height:100mm;' src="{{ $medicalRecord->additional->breast_visual ?? ''}}"></img>
                    </div>
                </div>
                <div style='margin-top:1mm'>
                <p style='margin-bottom:14mm'>Surabaya, {{ Mod::fullDate($date) }}</p>

                <p style='font-weight:bold;'>
                    <span style='border-bottom:1px solid black'>
                        {{ $medicalRecord->registration_detail->doctor->name }}
                    </span>
                </p>
                <p >SPESIALIS {{ strtoupper($medicalRecord->registration_detail->doctor->specialization->name ?? '') }}</p>
                </div>
                <br><br>
               @include('pdf/letter_footer')    
            </div>
        </div>
 </div>
