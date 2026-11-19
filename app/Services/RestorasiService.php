<?php

namespace App\Services;

use App\Models\Pita;
use App\Models\Restorasi;
use App\Models\RestorasiDetail;
use Illuminate\Support\Facades\DB;

class RestorasiService
{
    /** Membuat proyek restorasi dan menautkan peralatan (pilihan jamak). */
    public function create(array $data, array $peralatanIds = []): Restorasi
    {
        return DB::transaction(function () use ($data, $peralatanIds) {
            $restorasi = Restorasi::create($data);
            $restorasi->peralatan()->sync($peralatanIds);

            return $restorasi->load('pita', 'teknisi', 'peralatan');
        });
    }

    public function update(Restorasi $restorasi, array $data, array $peralatanIds = []): Restorasi
    {
        return DB::transaction(function () use ($restorasi, $data, $peralatanIds) {
            $restorasi->update($data);
            $restorasi->peralatan()->sync($peralatanIds);

            return $restorasi->refresh();
        });
    }

    /**
     * Mengubah status restorasi. Saat selesai, kondisi pita diperbarui menjadi "baik"
     * dan tanggal selesai dicatat; semua dilakukan atomik dalam satu transaksi.
     */
    public function ubahStatus(Restorasi $restorasi, string $status): Restorasi
    {
        return DB::transaction(function () use ($restorasi, $status) {
            $restorasi->status = $status;
            $restorasi->tanggal_selesai = $status === 'selesai' ? now()->toDateString() : null;
            $restorasi->save();

            if ($status === 'selesai') {
                Pita::whereKey($restorasi->pita_id)->update(['kondisi' => 'baik']);
            }

            return $restorasi;
        });
    }

    /** Menambah tahap detail; restorasi "menunggu" otomatis menjadi "proses". */
    public function tambahDetail(Restorasi $restorasi, array $data): RestorasiDetail
    {
        return DB::transaction(function () use ($restorasi, $data) {
            $detail = $restorasi->detail()->create($data);

            if ($restorasi->status === 'menunggu') {
                $restorasi->update(['status' => 'proses']);
            }

            return $detail;
        });
    }

    public function ubahDetail(RestorasiDetail $detail, array $data): RestorasiDetail
    {
        return DB::transaction(function () use ($detail, $data) {
            $detail->update($data);

            return $detail->refresh();
        });
    }

    public function hapusDetail(RestorasiDetail $detail): void
    {
        DB::transaction(fn () => $detail->delete());
    }

    public function delete(Restorasi $restorasi): void
    {
        DB::transaction(function () use ($restorasi) {
            $restorasi->peralatan()->detach();
            $restorasi->detail()->delete();
            $restorasi->delete();
        });
    }
}
