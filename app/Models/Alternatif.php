<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif'; // pastikan sesuai DB

    protected $fillable = [
        // =====================
        // DATA PRIBADI
        // =====================
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email',
        'nim',
        'semester',
        'fakultas',
        'jurusan',
        'ipk',
        'tahun_masuk',
        'prestasi',
        'jenis_pendaftaran',
        'asal_kampus',

        // =====================
        // ORGANISASI (KADER)
        // =====================
        'jenis_organisasi',
        'nama_organisasi',
        'jabatan',
        'tahun_bergabung',
        'riwayat_aktivitas',
        'kontribusi',
        'rencana_masa_depan',

        // =====================
        // ORANG TUA & EKONOMI
        // =====================
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'jumlah_tanggungan',
        'status_rumah',
        'kondisi_ekonomi',

        // =====================
        // FILE LAMA
        // =====================
        'ktp',
        'kk',
        'transkrip',
        'surat_penghasilan',
        'surat_tidak_mampu',
        'surat_aktif_organisasi',
        'sertifikat_prestasi',

        // =====================
        // FILE BARU (KADER & DHUAFA)
        // =====================
        'surat_tidak_menerima_beasiswa',

        'foto_rumah_depan',
        'foto_rumah_samping',
        'foto_ruang_tamu',
        'foto_kamar_mandi',
        'foto_dapur',

        'slip_gaji_ortu',
        'cv',
        'pas_foto',
        'motivation_letter',
        'ktm',
        'twibbon',
        'bukti_twibbon',
        'surat_kesanggupan_relawan',

        // =====================
        // KHUSUS KADER
        // =====================
        'surat_rekomendasi',
        'ktam',

        // =====================
        // ADMIN / SISTEM
        // =====================
        'status',
        'status_administrasi',
        'catatan_administrasi',
        'tanggal_keputusan',
        'jumlah_beasiswa',
        'periode_id',
    ];

    // =====================
    // RELASI
    // =====================
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id');
    }
    public function periode()
{
    return $this->belongsTo(\App\Models\Periode::class, 'periode_id');
}

    public function hasilPerhitungan()
    {
        return $this->hasOne(HasilPerhitungan::class, 'alternatif_id');
    }

    public function nilaiWawancara()
    {
        return $this->hasMany(\App\Models\NilaiWawancara::class, 'alternatif_id');
    }

    // =====================
    // HELPER FILE (OPSIONAL, DISARANKAN)
    // =====================
    public function fileUrl($field)
    {
        return $this->$field
            ? asset('storage/' . $this->$field)
            : null;
    }
}
