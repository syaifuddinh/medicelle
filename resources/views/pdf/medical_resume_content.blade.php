                <p style='margin-top:3mm'>Datang dengan keluhan utama : {!! $medicalRecord->main_complaint !!}<br> Riwayat penyakit sekarang : {!! $medicalRecord->current_disease !!}.
                <?php if($medicalRecord->obgyn_main_complaint) { ?><br>
                Keluhan (obgyn) : {!! $medicalRecord->obgyn_main_complaint !!}<?php }?><br>
                Penyakit dahulu : <br>
                <ol style='margin-top:3mm;margin-left:6mm'>
                   @foreach($medicalRecord->disease_history as $unit)
                        @if($unit->disease_name)
                            <li>{!! $unit->disease_name !!}</li>
                        @endif
                   @endforeach
                </ol>
                <br>
                <p>Hasil pemeriksaan didapatkan :</p>

                <p style='margin-left:5mm'>TB : {!! $medicalRecord->long !!} cm, Tensi : {!! $medicalRecord->blood_pressure !!} mmHg, Suhu badan : {!! $medicalRecord->temperature !!} <sup>o</sup>C</p>
                <p style='margin-left:5mm'>BB : {!! $medicalRecord->weight !!} kg, Nadi : {!! $medicalRecord->pulse !!} x/menit, Nafas : {!! $medicalRecord->breath_frequency!!} x/menit</p><br>
                <p>Pemeriksaan fisik : {!! $medicalRecord->physique !!}</p>
                <br>
                <div style='margin-bottom:2mm'>
                    <p>Pemeriksaan tambahan :</p>
                    <?php if($medicalRecord->diagnostic) { ?>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->diagnostic as $unit4)
                            <li>{!! $unit4->item->name ?? '' !!} 
				<?php if($unit4->laboratory_pivot) { ?> (
				@foreach($unit4->laboratory_pivot["additional"]->treatment[0]->detail as $detdiag)
				<? if(array_key_exists("is_active",$detdiag)) {?>
				{!! $detdiag->name !!},
				<? }?>
                       	@endforeach )
				<?php }?>
                            </li>
                       @endforeach
                    </ol><br>
                    <?php } else { ?>
                    <p>(tidak ada diagnostik yang diminta)</p>
                    <?php } ?>
                    <p style='margin-top:2mm'>Diagnosis :</p>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                     @foreach($medicalRecord->diagnose_history as $unit)
                        <li>{!! $unit->disease->name ?? $unit->additional->diagnose_name !!} (ket : {!!$unit->description!!})
                        </li>
                     @endforeach
                    </ol>
                    <br>
                    <p>Terapi (Obat) :</p>
                    <?php if($medicalRecord->drug) { ?>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->drug as $unit)
                            <li>{!! $unit->item->name ?? ($unit->stock->item->name ?? '') !!} sebanyak {!! $unit->qty . ' ' . ($unit->item->piece->name ?? '') !!}, dosis : {!! ($unit->s1->name ?? '') .', '. ($unit->s2->name ?? '') !!}</li>
                       @endforeach
                    </ol><br>
                    <?php } else { ?>
                    <p>(tidak ada obat yang diberikan)</p>
                    <?php } ?><!--
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
                    <p>Terapi (Tindakan) :</p>
                    <?php if($medicalRecord->treatment) { ?>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->treatment as $unit3)
                            <li>{!! $unit3->item->name ?? '' !!}</li>
                       @endforeach
                    </ol><br>
                    <?php } else { ?>
                    <p>(tidak ada tindakan yang dilakukan)</p>
                    <?php } ?>
                    <p>Terapi (Paket Tindakan) :</p>
                    <?php if($medicalRecord->treatment_group) { ?>
                    <ol style='margin-top:3mm;margin-left:6mm'>
                      @foreach($medicalRecord->treatment_group as $unit5)
                            <li>{!! $unit5->item->name ?? '' !!}</li>
                       @endforeach
                    </ol><br>
                    <?php } else { ?>
                    <p>(tidak ada paket tindakan yang dilakukan)</p>
                    <?php } ?>

                    <p>{!! $medicalRecord->usg ?? '' !!}</p>
                    <br>
                    <p style='margin-top:3mm'>Jadwal kontrol selanjutnya pada hari {!! $medicalRecord->next_schedule->date ? Mod::day($medicalRecord->next_schedule->date) : $shortDot !!}, tanggal {!! $medicalRecord->next_schedule->date ? Mod::fullDate($medicalRecord->next_schedule->date) : $shortDot !!}</p>
                    <br>
                    <p>Keterangan :</p>
                    <div style='margin-top:3mm;'>
                        {!! $resume_description !!}
                    </div>
                </div>
                
