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

     p, span, li, td {
        font-size:10px;
     }

     td {
        padding:1.5mm;
        border:1px solid black;
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
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:15mm'>PEMERIKSAAN LABORATORIUM</p>
            
                
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
                    
                    <p style='margin-bottom:1mm;padding:3mm;border:1px solid black;margin-bottom:5mm'>
                        DIAGNOSA : {{ $dot . $dot . $shortDot}}........................
                    </p>

                    <div style='margin:0'>
                        <?php 
                            $laboratoryType = $laboratoryType->chunk( Mod::laboratory()->grid_amount );
                         ?>

                         <table cellspacing='0' cellpadding='8' style='width:100%'>
                            <tbody>
                                @foreach($laboratoryType as $unit)
                                    <tr>
                                        @foreach($unit as $value)
                                            <td>
                                                <?php 
                                                        $selected = [];
                                                        foreach($pivotMedicalRecord->additional->treatment as $treatment) {
                                                            if($treatment->id == $value->id) {
                                                                $selected = $treatment->detail;
                                                            }
                                                        }
                                                 ?>
                                                <p style='margin-bottom:2mm'>{{ $value->name }}</p>
                                                @foreach($value->laboratory_type_detail as $detail)
                                                    <p>
                                                        <?php 
                                                            $checked = '';
                                                            foreach($selected as $unit) {
                                                                if( (strtolower($unit->name) == strtolower($detail->name) || $unit->id == $detail->id) && 1 == ($unit->is_active ?? null)) {
                                                                    $checked = 'checked';
                                                                }
                                                            }
                                                         ?>
                                                        <input type="checkbox" style='margin-right: 1mm' {{ $checked }}>
                                                        <span style="display: inline-block;padding-bottom:1mm">
                                                              {{ $detail->name }}
                                                        </span>
                                                    </p>
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                         </table>
                    </div>
                
                <div style='margin-top:10mm'>
                    <div style='width:60%;display:inline-block'></div>
                    <div style='width:40%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>{{ Mod::company()->city }}, {{ Mod::fullDate($pivotMedicalRecord->medical_record_detail->date) }}</p>
                        <p style='text-align:center;'>( {{$medicalRecord->registration_detail->doctor->name}} )</p>
                    </div>
                </div>

                @include('pdf/letter_footer')   
            </div>
        </div>
 </div>
