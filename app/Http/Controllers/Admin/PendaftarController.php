<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alternatif;

class PendaftarController extends Controller
{
    public function index()
    {
        $pageTitle = 'Data Pendaftar';
        $alternatifs = Alternatif::latest()->get();
        return view('admin.alternatif.index', compact('pageTitle', 'alternatifs'));
    }

    public function updateStatusAdministrasi(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'status_administrasi' => 'required|in:pending,lulus,tidak_lulus',
            'catatan_administrasi' => 'nullable|string'
        ]);

        $alternatif->status_administrasi = $request->status_administrasi;
        $alternatif->catatan_administrasi = $request->catatan_administrasi;
        $alternatif->save();

        return back()->with('success', 'Status administrasi berhasil diperbarui.');
    }

    public function create()
    {
        $pageTitle = 'Tambah Pendaftar';
        return view('admin.alternatif.create', compact('pageTitle'));
    }

    // ===============================
    // STORE (ADMIN CREATE) - IKUT CREATE.BLADE
    // ===============================
    public function store(Request $request)
    {
        $jenis = $request->jenis_pendaftaran;

        // default rules (wajib umum)
        $rulesUmum = [
            // DATA PRIBADI
            'jenis_pendaftaran' => 'required|in:dhuafa,kader',
            'nama'          => 'required|string|max:100',
            'nik'           => 'required|digits:16',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_telepon'    => 'required|string|max:20',
            'email'         => 'required|email|max:100',

            // AKADEMIK
            'asal_kampus'   => 'required|string|max:150',
            'nim'           => 'required|string|max:50',
            'semester'      => 'required|in:1,2,3,4,5,6,7,8',
            'fakultas'      => 'required|string|max:100',
            'jurusan'       => 'required|string|max:100',
            'ipk'           => 'required|numeric|between:0,4',
            'tahun_masuk'   => 'required|integer|between:2015,2025',
            'prestasi'      => 'nullable|string',

            // EKONOMI
            'nama_ayah'         => 'required|string|max:100',
            'pekerjaan_ayah'    => 'required|string|max:100',
            'nama_ibu'          => 'required|string|max:100',
            'pekerjaan_ibu'     => 'required|string|max:100',
            'penghasilan_ayah'  => 'required|numeric|min:0',
            'penghasilan_ibu'   => 'required|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:1',
            'status_rumah'      => 'required|in:Milik Sendiri,Sewa,Menumpang,Warisan',
            'kondisi_ekonomi'   => 'required|string',

            // FILE UMUM
            'ktp'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'transkrip' => 'required|file|mimes:pdf|max:5120',

            'surat_penghasilan' => 'required|file|mimes:pdf|max:3072',
            'slip_gaji_ortu'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_tidak_menerima_beasiswa' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // FOTO RUMAH
            'foto_rumah_depan'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_rumah_samping' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_ruang_tamu'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kamar_mandi'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_dapur'         => 'required|image|mimes:jpg,jpeg,png|max:2048',

            // DOKUMEN PENDUKUNG
            'cv'                => 'required|file|mimes:pdf,doc,docx|max:2048',
            'pas_foto'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'motivation_letter' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'ktm'               => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'twibbon'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'surat_kesanggupan_relawan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        // rules khusus kategori
        if ($jenis === 'dhuafa') {
            $rulesKhusus = [
                'surat_tidak_mampu' => 'required|file|mimes:pdf|max:3072',
            ];
            $uploadFolder = 'uploads/dhuafa';
        } else {
            $rulesKhusus = [
                // ORGANISASI KADER
                'jenis_organisasi'   => 'required|string|max:100',
                'nama_organisasi'    => 'required|string|max:100',
                'jabatan'            => 'required|string|max:100',
                'tahun_bergabung'    => 'required|integer|between:2010,2025',
                'riwayat_aktivitas'  => 'required|string',
                'kontribusi'         => 'required|string',
                'rencana_masa_depan' => 'required|string',

                // FILE KHUSUS KADER
                'surat_aktif_organisasi' => 'required|file|mimes:pdf|max:3072',
                'surat_rekomendasi'      => 'required|file|mimes:pdf|max:2048',
                'ktam'                   => 'required|image|mimes:jpg,jpeg,png|max:2048',

                // opsional
                'sertifikat_prestasi'    => 'nullable|file|mimes:pdf|max:5120',
            ];
            $uploadFolder = 'uploads/kader';
        }

        $validated = $request->validate(array_merge($rulesUmum, $rulesKhusus));

        // simpan file
        $fileFields = [
            'ktp','kk','transkrip','surat_penghasilan','slip_gaji_ortu','surat_tidak_menerima_beasiswa',
            'foto_rumah_depan','foto_rumah_samping','foto_ruang_tamu','foto_kamar_mandi','foto_dapur',
            'cv','pas_foto','motivation_letter','ktm','twibbon','surat_kesanggupan_relawan',
            'surat_tidak_mampu','surat_aktif_organisasi','surat_rekomendasi','ktam','sertifikat_prestasi',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store($uploadFolder, 'public');
            }
        }

        Alternatif::create($validated);

        return redirect()->route('admin.pendaftar.index')->with('success', 'Pendaftar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Pendaftar';
        $alternatif = Alternatif::findOrFail($id);
        return view('admin.alternatif.edit', compact('pageTitle', 'alternatif'));
    }

    // ===============================
    // UPDATE (ADMIN EDIT) - FILE TIDAK WAJIB
    // ===============================
    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $jenis = $request->jenis_pendaftaran ?? $alternatif->jenis_pendaftaran;

        // Sama seperti store, tapi FILE jadi nullable
        $rulesUmum = [
            'jenis_pendaftaran' => 'required|in:dhuafa,kader',
            'nama'          => 'required|string|max:100',
            'nik'           => 'required|digits:16',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required|string',
            'no_telepon'    => 'required|string|max:20',
            'email'         => 'required|email|max:100',

            'asal_kampus'   => 'required|string|max:150',
            'nim'           => 'required|string|max:50',
            'semester'      => 'required|in:1,2,3,4,5,6,7,8',
            'fakultas'      => 'required|string|max:100',
            'jurusan'       => 'required|string|max:100',
            'ipk'           => 'required|numeric|between:0,4',
            'tahun_masuk'   => 'required|integer|between:2015,2025',
            'prestasi'      => 'nullable|string',

            'nama_ayah'         => 'required|string|max:100',
            'pekerjaan_ayah'    => 'required|string|max:100',
            'nama_ibu'          => 'required|string|max:100',
            'pekerjaan_ibu'     => 'required|string|max:100',
            'penghasilan_ayah'  => 'required|numeric|min:0',
            'penghasilan_ibu'   => 'required|numeric|min:0',
            'jumlah_tanggungan' => 'required|integer|min:1',
            'status_rumah'      => 'required|in:Milik Sendiri,Sewa,Menumpang,Warisan',
            'kondisi_ekonomi'   => 'required|string',

            // FILE -> nullable
            'ktp'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'transkrip' => 'nullable|file|mimes:pdf|max:5120',

            'surat_penghasilan' => 'nullable|file|mimes:pdf|max:3072',
            'slip_gaji_ortu'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_tidak_menerima_beasiswa' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'foto_rumah_depan'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_rumah_samping' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_ruang_tamu'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kamar_mandi'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_dapur'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'cv'                => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'pas_foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'motivation_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'ktm'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'twibbon'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'surat_kesanggupan_relawan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if ($jenis === 'dhuafa') {
            $rulesKhusus = [
                'surat_tidak_mampu' => 'nullable|file|mimes:pdf|max:3072',
            ];
            $uploadFolder = 'uploads/dhuafa';
        } else {
            $rulesKhusus = [
                'jenis_organisasi'   => 'required|string|max:100',
                'nama_organisasi'    => 'required|string|max:100',
                'jabatan'            => 'required|string|max:100',
                'tahun_bergabung'    => 'required|integer|between:2010,2025',
                'riwayat_aktivitas'  => 'required|string',
                'kontribusi'         => 'required|string',
                'rencana_masa_depan' => 'required|string',

                'surat_aktif_organisasi' => 'nullable|file|mimes:pdf|max:3072',
                'surat_rekomendasi'      => 'nullable|file|mimes:pdf|max:2048',
                'ktam'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'sertifikat_prestasi'    => 'nullable|file|mimes:pdf|max:5120',
            ];
            $uploadFolder = 'uploads/kader';
        }

        $validated = $request->validate(array_merge($rulesUmum, $rulesKhusus));

        $fileFields = [
            'ktp','kk','transkrip','surat_penghasilan','slip_gaji_ortu','surat_tidak_menerima_beasiswa',
            'foto_rumah_depan','foto_rumah_samping','foto_ruang_tamu','foto_kamar_mandi','foto_dapur',
            'cv','pas_foto','motivation_letter','ktm','twibbon','surat_kesanggupan_relawan',
            'surat_tidak_mampu','surat_aktif_organisasi','surat_rekomendasi','ktam','sertifikat_prestasi',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store($uploadFolder, 'public');
            } else {
                unset($validated[$field]); // penting: jangan overwrite file lama jadi null
            }
        }

        $alternatif->update($validated);

        return redirect()->route('admin.pendaftar.index')->with('success', 'Pendaftar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return redirect()->route('admin.pendaftar.index')
            ->with('success', 'Pendaftar berhasil dihapus.');
    }
}
