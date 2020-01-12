<ul class="nav nav-pills">
    @if( Specialization::allow_access('umum') == 1)
        <li class='{{ strpos(url()->current(), "general") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "general") == null ? route("medical_record.edit.physique.general", ["id" => $id]) : "#" }}'>Umum</a></li>
    @endif

    @if( Specialization::allow_access('children') == 1)
        <li class='{{ strpos(url()->current(), "children") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "children") == null ? route("medical_record.edit.physique.children", ["id" => $id]) : "#" }}'>Anak</a></li>
    @endif

    @if( Specialization::allow_access('surgical') == 1)
        <li class='{{ strpos(url()->current(), "surgical") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "surgical") == null ? route("medical_record.edit.physique.surgical", ["id" => $id]) : "#" }}'>Bedah</a></li>
    @endif

    @if( Specialization::allow_access('kepala') == 1)
        <li  class='{{ strpos(url()->current(), "head") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "head") == null ? route("medical_record.edit.physique.head", ["id" => $id]) : "#" }}'>Kepala & leher</a></li>
    @endif

    @if( Specialization::allow_access('breast') == 1)
        <li  class='{{ strpos(url()->current(), "breast") != null ? "active" : "" }}'>
            <a href='{{ strpos(url()->current(), "breast") == null ? route("medical_record.edit.physique.breast", ["id" => $id]) : "#" }}'>Breast(payudara)</a>
        </li>
    @endif

    @if( Specialization::allow_access('rectum') == 1)
        <li  class='{{ strpos(url()->current(), "rectum") != null ? "active" : "" }}'>
            <a href='{{ strpos(url()->current(), "rectum") == null ? route("medical_record.edit.physique.rectum", ["id" => $id]) : "#" }}'>Rectum & anal canal</a>
        </li>
    @endif
  </ul>