<?php

namespace App\Repositories\Faq;

use App\Models\FaqCategory;

class FaqCategoryRepository
{
    public function get()
    {
        return FaqCategory::all();
    }

    public function show(FaqCategory $faqCategory)
    {
        return $faqCategory;
    }
}
