<p style='position: absolute;bottom:10mm;width:100%;'>
    <span style="display:inline-block;margin-right:10mm">
        <img src="{{ asset('images/telephone.png') }}" style='height:3mm;width:auto'>
         {{ $company->phone_number ?? '' }}</span>

    <span style="display:inline-block;margin-right:10mm">
        <img src="{{ asset('images/telephone.png') }}" style='height:3mm;width:auto'>
         {{ $company->whatsapp_number ?? '' }}</span>
         
    <span style="display:inline-block;margin-right:10mm">
        <img src="{{ asset('images/earth.png') }}" style='height:3mm;width:auto'>
        {{ $company->website ?? '' }}
    </span>
    <span style="display:inline-block;margin-right:10mm">
        <img src="{{ asset('images/envelope.png') }}" style='height:3mm;width:auto'>
        {{ $company->email ?? '' }}
    </span>
</p>