<?php

namespace App\Services\Faq;

use App\Models\FaqCategory;

class FaqCategoryService
{
    public function store($validated)
    {
        return FaqCategory::query()->create($validated);
    }

    public function update(FaqCategory $faqCategory, $validated)
    {
        $faqCategory->update($validated);

        return $faqCategory->refresh();
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->faq()->delete();
        $faqCategory->delete();
    }
}
