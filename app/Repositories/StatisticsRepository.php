<?php

namespace App\Repositories;

use App\Models\Guest;
use App\Models\User;
use App\Models\Wedding;
use Illuminate\Support\Facades\DB;

class StatisticsRepository
{
    public function statisticsForAdmin(): array
    {
        $userCount = User::query()->count();
        $weddingCount = Wedding::query()->count();
        $guestCount = Guest::query()->count();

        $averageGuestsPerWedding = Wedding::query()->withCount('guest')
            ->get()
            ->avg('guest_count');

        $averageUsersPerPlan = DB::table('subscriptions')
            ->select('plan_id', DB::raw('COUNT(user_id) as user_count'))
            ->groupBy('plan_id')
            ->get()
            ->avg('user_count');

        $averageCommentsPerWedding = Wedding::query()->withCount('comment')
            ->get()
            ->avg('comment_count');

        $averageEventPerWedding = Wedding::query()->withCount('event')
            ->get()
            ->avg('event_count');

        $averageGalleryPerWedding = Wedding::query()->withCount('gallery')
            ->get()
            ->avg('gallery_count');

        $averageHistoryPerWedding = Wedding::query()->withCount('history')
            ->get()
            ->avg('history_count');

        $dateWithMostWeddings = Wedding::select('date_time', DB::raw('COUNT(*) as wedding_count'))
            ->groupBy('date_time')
            ->orderByDesc('wedding_count')
            ->first();

        return [
            "Обшое количество Пользователей: " => $userCount,
            "Обшое количество свадебв: " => $weddingCount,
            "Обшое количество гостей: " => $guestCount,
            "Среднее количество гостей на свадьбу: " => $averageGuestsPerWedding,
            "Среднее количество пользователей на план: " => $averageUsersPerPlan,
            "Среднее количество комментариев на свадьбу: " => $averageCommentsPerWedding,
            "Среднее количество событий на свадьбу: " => $averageEventPerWedding,
            "Среднее количество галерии на свадьбу: " => $averageGalleryPerWedding,
            "Среднее количество истории на свадьбу: " => $averageHistoryPerWedding,
            "Дата с наибольшим количеством свадеб: " => $dateWithMostWeddings->date_time,
        ];
    }
}
