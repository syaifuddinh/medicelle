<ul class="nav nav-pills">
    @if( Specialization::allow_access('diagnostik') == 1)
        <li class='{{ strpos(url()->current(), "diagnostic") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "diagnostic") == null ? route("medical_record.edit.therapy.diagnostic", ["id" => $id]) : "#" }}'>Diagnostik</a>
        </li>
    @endif

    @if( Specialization::allow_access('obat') == 1)
        <li class='{{ strpos(url()->current(), "drug") != null ? "active" : "" }}'>
            <a href="{{ route('medical_record.edit.therapy.drug', ['id' => $id]) }}">Obat</a>
        </li>
    @endif
    <li class='{{ strpos(url()->current(), "treatment_group") != null ? "active" : "" }}'>
        <a href="{{ route('medical_record.edit.therapy.treatment_group', ['id' => $id]) }}">Paket Tindakan</a>
    </li>
  </ul>