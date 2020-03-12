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

     p, span, li, td, th {
        font-size:11px;
     }

     th, td {
        padding:1mm;
     }

     table {
        width:100%
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
                <p style='text-align:center;font-weight:bold;font-size:101%;margin-bottom:15mm'>COPY RESEP</p>
            
                
                
                <div style='margin-bottom:5mm'>
                    <table cellpadding='1' cellspacing='0' border='1'>
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Lokasi</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th style='width:12mm'>Jumlah Permintaan</th>
                                <th style='width:10mm'>Stok</th>
                                <th style='width:17mm'>Satuan</th>
                                <th style='width:40mm'>Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formula->detail as $detail)
                                <tr>
                                    <td>{{ $detail->item->name }}</td>
                                    <td>{{ $detail->lokasi->name }}</td>
                                    <td>{{ Mod::fullDate($detail->stock->expired_date) }}</td>
                                    <td style="text-align:right">{{ number_format(1) }}</td>
                                    <td style="text-align:right">{{ number_format($detail->stock->qty) }}</td>
                                    <td>{{ $detail->item->piece->name }}</td>
                                    <td style="text-align:right">{{ number_format($detail->item->price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style='margin-top:10mm'>
                    <div style='width:60%;display:inline-block'></div>
                    <div style='width:40%;display:inline-block'>
                        <p style='text-align:center;margin-bottom:25mm'>{{ Mod::company()->city }}, {{ Mod::today() }}</p>
                        <p style='text-align:center;'>( {{ $formula->contributor->name }} )</p>
                    </div>
                </div>

                @include('pdf/letter_footer')   
            </div>
        </div>
 </div>
