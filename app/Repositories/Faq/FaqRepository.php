<?php

namespace App\Repositories\Faq;

use App\Models\Faq;
use App\Models\FaqCategory;

class FaqRepository
{
    public function get()
    {
        return Faq::all();
    }

    public function show(Faq $faq)
    {
        return $faq;
    }

    public function byCategory(FaqCategory $faqCategory)
    {
        return $faqCategory->faq();
    }
}
