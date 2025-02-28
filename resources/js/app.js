import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Tambahkan Laravel Echo
import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'reverb'
});

// Mendengarkan event dari Laravel Reverb
window.Echo.channel('panggilan-pasien')
    .listen('.PanggilPasien', (data) => {
        console.log('Pasien dipanggil:', data);
    });
