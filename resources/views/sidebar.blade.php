<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @if(Auth::user()->allow_view_setting())
                      <li><a><i class="fa fa-gear"></i> Setting & user <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{ route('user.index') }}">User</a></li>
                          <li><a href="{{ route('group_user.index') }}">Departemen</a></li>
                          <li><a href="{{ route('grup_nota.index') }}">Grup nota</a></li>
                          @if(Auth::user()->allow_view_price())
                              <li><a href="{{ route('price.index') }}">Tarif</a></li>
                          @endif
                          @if(Auth::user()->allow_view_discount())
                              <li><a href="{{ route('discount.index') }}">Promo</a></li>
                          @endif
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
                        <li><a href="{{ route('cure.index') }}">Item medis</a></li>
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
                        <a href='{{ route("chemoterapy.index") }}'><i class="fa fa-medkit"></i>Kemoterapi</a>
                      </li>
                  @endif

                  <li class='hidden'><a><i class="fa fa-external-link"></i> Poliklinik <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="">Daftar pasien</a></li>
                    </ul>
                  </li>

                  <li class='hidden'><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  <li class='hidden'><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  <li class='hidden'><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section hidden">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->