<style>
    .lupa-pass-container {
        text-align: right;
        margin-top: 5px; /* Diubah dari -25px ke 5px agar tidak bertumpuk */
        margin-bottom: 25px; 
    }
    .lupa-pass-link {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.85rem;
        transition: 0.3s;
    }
    .lupa-pass-link:hover {
        color: #ffffff;
        text-decoration: underline;
    }
</style>

<div class="lupa-pass-container">
    <a href="{{ route('password.request') }}" class="lupa-pass-link">Lupa Password?</a>
</div>