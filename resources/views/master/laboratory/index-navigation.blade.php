<nav style='margin-bottom:2mm'>
    
     <ul class="nav nav-pills">
        <li class='{{ strpos(url()->current(), "administration") != null ? "active" : "" }}'>
            <a href="{{ route('administration.index') }}">Distributor Farmasi</a>
        </li>
        <li class='{{ strpos(url()->current(), "laboratory") != null ? "active" : "" }}'>
            <a href="{{ route('laboratory.index') }}">Laboratorium</a>
        </li>
        <li class='{{ strpos(url()->current(), "radiology") != null ? "active" : "" }}'>
            <a href="{{ route('radiology.index') }}">Radiologi</a>
        </li>
        <li class='{{ strpos(url()->current(), "pathology") != null ? "active" : "" }}'>
            <a href="{{ route('pathology.index') }}">Patologi & anatomi</a>
        </li>
        <li class='{{ strpos(url()->current(), "pharmacy") != null ? "active" : "" }}'>
            <a href="{{ route('pharmacy.index') }}">Farmasi</a>
        </li>
      </ul> 
  </nav>