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
     th {
        font-weight:bold;
     }
     table {
        border-bottom:1px double black;
     }

     .text-right {
        text-align:right;
     }

     .text-center {
        text-align:center;
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
                    <div style='text-align:center;display:inline-block;width:100%;margin-bottom:10mm;text-align:center;'>
                        <h3 style='font-weight:bold;'><span>PURCHASE REQUEST</span></h3>
                    </div>
                    <div style='display:inline-block;width:80%;'>
                        <div style='margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:45mm'>No. Purchase Request</span>
                            <span style='display:inline-block;font-weight:bold;font-size:110%'>: {{ $purchaseRequest->code }}</span>
                        </div>

                        <div style='margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:45mm'>Tanggal</span>
                            <span style='display:inline-block'>: {{ Mod::fullDate($purchaseRequest->date) }}</span>
                        </div>

                        <div style='margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:45mm'>Periode</span>
                            <span style='display:inline-block'>: {{  Mod::fullDate($purchaseRequest->date_start) }} s/d  {{ Mod::fullDate($purchaseRequest->date_end) }} </span>
                        </div>

                        <div style='margin-bottom:0.6mm'>
                            <span style='display:inline-block;width:45mm'>Keterangan</span>
                            <span style='display:inline-block'>: {{ $purchaseRequest->description }}</span>
                        </div>
                    </div>
                   
                </div>
                <br>
                <table style='width:100%' cellpadding='2' cellspacing='0'>
                    <thead>
                        <tr>        
                            <th>Barang</th>
                            <th>Supplier</th>
                            <th class='text-center' style='width:12mm'>Jumlah Permintaan</th>
                            <th class='text-center' style='width:10mm'>Jumlah Terpakai</th>
                            <th style='width:40mm'>Harga Beli</th>
                            <th style='width:10mm'>Diskon</th>
                            <th style='width:10mm'>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchaseRequest->detail as $i => $detail)
                            <tr>
                                <td>
                                    {{ $detail->item->name ?? '' }}
                                </td>
                                <td>
                                    {{ $detail->supplier->name ?? '' }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($detail->qty ?? 0) }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($detail->used_qty ?? 0) }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($detail->purchase_price ?? 0) }}
                                </td>
                                <td class="text-right">
                                    {{ $detail->discount ?? 0 }}%
                                </td>
                                <td class="text-right">
                                    {{ number_format($detail->subtotal ?? 0) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6" style='text-align:left'>
                                Grandtotal
                            </th>
                            <th class="text-right">
                                {{  number_format($grandtotal ?? 0) }}
                            </th>
                        </tr>
                    </tfoot>
                </table>

                <div style='position:absolute;bottom:28mm'>
                    <div style='display:inline-block;position:relative'>
                        <span style='display:inline-block;'>
                            
                            <p style='text-align:center;margin-bottom:25mm;width:210%'>Petugas</p>
                            <p style='text-align:center;width:210%'>( {{$purchaseRequest->draft->user->name ?? $dot}} )</p>
                        </span>
                    </div>
                </div>
        
                <div style='position:absolute;bottom:28mm;left:90mm'>
                    <div style='display:inline-block;position:relative'>
                        <span style='display:inline-block;'>
                            
                            <p style='text-align:center;margin-bottom:25mm;width:210%'>APJ</p>
                            <p style='text-align:center;width:210%'>( {{$purchaseRequest->apj->user->name ?? $dot}} )</p>
                        </span>
                    </div>
                </div>
        
                <div style='position:absolute;bottom:28mm;left:180mm'>
                    <div style='display:inline-block;position:relative'>
                        <span style='display:inline-block;'>
                            
                            <p style='text-align:center;margin-bottom:25mm;width:210%'>Disetujui Oleh</p>
                            <p style='text-align:center;width:210%'>( {{$purchaseRequest->direktur->user->name ?? $dot}} )</p>
                        </span>
                    </div>
                </div>
        
                @include('pdf/letter_footer')        
            </div>
        </div>
 </div>