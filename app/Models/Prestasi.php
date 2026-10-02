<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'mahasiswa',
        'prodi',
        'judul',
        'kategori',
        'tingkat',
        'peringkat',
        'penyelenggara',
        'tanggal',
        'tahun',
        'poin',
        'status',
        'catatan',
        'berkas',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'poin' => 'integer',
        'verified_at' => 'datetime',
    ];

    /**
     * Format tanggal saat diakses untuk tampilan UI (contoh: 18 Mei 2024)
     */
    public function getTanggalAttribute($value): string
    {
        if (empty($value)) {
            return '-';
        }
        try {
            return \Carbon\Carbon::parse($value)->translatedFormat('d M Y');
        } catch (\Throwable $e) {
            return (string) $value;
        }
    }

    /**
     * Mutator agar tanggal tersimpan dalam format Y-m-d standar database
     */
    public function setTanggalAttribute($value): void
    {
        $this->attributes['tanggal'] = date('Y-m-d', strtotime($value));
    }

    /**
     * Standar bobot poin berdasarkan tingkat kompetisi
     */
    public const POIN_MAP = [
        'Internasional' => 250,
        'Nasional' => 200,
        'Regional' => 140,
        'Provinsi' => 120,
        'Universitas' => 80,
    ];

    /**
     * Relasi ke User (pemilik prestasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke User verifikator (Admin HIMATRIS)
     */
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Scope prestasi terverifikasi
     */
    public function scopeVerified($query)
    {
        return $query->where('status', 'Terverifikasi');
    }

    /**
     * Scope prestasi yang menunggu verifikasi
     */
    public function scopePending($query)
    {
        return $query->where('status', 'Menunggu Verifikasi');
    }

    /**
     * Helper untuk menghitung poin dari tingkat lomba
     */
    public static function calculatePoints(string $tingkat): int
    {
        return self::POIN_MAP[$tingkat] ?? 100;
    }
}
