<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @if(Auth::user()->allow_view_setting())
                      <li><a><i class="fa fa-gear"></i> Setting & user <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ route('setting.company') }}">Perusahaan</a></li>
                          <li><a href="{{ route('user.index') }}">User</a></li>
                          <li><a href="{{ route('group_user.index') }}">Departemen</a></li>
                          <li><a href="{{ route('grup_nota.index') }}">Grup nota</a></li>
                          @if(Auth::user()->allow_view_price())
                              <li><a href="{{ route('price.index') }}">Tarif</a></li>
                          @endif
                          @if(Auth::user()->allow_view_discount())
                              <li><a href="{{ route('discount.index') }}">Promo</a></li>
                          @endif
                          <li><a href="{{ route('signa.index') }}">Signa</a></li>
                        </ul>
                      </li>
                  @endif
                  @if(Auth::user()->allow_view_master())
                    <li><a><i class="fa fa-gears"></i> Master <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        @if(Auth::user()->allow_view_patient())
                            <li><a href="{{ route('patient.index') }}">Pasien</a></li>
                        @endif
                        @if(Auth::user()->allow_view_medical_worker())
                            <li><a href="{{ route('doctor.index') }}">Tenaga medis</a></li>
                        @endif
                        @if(Auth::user()->allow_view_employee())
                            <li><a href="{{ route('employee.index') }}">Karyawan/Non Medis</a></li>
                        @endif
                        <li><a href="{{ route('supplier.index') }}">Rekanan</a></li>
                        <li><a href="{{ route('medical_item.index') }}">Item medis</a></li>
                        <li><a href="{{ route('lokasi.index') }}">Daftar lokasi</a></li>
                        <li><a href="{{ route('piece.index') }}">Satuan</a></li>
                        <li><a href="{{ route('disease.index') }}">Penyakit(ICD-10)</a></li>
                        <li><a href="{{ route('specialization.index') }}">Spesialisasi</a></li>
                        <li><a href="{{ route('polyclinic.index') }}">Poliklinik</a></li>
                      </ul>
                    </li>
                  @endif
                  @if(Auth::user()->allow_view_registration())
                  <li>
                    <a href='{{ route("registration.index") }}'><i class="fa fa-desktop"></i> Registrasi pasien</a>
                  </li>
                  @endif
                  
                  @if(Auth::user()->allow_view_cashier())
                      <li>
                        <a href='{{ route("cashier.index") }}'><i class="fa fa-bank"></i>Kasir</a>
                      </li>
                  @endif

                  @if(Auth::user()->allow_view_polyclinic())
                      <li>
                        <a href='{{ route("polyclinic.patient.index") }}'><i class="fa fa-user-md"></i>Poliklinik</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_view_polyclinic())
                      <li>
                        <a href='{{ route("radiology.index") }}'><i class="fa fa-bullseye"></i>Radiologi</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_view_polyclinic())
                      <li>
                        <a href='{{ route("laboratory.index") }}'><i class="fa fa-filter"></i>Laboratorium</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_view_polyclinic())
                      <li>
                        <a href='{{ route("chemoterapy.index") }}'><i class="fa fa-medkit"></i>Kemoterapi</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_view_polyclinic())
                      <li>
                        <a href='{{ route("ruang_tindakan.index") }}'><i class="fa fa-inbox"></i>Ruang tindakan</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_view_polyclinic())
                      <li>
                        <a href='{{ route("medical_checkup.index") }}'><i class="fa fa-tasks"></i>Medical Checkup</a>
                      </li>
                  @endif

                  @if(Auth::user()->allow_access('surat'))
                    <li><a><i class="fa fa-bookmark"></i>Layanan<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="{{ route('surat.cuti_hamil.index') }}">Surat cuti hamil</a></li>
                            <li><a href="{{ route('surat.keterangan_dokter.index') }}">Surat keterangan dokter</a></li>
                            <li><a href="{{ route('surat.keterangan_sehat.index') }}">Surat keterangan sehat</a></li>
                            <li><a href="{{ route('surat.layak_terbang.index') }}">Surat layak terbang</a></li>
                            <li><a href="{{ route('surat.pengantar_mrs.index') }}">Surat pengantar MRS</a></li>
                            <li><a href="{{ route('surat.rujukan_pasien.index') }}">Surat rujukan pasien</a></li>
                          </ul>
                    </li>
                  @endif
                 
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->