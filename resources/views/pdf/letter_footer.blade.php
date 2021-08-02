<p style='position: absolute;bottom:10mm;width:auto;'>
    <span style="display:inline-block;margin-right:8mm;width:250px">
        <img src="{!! asset('images/telephone.png') !!}" style='height:2.5mm;width:auto'>
         {!! $company->phone_number ?? '' !!}
     </span>
    <span style="display:inline-block;margin-right:12mm">
        <img src="{!! asset('images/telephone.png') !!}" style='height:2.5mm;width:auto'>
         {!! $company->whatsapp_number ?? '' !!}</span>
         
    <span style="display:inline-block;margin-right:12mm">
        <img src="{!! asset('images/earth.png') !!}" style='height:2.5mm;width:auto'>
        {!! $company->website ?? '' !!}
    </span>
    <span style="display:inline-block;margin-right:12mm">
        <img src="{!! asset('images/envelope.png') !!}" style='height:2.5mm;width:auto'>
        {!! $company->email ?? '' !!}
    </span>
</p>