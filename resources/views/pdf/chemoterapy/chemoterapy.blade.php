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
        padding:1mm;
     }
     .text-center {
        text-align:center;
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
                <div>
                    <span style='width:50%;display:inline-block'>
                        <div>
                            <span style='width:20mm;display:inline-block'>Nama</span>
                            <span style='display:inline-block;width:2mm'>:</span>
                            <span style='display:inline-block;'>{{ $medicalRecord->patient->name }}</span>
                        </div>
                        <div>
                            <span style='width:20mm;display:inline-block'>Tanggal lahir</span>
                            <span style='display:inline-block;width:2mm'>:</span>
                            <span style='display:inline-block;'>{{ Mod::fullDate($medicalRecord->patient->birth_date) }}</span>
                        </div>
                    </span>
                    <span style='width:50%;display:inline-block'>
                        <div>
                            <span style='width:20mm;display:inline-block'>Alamat</span>
                            <span style='display:inline-block;width:2mm'>:</span>
                            <span style='display:inline-block;'>{{ $medicalRecord->patient->address }}</span>
                        </div>
                        <div>
                            <span style='width:20mm;display:inline-block'>Regimen</span>
                            <span style='display:inline-block;width:2mm'>:</span>
                            <span style='display:inline-block;'>{{ $shortDot }}</span>
                        </div>
                    </span>
                </div>
                <div style='text-align:center;margin-bottom:2mm'>
                    <h6>MONITORING DAN EFEK SAMPING PASIEN KEMOTERAPI</h6>
                </div>

                <div>   
                    <table border='1' cellspacing='0' style='width:100%'>
                        <tr>
                            <td colspan='6'>Diisi oleh Dokter dan Perawat</td>
                        </tr>
                        <tr>
                            <td colspan='6'>
                                <span style='display:inline-block;width:50%'>
                                    <b>Tanggal : {{ $shortDot }}</b>
                                </span>
                                <span style='display:inline-block;width:50%'>
                                    <b>Siklus : {{ $shortDot }}</b>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' style='text-align:center'>
                                <b>KEADAAN UMUM PASIEN</b>
                            </td>
                        </tr>

                        <tr>    
                            <td colspan='2' class='text-center'>Tanda-tanda vital</td>
                            <td class='text-center'>Jam : {{ $shortDot }}<br>Pre</td>
                            <td class='text-center'>Jam : {{ $shortDot }}<br>Durante I</td>
                            <td class='text-center'>Jam : {{ $shortDot }}<br>Durante II</td>
                            <td class='text-center'>Jam : {{ $shortDot }}<br>Post</td>
                        </tr>
                        @foreach($keadaanUmum AS $unit)
                            <tr>    
                                <td colspan='2'>{{ $unit->name }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan='6' style='text-align:center'>
                                <b>EFEK SAMPING</b>
                            </td>
                        </tr>
                        @foreach($sideEffects AS $sideEffect)
                            @foreach($sideEffect->detail AS $key => $detail)
                                <tr>    
                                    @if($key == 0)
                                            <td rowspan='{{ count($sideEffect->detail) }}'>
                                                <b>{{ $sideEffect->name }}</b>
                                            </td>
                                    @endif
                                    <td>{{ $detail->name }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach                        
                        @endforeach
                        <tr>
                            <td style='height: 15mm' colspan="2" class='text-center'>
                                <b>TANDA TANGAN PENERIMA</b>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>

                <div style='position:absolute;bottom:68mm'>
                    <span style='width:49%;display:inline-block'>
                        
                    </span>
                    <span style='width:49%;display:inline-block'>
                        <p class='text-center'>Tanggal {{ Mod::today() }}, Jam {{ Carbon\Carbon::now()->format('H:i') }} WIB</p>
                    </span>
                    
                </div>
                <div style='position:absolute;bottom:28mm'>
                    <span style='width:49%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>Nama dan Tanda Tangan Petugas DPJP</p>
                        <p style='text-align:center;'>{{ $dot }}</p>
                    </span>
                    <span style='width:49%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>Nama dan Tanda Tangan Petugas Kemoterapi</p>
                        <p style='text-align:center;'>{{ $dot }}</p>
                    </span>
                    
                </div>

                @include('pdf/letter_footer')   
            </div>
        </div>
 </div>
