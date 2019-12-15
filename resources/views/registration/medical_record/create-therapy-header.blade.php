<ul class="nav nav-pills">
    <li class='{{ strpos(url()->current(), "treatment") != null ? "active" : "" }}'><a href='{{ strpos(url()->current(), "treatment") == null ? route("medical_record.edit.therapy.treatment", ["id" => $id]) : "#" }}'>Tindakan</a>
    </li>

  </ul>