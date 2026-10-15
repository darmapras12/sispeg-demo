<style>
    .notif-header {
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notif-header h6 {
        margin: 0;
        font-weight: 700;
        color: #fff;
        font-size: 0.9rem;
    }

    .notif-body-list {
        max-height: 350px;
        overflow-y: auto;
        display: block;
    }

    .notif-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: 0.3s;
    }

    .notif-item:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .notif-icon-circle {
        width: 35px;
        height: 35px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .notif-content {
        flex-grow: 1;
        text-align: left;
    }

    .notif-title {
        color: #efefef;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 2px;
        display: block;
    }

    .notif-desc {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.75rem;
        display: block;
    }

    .notif-body-empty {
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 20px;
        text-align: center;
    }

    .notif-empty-icon {
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.1);
        margin-bottom: 10px;
    }

    .notif-empty-text {
        color: rgba(255, 255, 255, 0.4);
        font-size: 0.85rem;
        font-weight: 400;
    }

    .notif-footer {
        padding: 12px;
        text-align: center;
        background: rgba(0, 0, 0, 0.2);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .btn-lihat-semua {
        font-size: 0.75rem;
        color: var(--warna-aksen-biru);
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }
</style>

@php 
    $total = ($countKP ?? 0) + ($countKGB ?? 0); 
@endphp

<div class="notif-header">
    <h6>Pemberitahuan</h6>
    <span class="badge rounded-pill {{ $total > 0 ? 'bg-danger' : 'bg-secondary' }}" style="font-size: 0.7rem;">
        {{ $total }}
    </span>
</div>

@if($total > 0)
    <div class="notif-body-list">

        {{-- ================= KP ================= --}}
        @foreach($notifKP as $p)
            <a href="{{ route('dashboard') }}?tab=kp#stat-kp" class="notif-item">
                <div class="notif-icon-circle bg-primary text-white">
                    <i class="bi bi-person-up"></i>
                </div>
                <div class="notif-content">
                    <span class="notif-title">{{ $p->nama_lengkap }}</span>
                    <span class="notif-desc">
                        Mendekati waktu KP 
                        ({{ \Carbon\Carbon::parse($p->next_kp)->format('d/m/Y') }})
                    </span>
                </div>
            </a>
        @endforeach

        {{-- ================= KGB ================= --}}
        @foreach($notifKGB as $p)
            <a href="{{ route('dashboard') }}?tab=kgb#stat-kgb" class="notif-item">
                <div class="notif-icon-circle bg-warning text-dark">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="notif-content">
                    <span class="notif-title">{{ $p->nama_lengkap }}</span>
                    <span class="notif-desc">
                        Mendekati waktu KGB 
                        ({{ \Carbon\Carbon::parse($p->next_kgb)->format('d/m/Y') }})
                    </span>
                </div>
            </a>
        @endforeach

    </div>
@else
    <div class="notif-body-empty">
        <div class="notif-empty-icon">
            <i class="bi bi-bell-slash"></i>
        </div>
        <div class="notif-empty-text">
            Belum ada jadwal untuk saat ini.
        </div>
    </div>
@endif

<div class="notif-footer">
    <a href="{{ route('dashboard') }}" class="btn-lihat-semua">
        Tandai sudah dibaca
    </a>
</div>
