@if(isset($p->dokumens) && $p->dokumens->count() > 0)
    <a href="/admin/pegawai/{{ $p->id }}/berkas" 
       class="btn btn-sm fw-medium d-inline-flex align-items-center gap-1" 
       style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; border-radius: 8px; padding: 6px 12px; transition: all 0.2s;"
       title="Lihat Berkas Pegawai"
       onmouseover="this.style.backgroundColor='#0284c7'; this.style.color='#ffffff'; this.style.borderColor='#0284c7';"
       onmouseout="this.style.backgroundColor='#e0f2fe'; this.style.color='#0369a1'; this.style.borderColor='#bae6fd';">
        <i class="bi bi-file-earmark-check-fill" style="font-size: 14px;"></i>
        <span>Berkas</span>
    </a>
@else
    <button type="button" 
            class="btn btn-sm d-inline-flex align-items-center gap-1 text-muted" 
            style="background-color: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 12px; cursor: not-allowed;" 
            disabled 
            title="Belum ada berkas yang diunggah">
        <i class="bi bi-file-earmark-x" style="font-size: 14px;"></i>
        <span>Berkas</span>
    </button>
@endif