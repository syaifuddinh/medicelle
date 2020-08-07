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
                            <div>
                                {!! QrCode::size(50)->generate($contact->medical_record->code); !!}
                            </div>
                            <div style='padding-top:15mm;'>
                                <p>{{ $contact->medical_record->code }}</p>
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

