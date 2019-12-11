<ul class="nav nav-pills">
    <li class='{{ strpos(url()->current(), "general") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "general") == null ? route("medical_record.edit.physique.general", ["id" => $id]) : "#" }}'>Umum</a></li>

    <li  class='{{ strpos(url()->current(), "head") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "head") == null ? route("medical_record.edit.physique.head", ["id" => $id]) : "#" }}'>Kepala & leher</a></li>

    <li  class='{{ strpos(url()->current(), "breast") != null ? "active" : "" }}'>
        <a href='{{ strpos(url()->current(), "breast") == null ? route("medical_record.edit.physique.breast", ["id" => $id]) : "#" }}'>Breast(payudara)</a>
    </li>

    <li  class='{{ strpos(url()->current(), "rectum") != null ? "active" : "" }}'>
        <a href='{{ strpos(url()->current(), "rectum") == null ? route("medical_record.edit.physique.rectum", ["id" => $id]) : "#" }}'>Rectum & anal canal</a>
    </li>
  </ul>