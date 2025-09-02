<?php

namespace App\Filament\Resources\CateringSubscriptions\Widgets;

use App\Models\CateringSubscription;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CateringSubscriptionStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalTransactions = CateringSubscription::count();
        $approvedTransactions = CateringSubscription::where('is_paid', true)->count();
        $totalRevenue = CateringSubscription::where('is_paid', true)->sum('total_amount');



        return [
            Stat::make('Total Transactions', $totalTransactions)
                ->description('All Transactions')
                ->descriptionicon('heroicon-o-currency-dollar'),

            Stat::make('Approved Transactions', $approvedTransactions)
                ->description('Approved Transactions')
                ->descriptionicon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Total Revenue', 'IDR ' . number_format($totalRevenue))
                ->description('Revenue from approved transactions')
                ->descriptionicon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
