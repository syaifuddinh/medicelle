<!DOCTYPE html>
<html>
    <head>
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

         p, span, li, td, th, div {
            font-size:11px;
         }

         th, td {
            padding:1mm;
         }
        
         table {
            width:100%
         }

         .w30 {
            width:30mm;
         }
         .inline-block {
            display:inline-block;
         }
         .mb1 {
            margin-bottom:1mm;
         }
         .page-break {
            page-break-after: always;
        }
     </style>
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    <td>
                        @foreach($contacts as $c => $contact)
                            <div style='text-align:center;padding-top:18mm'>
                                @php
                                    $bar = App::make('BarCode');
                                    $barcodes = [
                                        'text' => $contact->medical_record->code,
                                        'size' => 30,
                                        'orientation' => 'horizontal',
                                        'code_type' => 'code39',
                                        'print' => true,
                                        'sizefactor' => 1,
                                        'filename' => "barcodeKartuPasien{$c}.jpeg",

                                    ];
                                    $barImg = $bar->barcodeFactory()->renderBarcode(
                                        $text=$barcodes["text"], 
                                        $size=$barcodes['size'], 
                                        $orientation=$barcodes['orientation'], 
                                        $code_type=$barcodes['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar 
                                        $print=$barcodes['print'], 
                                        $sizefactor=$barcodes['sizefactor'],
                                        $filename = $barcodes['filename'],
                                    )->filename($barcodes['filename']);

                                    $barImg = url($barImg);
                                @endphp
                                <img src="{{ $barImg }}" alt="barcode kartu pasien">
                            </div>
                            <div style='padding-top:2mm;margin-left:1mm'>
                                <h3>{{ $contact->name }}</h3>
                                <p>{{ $contact->birth_date ? Mod::fullDate($contact->birth_date) : '' }}</p>
                                <p>{{ $contact->address }}</p>
                            </div>
                            @if($c != count($contacts) - 1)
                                <div class="page-break"></div>
                            @endif
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>

