<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="">

    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="/home" class="brand-link">
            <img src="{{ asset('img/logo-ksb.png') }}" alt="AdminLTE Logo" class="brand-image opacity-80 shadow"
                style="max-width: 45px; max-height: 45px" />
            <span class="brand-text fw-light">KSB | Si-Reki</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Main navigation">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">

                <li class="nav-item">
                    <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-houses"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Master --}}
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="/loker" class="nav-link {{ request()->is('loker*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-briefcase"></i>
                        <p>Lowongan Kerja</p>
                    </a>
                </li>

                @if (auth()->user()->level == 'SUPER USER' || auth()->user()->level == 'DIREKTUR')
                    <li class="nav-item {{ request()->is('bank-soal*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('bank-soal*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-file-earmark-text"></i>
                            <p>
                                Bank Soal
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            {{-- psikotes --}}
                            <li class="nav-item {{ request()->is('bank-soal/psikotes*') ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->is('bank-soal/psikotes*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle-fill"></i>
                                    <p>
                                        Psikotes
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sesi-one.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/sesiOne') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Sesi One</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pengetahuan-perbankan.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/pengetahuan-perbankan') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Pengetahuan Perbankan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('analogi-verbal.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/analogi-verbal') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Analogi Verbal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kraepelin.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/kraepelin') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Kraepelin</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('hitung-cepat.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/hitung-cepat') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Hitung Cepat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tes-integritas.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/tes-integritas') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Tes Integritas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tes-informasi-singkat.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/tes-informasi-singkat') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Tes Informasi Singkat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tes-penalaran-analitik.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/tes-penalaran-analitik') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Tes Penalaran Analitik</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tes-kemampuan-verbal.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/tes-kemampuan-verbal') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Tes Kemampuan Verbal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tes-ketelitian.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/tes-ketelitian') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Tes Ketelitian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tes-kemampuan-kuantitatif.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/psikotes/tes-kemampuan-kuantitatif') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Tes Kemampuan Kuantitatif</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            {{-- tes jabatan --}}
                            <li class="nav-item {{ request()->is('bank-soal/jabatan*') ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->is('bank-soal/jabatan*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle-fill"></i>
                                    <p>
                                        Tes Jabatan
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('analis-kredit.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/jabatan/analis-kredit') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Analis Kredit</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('audit-internal.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/jabatan/audit-internal') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Audit Internal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('marketing.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/jabatan/marketing') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Marketing</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('bidang-perkreditan.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/jabatan/bidang-perkreditan') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Bidang Perkreditan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('bidang-legal.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/jabatan/bidang-legal') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Bidang Legal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('remedial.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/jabatan/remedial') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Remedial</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            {{-- tes Tes Profil Kepribadian --}}
                            <li class="nav-item {{ request()->is('bank-soal/kepribadian*') ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->is('bank-soal/kepribadian*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle-fill"></i>
                                    <p>
                                        Tes Profil Kepribadian
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('swot.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/kepribadian/swot') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>SWOT</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('disc.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/kepribadian/disc') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>DISC</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('mbti.index') }}"
                                            class="nav-link {{ request()->is('bank-soal/kepribadian/mbti') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>MBTI</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="nav-item {{ request()->is('setting-tes*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('setting-tes*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-sliders"></i>
                        <p>
                            Setting Tes
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kategori-soal.index') }}"
                                class="nav-link {{ request()->is('setting-tes/kategori-soal*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Kategori Soal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('paket-soal.index') }}"
                                class="nav-link {{ request()->is('setting-tes/paket-soal*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Paket Soal</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- end master --}}


                {{-- Applicant --}}
                <li class="nav-header">APPLICANT</li>
                <li class="nav-item">
                    <a href="/applicant" class="nav-link {{ request()->is('applicant') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <p>Data Pelamar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/penjadwalan" class="nav-link {{ request()->is('penjadwalan*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar-week"></i>
                        <p>Penjadwalan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/hasil-test-peserta"
                        class="nav-link {{ request()->is('hasil-test-peserta*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-award"></i>
                        <p>Hasil Test Peserta</p>
                    </a>
                </li>
                {{-- end applicant --}}

                {{-- output Start --}}
                @if (Auth::user()->level == 'SUPER USER' || Auth::user()->level == 'DIREKTUR')
                    <li class="nav-header">OUTPUT</li>
                    <li class="nav-item">
                        <a href="/print-document"
                            class="nav-link {{ request()->is('print-document*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-printer"></i>
                            <p>Print Dokumen</p>
                        </a>
                    </li>
                @endif
                {{-- output ends --}}


                {{-- <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-circle-fill"></i>
                        <p>
                            Level 1
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Level 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>
                                    Level 2
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-record-circle-fill"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Level 2</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

            </ul>
            <!--end::Sidebar Menu-->

            <!-- Docs CTA (bottom of sidebar) -->
            {{-- <div class="p-3 mt-3 border-top border-secondary border-opacity-25">
                <a href="./docs/introduction.html"
                    class="btn btn-sm btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-book" aria-hidden="true"></i>
                    View documentation
                </a>
            </div> --}}
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
