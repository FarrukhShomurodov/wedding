<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GuestsService
{
    public function store($validated): array
    {
        $guest = Guest::query()->create($validated);
        $guest->wedding()->attach($validated['wedding_id']);

        $qrCode =  QrCode::format('png')->size(300)->generate('test');
        $qrCodeBase64 = base64_encode($qrCode);
        return [
            $guest,
            $qrCodeBase64
        ];
    }

    public function update(Guest $guest, $validated): Guest
    {
        $guest->update($validated);

        return $guest->refresh();
    }

    public function destroy(Guest $guest): void
    {
        $guest->wedding()->detach($guest['wedding_id']);
        $guest->delete();
    }
}
