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

     th, td {
        border-top:1px solid black;
        padding:0.9mm;
     }
     table {

        border-bottom:1px double black;
     }

 </style>
 <div class="container">
     
        <div class="row" style='margin-top:4mm;'>
            <div style='margin-bottom:6mm'>
                <div style='display:inline-block'>
                    <img src="{{ $company->logo }}" style='width:auto;height:20mm;' alt="">
                    <p style='font-size:85%'>{{ $company->address }}</p>
                </div>
            </div>

            <div class="col-md-12" style='padding-left:5.5mm'>
                <div class="header">
                    <div style='text-align:center;display:inline-block;width:40%'></div>
                    <div style='text-align:center;display:inline-block;width:20%'>
                        
                        <h3 style='font-weight:bold;'><span>KWITANSI <br>RAWAT JALAN</span></h3>
                    </div>
                    <div style='display:inline-block;width:40%;'>
                        <div style='padding-left:13mm;margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:17mm'>No. Nota</span>
                            <span style='display:inline-block;font-weight:bold;font-size:110%'>: {{ $data['invoice']->code }}</span>
                        </div>

                        <div style='padding-left:13mm;margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:17mm'>Tanggal</span>
                            <span style='display:inline-block'>: {{ Mod::fullDate($data['invoice']->date) }}</span>
                        </div>

                        <div style='padding-left:13mm;margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:17mm'>Register</span>
                            <span style='display:inline-block'>: {{ $registration->code }}</span>
                        </div>

                        <div style='padding-left:13mm;margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:17mm'>No. RM</span>
                            <span style='display:inline-block'>: {{ $registration->medical_record->code }}</span>
                        </div>


                        <div style='padding-left:13mm;margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:17mm'>Telp.</span>
                            <span style='display:inline-block'>: {{ $registration->patient->phone }}</span>
                        </div>
                    </div>
                   
                </div>
                <br>
                <table style='width:100%' cellpadding='2' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Diskripsi</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['invoice_detail'] as $grup_nota => $payment)
                                <?php $subtotal = 0; ?>
                                <tr>
                                    <td colspan="6">
                                        <b>{{ $grup_nota }}</b>
                                    </td>
                                </tr>
                                @foreach($payment as $detail)
                                    <?php $subtotal += $detail->total_debet - $detail->reduksi_reference->total_credit - $detail->discount_reference->total_credit + $detail->asuransi_reference->total_debet; ?>
                                    <tr>
                                        <td>{{ $detail->item->unique_code }}</td>
                                        <td>{{ $detail->item->name }}</td>
                                        <td style='text-align: right'>{{ $detail->qty }}</td>
                                        <td>{{ $detail->item->piece->name ?? '-' }}</td>
                                        <td style='text-align: right'>{{ number_format($detail->debet - $detail->reduksi_reference->credit - $detail->discount_reference->credit) }}</td>
                                        <td style='text-align: right'>{{ number_format($detail->total_debet - $detail->reduksi_reference->total_credit - $detail->discount_reference->total_credit + $detail->asuransi_reference->total_debet) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" style='text-align: right'>
                                        <?php echo number_format($subtotal); ?>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style='position:relative;margin-top:2mm;padding-bottom:1mm;border-bottom:1px solid black'>
                    <p>Terbilang : # {{ Mod::readMoney($data['invoice']->netto) }} rupiah #</p>
                    <div style='margin-top:9mm'>
                        <span style='width:30%;display:inline-block'>
                            <p style='margin-bottom:13mm;text-align:center'>Kasir Customer Service</p>
                            <p style='text-align:center'>( {{$data['invoice']->teller->name}} )</p>
                        </span>
                        <span style='width:30%;display:inline-block'>
                            <p style='margin-bottom:13mm;text-align:center'>Pasien</p>
                            <p style='text-align:center'>( {{$registration->patient->name}} {{ $registration->patient->patient_type ? ', ' . $registration->patient->patient_type : ''  }}  )</p>
                        </span>
                    </div>
                    <div style='border:1px solid black;padding:2mm 4mm;display:inline-block;font-size:90%'>
                        <b>Keterangan : Nota ini bukti pembayaran tindakan setelah registrasi</b>
                    </div>
                    <div style='display:inline-block;position:absolute;top:0;right:0;font-size:85%'>
                        <div>
                            <span style='display:inline-block;width:25mm'>
                                <b>SUB TOTAL</b>
                            </span>
                            <span style='display:inline-block'>:</span>
                            <span style='display:inline-block;width:30mm;text-align:right'>
                                <b>{{ number_format($data['invoice']->gross - $data['invoice']->reduksi + $data['invoice']->asuransi_value) }}</b>
                            </span>
                        </div>
                        <div style='padding-bottom:2mm;padding-top:1mm;border-bottom:1px solid black'>
                            <span style='display:inline-block;width:25mm'>
                                <b>DISKON</b>
                            </span>
                            <span style='display:inline-block'>:</span>
                            <span style='display:inline-block;width:30mm;text-align:right'>
                                <b>{{ number_format($data['invoice']->discount + $data['invoice']->massive_discount->total_credit + $data['invoice']->promo->total_credit) }}</b>
                            </span>
                        </div>
                        <div style='padding-top:3mm'>
                            <span style='display:inline-block;width:25mm'>
                                <b>TOTAL</b>
                            </span>
                            <span style='display:inline-block'>:</span>
                            <span style='display:inline-block;width:30mm;text-align:right'>
                                <b>{{ number_format($data['invoice']->netto) }}</b>
                            </span>
                        </div>
                        <div  style='padding-bottom:2mm;padding-top:1mm;border-bottom:1px solid black'>
                            <span style='display:inline-block;width:25mm'>
                                <b>DIBAYAR</b>
                            </span>
                            <span style='display:inline-block'>:</span>
                            <span style='display:inline-block;width:30mm;text-align:right'>
                                <b>{{ number_format($data['invoice']->paid) }}</b>
                            </span>
                        </div>
                        <div  style='padding-top:3mm'>
                            <span style='display:inline-block;width:25mm'>
                                <b>KEMBALI</b>
                            </span>
                            <span style='display:inline-block'>:</span>
                            <span style='display:inline-block;width:30mm;text-align:right'>
                                <b>{{ number_format($data['invoice']->paid - $data['invoice']->netto) }}</b>
                            </span>
                        </div>
                    </div>
                </div>
                <p style='margin-top:1mm'>Tanggal : {{ Mod::now() }}</p>
        
                @include('pdf/letter_footer')        
            </div>
        </div>
 </div>