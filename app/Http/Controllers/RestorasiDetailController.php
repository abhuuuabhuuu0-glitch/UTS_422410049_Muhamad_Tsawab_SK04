<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestorasiDetailRequest;
use App\Models\Restorasi;
use App\Models\RestorasiDetail;
use App\Services\RestorasiService;
use Illuminate\Http\RedirectResponse;

class RestorasiDetailController extends Controller
{
    public function __construct(private readonly RestorasiService $service)
    {
    }

    public function store(RestorasiDetailRequest $request, Restorasi $restorasi): RedirectResponse
    {
        $this->service->tambahDetail($restorasi, $request->validated());

        return redirect()->route('restorasi.show', $restorasi)->with('success', 'Tahap restorasi ditambahkan.');
    }

    public function update(RestorasiDetailRequest $request, Restorasi $restorasi, RestorasiDetail $detail): RedirectResponse
    {
        abort_unless($detail->restorasi_id === $restorasi->id, 404);

        $this->service->ubahDetail($detail, $request->validated());

        return redirect()->route('restorasi.show', $restorasi)->with('success', 'Tahap restorasi diperbarui.');
    }

    public function destroy(Restorasi $restorasi, RestorasiDetail $detail): RedirectResponse
    {
        abort_unless($detail->restorasi_id === $restorasi->id, 404);

        $this->service->hapusDetail($detail);

        return redirect()->route('restorasi.show', $restorasi)->with('success', 'Tahap restorasi dihapus.');
    }
}
