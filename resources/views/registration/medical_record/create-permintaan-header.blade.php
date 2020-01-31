<ul class="nav nav-pills">
    @if( Specialization::allow_access('fnab') == 1)
        <li class='{{ strpos(url()->current(), "fnab") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "fnab") == null ? route("medical_record.edit.permintaan.fnab", ["id" => $id]) : "#" }}'>FNAB</a></li>
    @endif

    @if( Specialization::allow_access('histopatologi') == 1)
        <li class='{{ strpos(url()->current(), "histopatologi") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "histopatologi") == null ? route("medical_record.edit.permintaan.histopatologi", ["id" => $id]) : "#" }}'>Histopatologi</a></li>
    @endif

    @if( Specialization::allow_access('papsmear') == 1)
        <li class='{{ strpos(url()->current(), "papsmear") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "papsmear") == null ? route("medical_record.edit.permintaan.papsmear", ["id" => $id]) : "#" }}'>Papsmear</a></li>
    @endif

    @if( Specialization::allow_access('sitologi') == 1)
        <li class='{{ strpos(url()->current(), "sitologi") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "sitologi") == null ? route("medical_record.edit.permintaan.sitologi", ["id" => $id]) : "#" }}'>Sitologi</a></li>
    @endif

  </ul>