@extends('admin.layouts.app')

@section('title', 'Scan QR Code')

@section('content')
<div class="flex justify-center py-6 px-4">
    <div class="w-full max-w-md">
        <h1 class="text-xl md:text-2xl font-bold mb-6 text-center">📷 Scan QR Code</h1>

        <!-- Scanner -->
        <div id="reader" class="w-full aspect-square rounded-lg shadow-md border"></div>
        <div id="result" class="mt-4 text-center text-green-600 font-bold"></div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    let isScanned = false;

    function onScanSuccess(decodedText, decodedResult) {
        if (!isScanned) {
            isScanned = true;
            html5QrCode.stop().then(() => {
                window.location.href = decodedText;
            }).catch(err => {
                console.error("Gagal menghentikan scanner: ", err);
                window.location.href = decodedText;
            });
        }
    }

    // Inisialisasi scanner manual agar bisa pilih kamera belakang
    const html5QrCode = new Html5Qrcode("reader");

    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            // Cari kamera belakang
            let backCamera = devices.find(device => device.label.toLowerCase().includes('back'));
            let cameraId = backCamera ? backCamera.id : devices[0].id;

            html5QrCode.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: { width: Math.min(window.innerWidth * 0.8, 300), height: Math.min(window.innerWidth * 0.8, 300) }
                },
                onScanSuccess
            ).catch(err => {
                console.error("Gagal memulai kamera: ", err);
            });
        }
    }).catch(err => {
        console.error("Gagal mendapatkan daftar kamera: ", err);
    });
</script>
@endsection
