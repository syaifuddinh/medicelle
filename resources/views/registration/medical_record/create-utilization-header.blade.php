<ul class="nav nav-pills">
    <li class='{{ strpos(url()->current(), "bhp") != null ? "active" : "" }}'>
        <a href='{{ strpos(url()->current(), "bhp") == null ? route("medical_record.edit.utilization.bhp", ["id" => $id]) : "#" }}'>BHP</a>
    </li>
    <li class='{{ strpos(url()->current(), "sewa_alkes") != null ? "active" : "" }}'>
        <a href='{{ strpos(url()->current(), "sewa_alkes") == null ? route("medical_record.edit.utilization.sewa_alkes", ["id" => $id]) : "#" }}'>Sewa alkes</a>
    </li>
    <li class='{{ strpos(url()->current(), "sewa_ruangan") != null ? "active" : "" }}'>
        <a href='{{ strpos(url()->current(), "sewa_ruangan") == null ? route("medical_record.edit.utilization.sewa_ruangan", ["id" => $id]) : "#" }}'>Sewa ruangan</a>
    </li>
</ul>