<?php

namespace App\Http\Controllers;

use App\Models\KategoriPita;
use App\Models\Pita;
use App\Models\Restorasi;
use App\Models\Teknisi;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $statistik = [
            'pita' => Pita::count(),
            'restorasi_aktif' => Restorasi::whereIn('status', ['menunggu', 'proses'])->count(),
            'selesai' => Restorasi::where('status', 'selesai')->count(),
            'teknisi' => Teknisi::count(),
            'total_biaya' => (float) Restorasi::where('status', 'selesai')->sum('biaya'),
        ];

        $perKategori = KategoriPita::withCount('pita')->orderByDesc('pita_count')->get();

        $perStatus = collect(Restorasi::STATUS)->map(
            fn ($label, $key) => ['label' => $label, 'jumlah' => Restorasi::where('status', $key)->count()]
        )->values();

        $terbaru = Restorasi::with(['pita', 'teknisi'])->latest()->take(5)->get();

        return view('dashboard.index', compact('statistik', 'perKategori', 'perStatus', 'terbaru'));
    }
}
