<?php

namespace App\Services\Faq;

use App\Models\Faq;

class FaqService
{
    public function store($validated)
    {
        return Faq::query()->create($validated);
    }

    public function update(Faq $faq, $validated)
    {
        $faq->update($validated);

        return $faq->refresh();
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
    }
}
