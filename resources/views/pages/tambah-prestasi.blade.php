@extends('layouts.app')

@section('content')
    <section class="form-page">
        <div class="form-header">
            <a href="{{ route('laporan') }}" class="back-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                <span>Kembali ke Ruang Laporan</span>
            </a>
            <h1>Formulir Pelaporan Prestasi 🏆</h1>
            <p>Laporkan capaian prestasi akademik atau non-akademik Anda dengan data yang valid dan terverifikasi untuk masuk ke dalam database resmi PRESTO.</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                <strong>Mohon periksa formulir:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('prestasi.store') }}" method="POST" class="prestasi-form" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Informasi Mahasiswa -->
            <fieldset class="form-section">
                <legend class="section-legend">
                    <span class="step-num">1</span>
                    <div>
                        <h2>Informasi Mahasiswa</h2>
                        <small>Data identitas pelapor yang terdaftar pada sistem</small>
                    </div>
                </legend>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="nama_mahasiswa">Nama Lengkap Mahasiswa</label>
                        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $name }}" readonly class="input-readonly">
                    </div>
                    <div class="form-group">
                        <label for="nim_mahasiswa">Nomor Induk Mahasiswa (NIM)</label>
                        <input type="text" id="nim_mahasiswa" name="nim_mahasiswa" value="{{ $nim }}" readonly class="input-readonly">
                    </div>
                </div>
            </fieldset>

            <!-- Section 2: Detail Prestasi -->
            <fieldset class="form-section">
                <legend class="section-legend">
                    <span class="step-num">2</span>
                    <div>
                        <h2>Detail Prestasi</h2>
                        <small>Informasi mengenai kompetisi atau kejuaraan yang diikuti</small>
                    </div>
                </legend>

                <div class="form-group">
                    <label for="judul">Nama Kegiatan / Kompetisi Prestasi <span class="required">*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Juara 1 UI/UX Design Competition National Techfest 2024" required>
                </div>

                <div class="form-grid-3">
                    <div class="form-group">
                        <label for="tingkat">Tingkat Kompetisi <span class="required">*</span></label>
                        <select id="tingkat" name="tingkat" required>
                            <option value="" disabled selected>Pilih Tingkat...</option>
                            <option value="Internasional" {{ old('tingkat') === 'Internasional' ? 'selected' : '' }}>Internasional (+250 Poin)</option>
                            <option value="Nasional" {{ old('tingkat') === 'Nasional' ? 'selected' : '' }}>Nasional (+200 Poin)</option>
                            <option value="Regional" {{ old('tingkat') === 'Regional' ? 'selected' : '' }}>Regional (+140 Poin)</option>
                            <option value="Provinsi" {{ old('tingkat') === 'Provinsi' ? 'selected' : '' }}>Provinsi (+120 Poin)</option>
                            <option value="Universitas" {{ old('tingkat') === 'Universitas' ? 'selected' : '' }}>Universitas (+80 Poin)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori Bidang <span class="required">*</span></label>
                        <select id="kategori" name="kategori" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="Teknologi & Desain" {{ old('kategori') === 'Teknologi & Desain' ? 'selected' : '' }}>Teknologi & Desain</option>
                            <option value="Akademik & Sains" {{ old('kategori') === 'Akademik & Sains' ? 'selected' : '' }}>Akademik & Sains</option>
                            <option value="Karya Ilmiah" {{ old('kategori') === 'Karya Ilmiah' ? 'selected' : '' }}>Karya Ilmiah</option>
                            <option value="Wirausaha & Bisnis" {{ old('kategori') === 'Wirausaha & Bisnis' ? 'selected' : '' }}>Wirausaha & Bisnis</option>
                            <option value="Seni & Budaya" {{ old('kategori') === 'Seni & Budaya' ? 'selected' : '' }}>Seni & Budaya</option>
                            <option value="Olahraga" {{ old('kategori') === 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="peringkat">Capaian Prestasi <span class="required">*</span></label>
                        <select id="peringkat" name="peringkat" required>
                            <option value="" disabled selected>Pilih Capaian...</option>
                            <option value="Juara 1" {{ old('peringkat') === 'Juara 1' ? 'selected' : '' }}>Juara 1</option>
                            <option value="Juara 2" {{ old('peringkat') === 'Juara 2' ? 'selected' : '' }}>Juara 2</option>
                            <option value="Juara 3" {{ old('peringkat') === 'Juara 3' ? 'selected' : '' }}>Juara 3</option>
                            <option value="Juara Harapan 1" {{ old('peringkat') === 'Juara Harapan 1' ? 'selected' : '' }}>Juara Harapan 1</option>
                            <option value="Juara Harapan 2" {{ old('peringkat') === 'Juara Harapan 2' ? 'selected' : '' }}>Juara Harapan 2</option>
                            <option value="Finalis" {{ old('peringkat') === 'Finalis' ? 'selected' : '' }}>Finalis</option>
                            <option value="Best Speaker / Special Award" {{ old('peringkat') === 'Best Speaker / Special Award' ? 'selected' : '' }}>Special Award</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <!-- Section 3: Penyelenggara & Tanggal -->
            <fieldset class="form-section">
                <legend class="section-legend">
                    <span class="step-num">3</span>
                    <div>
                        <h2>Penyelenggara & Tanggal</h2>
                        <small>Instansi atau lembaga resmi yang mengadakan kegiatan</small>
                    </div>
                </legend>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label for="penyelenggara">Nama Penyelenggara <span class="required">*</span></label>
                        <input type="text" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}" placeholder="Contoh: Puspresnas Kemendikbudristek / Universitas Indonesia" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Pelaksanaan <span class="required">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Singkat / Tautan Portofolio (Opsional)</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Ceritakan sekilas mengenai kompetisi, judul karya atau tautan website/github proyek Anda...">{{ old('deskripsi') }}</textarea>
                </div>
            </fieldset>

            <!-- Section 4: Berkas Bukti & Sertifikat -->
            <fieldset class="form-section">
                <legend class="section-legend">
                    <span class="step-num">4</span>
                    <div>
                        <h2>Dokumen Bukti & Sertifikat</h2>
                        <small>Unggah dokumen pendukung untuk keperluan verifikasi resmi</small>
                    </div>
                </legend>

                <div class="upload-dropzone">
                    <input type="file" id="berkas" name="berkas" accept=".pdf,.jpg,.jpeg,.png">
                    <div class="dropzone-content">
                        <div class="dropzone-icon">
                            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        </div>
                        <strong>Klik untuk unggah atau seret berkas ke sini</strong>
                        <p>Format yang didukung: PDF, JPG, atau PNG (Maksimal 5MB)</p>
                    </div>
                </div>
            </fieldset>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('laporan') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-submit">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Kirim Prestasi untuk Diverifikasi</span>
                </button>
            </div>
        </form>
    </section>
@endsection
