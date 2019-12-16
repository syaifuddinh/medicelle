<ul class="nav nav-pills">
    <li class='{{ strpos(url()->current(), "treatment") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "treatment") == null ? route("medical_record.edit.therapy.treatment", ["id" => $id]) : "#" }}'>Tindakan</a>
    </li>
    <li class='{{ strpos(url()->current(), "diagnostic") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "diagnostic") == null ? route("medical_record.edit.therapy.diagnostic", ["id" => $id]) : "#" }}'>Diagnostik</a>
    </li>
    <li class='{{ strpos(url()->current(), "drug") != null ? "active" : "" }}'>
        <a href="{{ route('medical_record.edit.therapy.drug', ['id' => $id]) }}">Obat</a>
    </li>
  </ul>