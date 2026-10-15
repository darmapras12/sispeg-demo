<div class="table-responsive">
    <table class="table align-middle table-hover">
        <thead class="table-light">
            <tr class="small text-muted text-uppercase">
                @if(isset($tipe) &&$tipe == 'total')
                <th width="40" class="text-center">
                    <input type="checkbox" id="checkAll" style="cursor: pointer; transform: scale(1.2);">
                </th>
                @endif
                <th class="text-center" width="60">No</th>
                <th style="cursor: pointer;">Pegawai / NIP</th>
                @if(in_array($tipe ?? 'total', ['total', 'kp']))
                <th class="text-center">Detail Estimasi KP</th>
                @endif
                @if(in_array($tipe ?? 'total', ['total', 'kgb']))
                <th class="text-center">Detail Estimasi KGB</th>
                @endif
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index =>$p)
            @php
                $isGuest = Auth::check() && Auth::user()->email === 'guest@demo.com';
                $isMasterData = !$p->is_demo;
            @endphp
            <tr style="cursor: pointer;" onclick="toggleRow(event, this)">
                @if(isset($tipe) &&$tipe == 'total')
                <td class="text-center" onclick="event.stopPropagation();">
                    <input type="checkbox" name="ids[]" value="{{ $p->id }}" class="check-item" style="cursor: pointer; transform: scale(1.2);">
                </td>
                @endif
                <td class="text-center fw-medium">{{ $index + 1 }}</td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('img/profil.png') }}" 
                                 alt="Avatar" 
                                 class="rounded-circle border shadow-sm" 
                                 style="width: 40px; height: 40px; object-fit: cover; background-color: #f8fafc;">
                        </div>
                        <div>
                            <span class="fw-bold text-dark">{{ $p->nama_lengkap ?? '-' }}</span><br>
                            <small class="text-muted font-monospace">{{ $p->nip ?? '-' }}</small>
                        </div>
                    </div>
                </td>
                @if(in_array($tipe ?? 'total', ['total', 'kp']))
                <td class="text-center border-start">
                    <div class="countdown-timer text-danger fw-bold fs-6" 
                         data-time="{{ $p->next_kp ? $p->next_kp->format('Y-m-d H:i:s') : '' }}"
                         data-jenis="kp">
                        {{ $p->next_kp ? 'Memuat...' : '-' }}
                    </div>
                    <small class="text-muted" style="font-size: 0.75rem;">
                        Target: {{ $p->next_kp ? $p->next_kp->format('d/m/Y') : '-' }}
                    </small>
                </td>
                @endif
                @if(in_array($tipe ?? 'total', ['total', 'kgb']))
                <td class="text-center border-start">
                    <div class="countdown-timer text-primary fw-bold fs-6" 
                         data-time="{{ $p->next_kgb ? $p->next_kgb->format('Y-m-d H:i:s') : '' }}"
                         data-jenis="kgb">
                        {{ $p->next_kgb ? 'Memuat...' : '-' }}
                    </div>
                    <small class="text-muted" style="font-size: 0.75rem;">
                        Target: {{ $p->next_kgb ? $p->next_kgb->format('d/m/Y') : '-' }}
                    </small>
                </td>
                @endif
                <td class="text-end" onclick="event.stopPropagation();">
                    <div class="d-flex justify-content-end gap-2">
                        @if($tipe == 'kp')
                            @if($isGuest &&$isMasterData)
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm fw-bold" 
                                        onclick="tampilkanPeringatanMasterData()">
                                    <i class="bi bi-arrow-repeat me-1"></i> PERPANJANG KP
                                </button>
                            @else
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm fw-bold btn-renew-action" 
                                        data-id="{{ $p->id }}" data-tipe="kp">
                                    <i class="bi bi-arrow-repeat me-1"></i> PERPANJANG KP
                                </button>
                            @endif
                        @endif

                        @if($tipe == 'kgb')
                            @if($isGuest &&$isMasterData)
                                <button type="button" class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm fw-bold" 
                                        onclick="tampilkanPeringatanMasterData()">
                                    <i class="bi bi-arrow-repeat me-1"></i> PERPANJANG KGB
                                </button>
                            @else
                                <button type="button" class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm fw-bold btn-renew-action" 
                                        data-id="{{ $p->id }}" data-tipe="kgb">
                                    <i class="bi bi-arrow-repeat me-1"></i> PERPANJANG KGB
                                </button>
                            @endif
                        @endif

                        @if($isGuest &&$isMasterData)
                            <button type="button" class="btn btn-sm btn-light border rounded-circle shadow-sm" 
                                    onclick="tampilkanPeringatanMasterData()">
                                <i class="bi bi-pencil-fill text-primary"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-sm btn-light border rounded-circle shadow-sm" 
                                    data-bs-toggle="modal" data-bs-target="#modalEditPegawai" 
                                    onclick="bukaModalEdit({{ json_encode($p) }})">
                                <i class="bi bi-pencil-fill text-primary"></i>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-5 text-muted">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    function toggleRow(event, row) {
        if (event.target.tagName === 'INPUT' || event.target.tagName === 'BUTTON' || event.target.closest('button')) {
            return;
        }
        
        const checkbox = row.querySelector('.check-item');
        if (checkbox) {
            checkbox.checked = !checkbox.checked;
            checkbox.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }

    function tampilkanPeringatanMasterData() {
        const notifLama = document.getElementById('alert-error');
        if (notifLama) {
            notifLama.remove();
        }

        const wrapperNotif = document.querySelector('.notifikasi-floating-wrapper') || document.body;

        const htmlNotif = `
            <div id="alert-error" class="alert-custom-wrapper">
                <div class="alert-custom-content bg-error">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-white text-danger me-3">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Akses Dibatasi!</h6>
                                <small>Data ini merupakan Data Master Admin dan bersifat permanen. Sebagai akun Guest, Anda hanya dapat mengubah data yang Anda tambahkan sendiri!</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close-custom" onclick="tutupNotifikasi('alert-error')">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="progress-container">
                        <div id="progress-bar-error" class="progress-bar-fill"></div>
                    </div>
                </div>
            </div>
        `;

        wrapperNotif.insertAdjacentHTML('afterbegin', htmlNotif);

        const progressBar = document.getElementById('progress-bar-error');
        const duration = 4000;
        let start = Date.now();

        const timer = setInterval(() => {
            let timePassed = Date.now() - start;
            let progress = 100 - (timePassed / duration * 100);
            if (progressBar) progressBar.style.width = progress + '%';
            if (timePassed >= duration) {
                clearInterval(timer);
                tutupNotifikasi('alert-error');
            }
        }, 10);
    }
</script>