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

    .page-break {
        page-break-after: always;
    }
 </style>
 <div class="container" style='position:relative'>
     
        <div class="row" style='margin-top:4mm;'>
            <div style='border-bottom:1px solid black;margin-bottom:6mm;width:auto'>
                <div style='display:inline-block'>
                    <img src="{!! $company->logo2 !!}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm;width:120mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{!! $company->name !!}</b>
                    <p>{!! $company->address !!}</p>
                    <p>Telp : {!! $company->phone_number !!} Fax : {!! $company->fax !!}</p>
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
                            : {!! $medicalRecord->code !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div style="display:inline-block;width:45mm">
                            <b>Nama</b>
                        </div>
                        <div style="display:inline-block;width:150mm">
                            : {!! $medicalRecord->registration->patient->patient_type !!} {!! $medicalRecord->registration->patient->name !!}
                        </div>
                    </div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>Tanggal lahir</b>
                        </div>
                        <div style="display:inline-block;width:150mm">
                            : {!! Mod::fullDate($medicalRecord->registration->patient->birth_date) !!}
                        </div>
                    </div>
                    <div>
                        <div style="display:inline-block;width:45mm">
                            <b>Alamat</b>
                        </div>
                        <div style="display:inline-block;width:150mm">
                            : {!! $medicalRecord->registration->patient->address !!}
                        </div>
                    </div>
                </div>

                <p style='margin-top:3mm'>Datang dengan keluhan utama : {!! $medicalRecord->main_complaint !!}<br> Riwayat penyakit sekarang : {!! $medicalRecord->current_disease !!}.
                <?php if($medicalRecord->obgyn_main_complaint) { ?><br>
                <p>Keluhan (obgyn) : {!! $medicalRecord->obgyn_main_complaint !!}<?php }?></p>
                <p>Penyakit dahulu : {!! $medicalRecord->additional->riwayat_penyakit_dahulu !!}</p>
                <p>Hasil pemeriksaan didapatkan :</p>
                <?php if(array_key_exists("children_temperature",$medicalRecord->additional)) {?>
                <p style='margin-left:5mm'>TB : {!! $medicalRecord->additional->children_long !!} cm, Tensi : {!! $medicalRecord->additional->children_blood_pressure !!} mmHg, Suhu badan : {!! $medicalRecord->additional->children_temperature !!} <sup>o</sup>C</p>
                <p style='margin-left:5mm'>BB : {!! $medicalRecord->additional->children_weight !!} kg, Nadi : {!! $medicalRecord->additional->children_pulse !!} x/menit, Nafas : {!! $medicalRecord->additional->children_breath_frequency!!} x/menit</p><br>
                <?php } else {?>
                <p style='margin-left:5mm'>TB : {!! $medicalRecord->long !!} cm, Tensi : {!! $medicalRecord->blood_pressure !!} mmHg, Suhu badan : {!! $medicalRecord->temperature !!} <sup>o</sup>C</p>
                <p style='margin-left:5mm'>BB : {!! $medicalRecord->weight !!} kg, Nadi : {!! $medicalRecord->pulse !!} x/menit, Nafas : {!! $medicalRecord->breath_frequency!!} x/menit</p><br>
                <?php }?>
                <?php if($medicalRecord->physique) {?>
                <p>Pemeriksaan fisik : {!! $medicalRecord->physique !!}</p>
                <?php } if(array_key_exists("children_physique",$medicalRecord->additional)) {?>
                <p>Pemeriksaan fisik (anak) : {!! $medicalRecord->additional->children_physique !!}</p>
                <?php }?>
                <br>
                <div style='margin-bottom:2mm'>
                    <?php if(array_key_exists("laboratory_pivot",$medicalRecord->diagnostic)) { ?>
                    <p>Pemeriksaan tambahan :</p>                    
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->diagnostic as $unit4)
                            <li>{!! $unit4->item->name ?? '' !!} 
				<?php if($unit4->laboratory_pivot) { ?> (
				@foreach($unit4->laboratory_pivot["additional"]->treatment[0]->detail as $detdiag)
				<? if(array_key_exists("is_active",$detdiag)) {?>
				{!! $detdiag->name !!},
				<? }?>
                       		@endforeach
				<?php }?>
                            </li>
                       @endforeach
                    </ol><br>
                    <?php } ?>
                    <p style='margin-top:2mm'>Diagnosis :</p>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                     @foreach($medicalRecord->diagnose_history as $unit)
                        <li>{!! $unit->disease->name ?? $unit->additional->diagnose_name !!} (ket : {!!$unit->description!!})
                        </li>
                     @endforeach
                    </ol>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                     @foreach($medicalRecord->children_diagnose_history as $unit)
                        <li>{!! $unit->disease->name ?? $unit->additional->diagnose_name !!} (ket : {!!$unit->description!!})
                        </li>
                     @endforeach
                    </ol>

                    <br>
                    <?php if(count($medicalRecord->drug)>0) { ?>
                    <p>Terapi (Obat) : </p>                    
                    <ol style='margin-top:3mm;margin-left:6mm'>
                    @foreach($medicalRecord->drug as $unit)
                            <li>{!! $unit->item->name ?? ($unit->stock->item->name ?? '') !!} sebanyak {!! $unit->qty . ' ' . ($unit->item->piece->name ?? '') !!}, dosis : {!! ($unit->s1->name ?? '') .', '. ($unit->s2->name ?? '') !!}</li>
                    @endforeach
                    </ol><br>
                    <?php }?>
                    <!--
                    <p>Terapi (BHP) :</p>
                    <?php if($medicalRecord->bhp) { ?>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->bhp as $unit2)
                            <li>{!! $unit2->item->name ?? '' !!} sebanyak {!! $unit2->qty . ' ' . ($unit2->item->piece->name ?? '') !!}</li>
                       @endforeach
                    </ol><br>
                    <?php } else { ?>
                    <p>(tidak ada BHP yang diberikan)</p>
                    <?php } ?> -->                    
                    <?php if(count($medicalRecord->treatment)>0) { ?>
                    <p>Terapi (Tindakan) :</p>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->treatment as $unit3)
                            <li>{!! $unit3->item->name ?? '' !!}</li>
                       @endforeach
                    </ol><br>
                    <?php }?>
                    <?php if(count($medicalRecord->treatment_group)>0) { ?>
                    <p>Terapi (Paket Tindakan) :</p>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->treatment_group as $unit5)
                            <li>{!! $unit5->item->name ?? '' !!}</li>
                       @endforeach
                    </ol><br>
                    <?php } if($medicalRecord->ekg) {?>
                    <p>Bacaan EKG : {!! $medicalRecord->ekg ?? '' !!}</p>
                    <?php } if($medicalRecord->usg) {?>
                    <p>Hasil pemeriksaan penunjang : {!! $medicalRecord->usg ?? '' !!}</p>
                    <?php }?>
                    <br>
                    <p style='margin-top:3mm'>Jadwal kontrol selanjutnya pada hari {!! $medicalRecord->next_schedule->date ? Mod::day($medicalRecord->next_schedule->date) : $shortDot !!}, tanggal {!! $medicalRecord->next_schedule->date ? Mod::fullDate($medicalRecord->next_schedule->date) : $shortDot !!}</p>
                    <br>
                    <p>Keterangan :</p>
                    <div style='margin-top:3mm;'>
                        {!! $resume_description !!}
                    </div>
                </div>
                
                <div style='margin-top:1mm'>
                <p style='margin-bottom:14mm'>Surabaya, {!! Mod::fullDate($date) !!}</p>

                <p style='font-weight:bold;'>
                    <span style='border-bottom:1px solid black'>
                        {!! $medicalRecord->registration_detail->doctor->name !!}
                    </span>
                </p>
                <p >SPESIALIS {!! strtoupper($medicalRecord->registration_detail->doctor->specialization->name ?? '') !!}</p>
                </div>
                <br><br>
            </div>
        </div>       
        <div style='position:relative;margin-top:45mm'>   
                @include('pdf/letter_footer')    
        </div>
 </div>
         @if(($medicalRecord->additional->general_visual ?? false) OR ($medicalRecord->additional->head_visual ?? false) OR ($medicalRecord->additional->breast_visual ?? false) OR ($medicalRecord->additional->rectum_visual ?? false))

            <div class="page-break"></div>

            <div style='border-bottom:1px solid black;margin-bottom:6mm;width:auto'>
                <div style='display:inline-block'>
                    <img src="{!! $company->logo2 !!}" style='width:auto;height:20mm;' alt="">
                </div>
                <div style='display:inline-block;padding-bottom:3mm;padding-left:2mm;width:120mm'>
                    <b style='font-size:106%;text-transform:uppercase'>{!! $company->name !!}</b>
                    <p>{!! $company->address !!}</p>
                    <p>Telp : {!! $company->phone_number !!} Fax : {!! $company->fax !!}</p>
                </div>
            </div>

            @if($medicalRecord->additional->general_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Umum :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->general_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
            @if($medicalRecord->additional->head_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Kepala & Leher :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->head_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
            @if($medicalRecord->additional->breast_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Payudara :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->breast_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
            @if($medicalRecord->additional->rectum_visual ?? null)
                <div style='margin-top:1mm;width:50%;'>
                    <p>Pemeriksaan Rectum & Anal Canal :</p>
                    <div style='margin-top:5mm'>
                        <img style='width:auto;height:80mm;' src="{!! $medicalRecord->additional->rectum_visual ?? ''!!}"></img>
                    </div>
                </div>
            @endif
        @endif
 </div>