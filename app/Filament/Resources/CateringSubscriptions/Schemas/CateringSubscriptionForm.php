<?php

namespace App\Filament\Resources\CateringSubscriptions\Schemas;

use App\Models\CateringTier;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class CateringSubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                //
                Wizard::make([

                    Step::make('Product and Price')
                        ->icon('heroicon-m-shopping-bag')
                        ->completedIcon('heroicon-m-shopping-bag')
                        ->description('Which catering you choose')
                        ->schema([

                            Grid::make(2)
                                ->schema([
                                    Select::make('catering_package_id')
                                        ->relationship('cateringPackage', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $set('catering_tier_id', null);
                                            $set('price', null);
                                            $set('total_amount', null);
                                            $set('total_tax_amount', null);
                                            $set('quantity', null);
                                            $set('duration', null);
                                            $set('ended_at', null);
                                        }),


                                    Select::make('catering_tier_id')
                                        ->label('Catering Tier')
                                        ->options(function (callable $get) {
                                            $cateringPackageId = $get('catering_package_id');
                                            if ($cateringPackageId) {
                                                return CateringTier::where('catering_package_id', $cateringPackageId)
                                                    ->pluck('name', 'id');
                                            }
                                            return [];
                                        })
                                        ->searchable()
                                        ->required()
                                        ->live() // live digunakan untuk menggunakan afterStateUpdated
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $cateringTier = CateringTier::find($state);
                                            $price = $cateringTier ? $cateringTier->price : 0;

                                            $quantity = $cateringTier ? $cateringTier->quantity : 0;
                                            $duration = $cateringTier ? $cateringTier->duration : 0;

                                            $set('price', $price);
                                            $set('quantity', $quantity);
                                            $set('duration', $duration);

                                            $tax = 0.11;
                                            $totalTaxAmount = $tax * $price;

                                            $totalAmount = $price + $totalTaxAmount;
                                            $set('total_amount', number_format($totalAmount, 0, '', ''));
                                            $set('total_tax_amount', number_format($totalTaxAmount, 0, '', ''));
                                        }),

                                    TextInput::make('price')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),

                                    TextInput::make('total_amount')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('IDR'),

                                    TextInput::make('total_tax_amount')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->helperText('Pajak 11%')
                                        ->prefix('IDR'),

                                    TextInput::make('quantity')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('People'),

                                    TextInput::make('duration')
                                        ->required()
                                        ->readOnly()
                                        ->numeric()
                                        ->prefix('Days'),

                                    DatePicker::make('started_at')
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                            $duration = $get('duration') ?? 0;
                                            if ($state && $duration) {
                                                $endedAt = Carbon::parse($state)->addDays($duration);
                                                $set('ended_at', $endedAt->format('Y-m-d'));
                                            } else {
                                                $set('ended_at', null);
                                            }
                                        }),

                                    DatePicker::make('ended_at')
                                        ->required(),

                                ]), // Grid Closing
                        ]), // Step::make('Product and Price') closing

                    Step::make('Customer Information')
                        ->completedIcon('heroicon-m-hand-thumb-up')
                        ->description('For Our Marketing')
                        ->schema([

                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('phone')
                                        ->required()
                                        ->maxLength(255)
                                        ->tel(),

                                    TextInput::make('email')
                                        ->required()
                                        ->maxLength(255)
                                        ->email(),
                                ]),
                        ]), // Step::make('Customer Information') closing

                    Step::make('Delivery Information')
                        ->completedIcon('heroicon-m-hand-thumb-up')
                        ->description('Put your correct address')
                        ->schema([
                            Grid::make(2)
                                ->schema([

                                    TextInput::make('city')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('post_code')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('delivery_time')
                                        ->required()
                                        ->maxLength(255),

                                    Textarea::make('address')
                                        ->required()
                                        ->maxLength(255),

                                    Textarea::make('notes')
                                        ->required()
                                        ->maxLength(255),
                                ])
                        ]), // Step::make('Delivery Information') closing

                    Step::make('Payment Information')
                        ->completedIcon('heroicon-m-hand-thumb-up')
                        ->description('Put your correct address')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('booking_trx_id')
                                        ->required()
                                        ->maxLength(255),

                                    ToggleButtons::make('is_paid')
                                        ->required()
                                        ->label('Apakah sudah membayar?')
                                        ->boolean()
                                        ->grouped()
                                        ->icons([
                                            true => 'heroicon-o-pencil',
                                            false => 'heroicon-o-clock'
                                        ]),

                                    FileUpload::make('proof')
                                        ->required()
                                        ->disk('public')
                                        ->image(),
                                ])
                        ]), // Step::make('Payment Information') closing

                ])
                    ->columnSpan('full')
                    ->columns(1)
                    ->skippable(),
            ]);
    }
}
