<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @if(Auth::user()->allow_access('setting'))
                      <li><a><i class="fa fa-gear"></i> Setting & User <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          @if(Auth::user()->allow_access('setting.company'))
                              <li><a href="{{ route('setting.company') }}">Perusahaan</a></li>
                          @endif

                          @if(Auth::user()->allow_access('setting.finance'))
                              <li><a href="{{ route('setting.finance') }}">Keuangan</a></li>
                          @endif

                          @if(Auth::user()->allow_access('setting.user'))
                              <li><a href="{{ route('user.index') }}">User</a></li>
                          @endif

                          @if(Auth::user()->allow_access('setting.group_user'))
                          <li><a href="{{ route('group_user.index') }}">Departemen</a></li>
                          @endif

                          @if(Auth::user()->allow_access('setting.grup_nota'))
                          <li><a href="{{ route('grup_nota.index') }}">Grup Nota</a></li>
                          @endif

                          @if(Auth::user()->allow_access('setting.discount'))
                              <li><a href="{{ route('discount.index') }}">Promo</a></li>
                          @endif

                          @if(Auth::user()->allow_access('setting.signa'))
                          <li><a href="{{ route('signa.index') }}">Signa</a></li>
                          @endif

                          @if(Auth::user()->allow_access('setting.laboratory_type'))
                          <li><a href="{{ route('laboratory_type.index') }}">Laboratorium</a></li>
                          @endif
                          
                          <li><a href="{{ route('radiology_type.index') }}">Radiologi</a></li>
                          
                          <li><a href="{{ route('keadaan_umum.index') }}">Keadaan Umum</a></li>
                          
                          <li><a href="{{ route('side_effect.index') }}">Efek Samping</a></li>
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
                            <li><a href="{{ route('doctor.index') }}">Tenaga Medis</a></li>
                        @endif

                        @if(Auth::user()->allow_view_employee())
                            <li><a href="{{ route('employee.index') }}">Karyawan/Non Medis</a></li>
                        @endif
                        @if(Auth::user()->allow_access('master.supplier'))
                          <li><a href="{{ route('supplier.index') }}">Rekanan</a></li>
                        @endif

                        @if(Auth::user()->allow_access('master.medical_item'))
                            <li><a href="{{ route('medical_item.index') }}">Item Medis</a></li>
                        @endif
                        
                        @if(Auth::user()->allow_access('setting.price'))
                              <li><a href="{{ route('price.index') }}">Tarif</a></li>
                          @endif

                        <li><a href="{{ route('treatment_group.index') }}">Paket Tindakan</a></li>


                        @if(Auth::user()->allow_access('master.obat'))
                            <li><a href="{{ route('obat.index') }}">Obat</a></li>
                        @endif

                        @if(Auth::user()->allow_access('master.lokasi'))
                        <li><a href="{{ route('lokasi.index') }}">Daftar Lokasi</a></li>
                        @endif

                        @if(Auth::user()->allow_access('master.piece'))
                        <li><a href="{{ route('piece.index') }}">Satuan</a></li>
                        @endif

                        @if(Auth::user()->allow_access('master.disease'))
                            <li><a href="{{ route('disease.index') }}">Penyakit(ICD-10)</a></li>
                        @endif

                        @if(Auth::user()->allow_access('master.specialization'))
                        <li><a href="{{ route('specialization.index') }}">Spesialisasi</a></li>
                        @endif

                        @if(Auth::user()->allow_access('master.polyclinic'))
                          <li><a href="{{ route('polyclinic.index') }}">Poliklinik</a></li>
                        @endif
                      </ul>
                    </li>
                  @endif
                  @if(Auth::user()->allow_view_registration())
                  <li>
                    <a href='{{ route("registration.index") }}'><i class="fa fa-desktop"></i> Registrasi Pasien</a>
                  </li>
                  @endif
                  
                  @if(Auth::user()->allow_view_cashier())
                      <li>
                        <a href='{{ route("cashier.index") }}'><i class="fa fa-bank"></i>Kasir</a>
                      </li>
                  @endif

                  @if(Auth::user()->allow_access('polyclinic'))
                      <li>
                        <a href='{{ route("polyclinic.patient.index") }}'><i class="fa fa-user-md"></i>Poliklinik</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_access('radiology'))
                      <li>
                        <a href='{{ route("radiology.index") }}'><i class="fa fa-bullseye"></i>Radiologi</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_access('laboratory'))
                      <li>
                        <a href='{{ route("laboratory.index") }}'><i class="fa fa-filter"></i>Laboratorium</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_access('chemoterapy'))
                      <li>
                        <a href='{{ route("chemoterapy.index") }}'><i class="fa fa-medkit"></i>Kemoterapi</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_access('ruang_tindakan'))
                      <li>
                        <a href='{{ route("ruang_tindakan.index") }}'><i class="fa fa-inbox"></i>Ruang Tindakan</a>
                      </li>
                  @endif


                  @if(Auth::user()->allow_access('medical_checkup'))
                      <li>
                        <a href='{{ route("medical_checkup.index") }}'><i class="fa fa-tasks"></i>Medical Checkup</a>
                      </li>
                  @endif

                  @if(Auth::user()->allow_access('surat'))
                    <li><a><i class="fa fa-bookmark"></i>Layanan<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            @if(Auth::user()->allow_access('surat.cuti_hamil'))
                                <li><a href="{{ route('surat.cuti_hamil.index') }}">Surat Cuti Hamil</a></li>
                            @endif

                            @if(Auth::user()->allow_access('surat.keterangan_dokter'))
                                <li><a href="{{ route('surat.keterangan_dokter.index') }}">Surat Keterangan Dokter</a></li>
                            @endif
                            @if(Auth::user()->allow_access('surat.keterangan_sehat'))
                                <li><a href="{{ route('surat.keterangan_sehat.index') }}">Surat Keterangan Sehat</a></li>
                            @endif
                            @if(Auth::user()->allow_access('surat.layak_terbang'))
                                <li><a href="{{ route('surat.layak_terbang.index') }}">Surat Layak Terbang</a></li>
                            @endif
                            @if(Auth::user()->allow_access('surat.pengantar_mrs'))
                                <li><a href="{{ route('surat.pengantar_mrs.index') }}">Surat Pengantar MRS</a></li>
                            @endif
                            @if(Auth::user()->allow_access('surat.pengantar_mrs'))
                                <li><a href="{{ route('surat.rujukan_pasien.index') }}">Surat Rujukan Pasien</a></li>
                            @endif
                            @if(Auth::user()->allow_access('surat.persetujuan_tindakan_medis'))
                                <li><a href="{{ route('surat.persetujuan_tindakan_medis.index') }}">Persetujuan Tindakan Medis</a></li>
                            @endif
                          </ul>
                    </li>
                  @endif
                  
                  @if(Auth::user()->allow_access('pharmacy'))
                      <li><a><i class="fa fa-briefcase"></i>Farmasi<span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                  @if(Auth::user()->allow_access('pharmacy.purchase_request'))
                                  <li><a href="{{ route('pharmacy.purchase_request.index') }}">Permintaan Pembelian</a></li>
                                  @endif

                                  @if(Auth::user()->allow_access('pharmacy.purchase_order'))
                                    <li><a href="{{ route('pharmacy.purchase_order.index') }}">Order Pembelian</a></li>
                                  @endif

                                  @if(Auth::user()->allow_access('pharmacy.receipt'))
                                    <li><a href="{{ route('pharmacy.receipt.index') }}">Penerimaan</a></li>
                                  @endif
                                    <li><a href="{{ route('pharmacy.movement.index') }}">Perpindahan</a></li>

                                    <li><a href="{{ route('pharmacy.formula.index') }}">Resep Obat</a></li>
                                    

                                    <li><a href="{{ route('pharmacy.adjustment_stock.index') }}">Stok Opname</a></li>
                                    <li><a href="{{ route('pharmacy.report.history') }}">Kartu Stok</a></li>
                                    <li><a href="{{ route('pharmacy.report.distribution') }}">Laporan distribusi</a></li>
                              </ul>
                      </li>
                  @endif             
                 
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->