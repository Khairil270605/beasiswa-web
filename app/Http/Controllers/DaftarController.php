<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Periode;
use Illuminate\Http\Request;

class DaftarController extends Controller
{
    public function dhuafa()
{
    if (!auth()->check()) {
        return redirect()->route('login')
            ->with('info', 'Anda harus login terlebih dahulu untuk mendaftar.');
    }

    $periode = Periode::where('status', 'aktif')->first();

    if (!$periode) {
        return view('daftar.tutup'); // halaman pendaftaran ditutup
    }

    return view('daftar.dhuafa');
}

    public function kader()
{
    if (!auth()->check()) {
        return redirect()->route('login')
            ->with('info', 'Anda harus login terlebih dahulu untuk mendaftar.');
    }

    $periode = Periode::where('status', 'aktif')->first();

    if (!$periode) {
        return view('daftar.tutup');
    }

    return view('daftar.kader');
}

    // ===============================
    // SIMPAN PENDAFTAR DHUAFA
    // ===============================
    
    public function storeDhuafa(Request $request)
    {
        $periode = Periode::where('status', 'aktif')->first();

        if (!$periode) {
            return back()->with('error', 'Pendaftaran sedang ditutup');
        }
        // ✅ Ambil email dari akun login
        $request->merge([
            'email' => auth()->user()->email
        ]);

        // ==========================================
        // CEK DUPLIKASI PER TAHUN (EMAIL)
        // ==========================================
        $tahun = now()->year;

        $sudahDaftar = Alternatif::where('email', $request->email)
            ->where('jenis_pendaftaran', 'dhuafa')
            ->where('periode_id', $periode->id)
            ->exists();

        if ($sudahDaftar) {
            return back()->withInput()->withErrors([
                'msg' => "Email ini sudah terdaftar Beasiswa Dhuafa pada tahun {$tahun}. Silakan cek status pendaftaran."
            ]);
        }

        $validated = $request->validate([
            // ======================
            // DATA PRIBADI (WAJIB)
            // ======================
            'nama'          => 'required|string|max:100',
            'nik'           => 'required|digits:16',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_telepon'    => 'required|numeric|digits_between:10,15',
            'email'         => 'required|email|max:100',

            // ======================
            // AKADEMIK (WAJIB)
            // ======================
            'asal_kampus'   => 'required|string|max:150',
            'nim'           => 'required|string|max:50',
            'semester'      => 'required|in:1,2,3,4,5,6,7,8',
            'fakultas'      => 'required|string|max:100',
            'jurusan'       => 'required|string|max:100',
            'ipk'           => 'required|numeric|between:0,4',
            'tahun_masuk' => [
                'required',
                'integer',
                'min:2015',
                'max:' . (date('Y') + 1),
            ],
            'prestasi'      => 'nullable|string',

            // ======================
            // EKONOMI (WAJIB)
            // ======================
            'nama_ayah'         => 'required|string|max:100',
            'pekerjaan_ayah'    => 'required|string|max:100',
            'nama_ibu'          => 'required|string|max:100',
            'pekerjaan_ibu'     => 'required|string|max:100',
            'penghasilan_ayah'  => 'required|numeric|min:0',
            'penghasilan_ibu'   => 'nullable|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:1',
            'status_rumah'      => 'required|in:Milik Sendiri,Sewa,Menumpang,Warisan',
            'kondisi_ekonomi'   => 'required|string',

            // ======================
            // FILE (WAJIB)
            // ======================
            'ktp'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'transkrip' => 'required|file|mimes:pdf|max:5120',
            'surat_penghasilan' => 'required|file|mimes:pdf|max:3072',
            'slip_gaji_ortu'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_tidak_menerima_beasiswa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_tidak_mampu' => 'required|file|mimes:pdf|max:3072',

            // Foto rumah (WAJIB)
            'foto_rumah_depan'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_rumah_samping' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_ruang_tamu'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kamar_mandi'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_dapur'         => 'required|image|mimes:jpg,jpeg,png|max:2048',

            // Dokumen pendukung (WAJIB)
            'cv'                => 'required|file|mimes:pdf,doc,docx|max:2048',
            'pas_foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'motivation_letter' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'ktm'               => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'twibbon'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            
            // ✅ TAMBAHAN BARU - BUKTI TWIBBON (WAJIB)
            'bukti_twibbon'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
            
            'surat_kesanggupan_relawan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $validated['jenis_pendaftaran'] = 'dhuafa';
        $validated['periode_id'] = $periode->id;

        // ✅ TAMBAHKAN 'bukti_twibbon' ke array files
        $files = [
            'ktp','kk','transkrip','surat_penghasilan','slip_gaji_ortu','surat_tidak_menerima_beasiswa',
            'surat_tidak_mampu',
            'foto_rumah_depan','foto_rumah_samping','foto_ruang_tamu','foto_kamar_mandi','foto_dapur',
            'cv','pas_foto','motivation_letter','ktm','twibbon','bukti_twibbon','surat_kesanggupan_relawan'
        ];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $validated[$file] = $request->file($file)->store('uploads/dhuafa', 'public');
            }
        }

        Alternatif::create($validated);

        return redirect()->route('daftar.dhuafa')->with('success', 'Pendaftaran Dhuafa berhasil!');
    }

    // ===============================
    // SIMPAN PENDAFTAR KADER
    // ===============================
    public function storeKader(Request $request)
    {
        $periode = Periode::where('status', 'aktif')->first();

        if (!$periode) {
            return back()->with('error', 'Pendaftaran sedang ditutup');
        }
        // ✅ Ambil email dari akun login
        $request->merge([
            'email' => auth()->user()->email
        ]);

        // ==========================================
        // CEK DUPLIKASI PER TAHUN (EMAIL)
        // ==========================================
        $tahun = now()->year;

        $sudahDaftar = Alternatif::where('email', $request->email)
            ->where('jenis_pendaftaran', 'kader')
            ->where('periode_id', $periode->id)
            ->exists();

        if ($sudahDaftar) {
            return back()->withInput()->withErrors([
                'msg' => "Email ini sudah terdaftar Beasiswa Kader pada tahun {$tahun}. Silakan cek status pendaftaran."
            ]);
        }

        $validated = $request->validate([
            // DATA PRIBADI (WAJIB)
            'nama'          => 'required|string|max:100',
            'nik'           => 'required|digits:16',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_telepon'    => 'required|numeric|digits_between:10,15',
            'email'         => 'required|email|max:100',

            // AKADEMIK (WAJIB)
            'asal_kampus'   => 'required|string|max:150',
            'nim'           => 'required|string|max:50',
            'semester'      => 'required|in:1,2,3,4,5,6,7,8',
            'fakultas'      => 'required|string|max:100',
            'jurusan'       => 'required|string|max:100',
            'ipk'           => 'required|numeric|between:0,4',
            'tahun_masuk' => [
                'required',
                'integer',
                'min:2015',
                'max:' . (date('Y') + 1),
            ],
            'prestasi'      => 'nullable|string',

            // ORGANISASI (WAJIB karena KADER)
            'jenis_organisasi'   => 'required|string|max:100',
            'nama_organisasi'    => 'required|string|max:100',
            'jabatan'            => 'required|string|max:100',
            'tahun_bergabung' => [
                'required',
                'integer',
                'min:2015',
                'max:' . (date('Y') + 1),
            ],
            'riwayat_aktivitas'  => 'required|string',
            'kontribusi'         => 'required|string',
            'rencana_masa_depan' => 'required|string',

            // EKONOMI (WAJIB)
            'nama_ayah'         => 'required|string|max:100',
            'pekerjaan_ayah'    => 'required|string|max:100',
            'nama_ibu'          => 'required|string|max:100',
            'pekerjaan_ibu'     => 'required|string|max:100',
            'penghasilan_ayah'  => 'required|numeric|min:0',
            'penghasilan_ibu'   => 'nullable|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:1',
            'status_rumah'      => 'required|in:Milik Sendiri,Sewa,Menumpang,Warisan',
            'kondisi_ekonomi'   => 'required|string',

            // FILE UMUM (WAJIB)
            'ktp'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'transkrip' => 'required|file|mimes:pdf|max:5120',
            'surat_penghasilan' => 'required|file|mimes:pdf|max:3072',
            'slip_gaji_ortu'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_tidak_menerima_beasiswa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // FILE KHUSUS KADER (WAJIB)
            'surat_aktif_organisasi' => 'required|file|mimes:pdf|max:3072',
            'surat_rekomendasi'      => 'required|file|mimes:pdf|max:2048',
            'ktam'                   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'sertifikat_prestasi'    => 'nullable|file|mimes:pdf|max:5120',

            // Pendukung (WAJIB)
            'cv'                => 'required|file|mimes:pdf,doc,docx|max:2048',
            'pas_foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'motivation_letter' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'ktm'               => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'twibbon'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            
            // ✅ TAMBAHAN BARU - BUKTI TWIBBON (WAJIB)
            'bukti_twibbon'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
            
            'surat_kesanggupan_relawan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $validated['jenis_pendaftaran'] = 'kader';
        $validated['periode_id'] = $periode->id;

        // ✅ TAMBAHKAN 'bukti_twibbon' ke array files
        $files = [
            'ktp','kk','transkrip','surat_penghasilan','slip_gaji_ortu','surat_tidak_menerima_beasiswa',
            'surat_aktif_organisasi','surat_rekomendasi','ktam','sertifikat_prestasi',
            'cv','pas_foto','motivation_letter','ktm','twibbon','bukti_twibbon','surat_kesanggupan_relawan'
        ];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $validated[$file] = $request->file($file)->store('uploads/kader', 'public');
            }
        }

        Alternatif::create($validated);

        return redirect()->route('daftar.kader')->with('success', 'Pendaftaran Kader berhasil!');
    }
}