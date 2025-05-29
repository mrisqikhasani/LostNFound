<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Claim;
use App\Models\Report;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Card::make('Total Laporan', Report::count())
                ->description('Semua Jumlah laporan yang masuk'),

            Card::make('Total Claim', Claim::count())
                ->description('Jumlah total yang diklaim'),
                
            Card::make('Total Users', User::count())
                ->description('Jumlah  user yang terdaftar'),
        ];
    }
}