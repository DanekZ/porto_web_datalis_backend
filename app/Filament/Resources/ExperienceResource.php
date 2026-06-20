<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Experiences';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('company')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('position')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->required()
                ->rows(4)
                ->columnSpanFull(),

            Forms\Components\DatePicker::make('start_date')
                ->required(),

            Forms\Components\DatePicker::make('end_date')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('company')
                ->searchable(),
            Tables\Columns\TextColumn::make('position')
                ->searchable(),
            Tables\Columns\TextColumn::make('start_date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('end_date')
                ->date()
                ->sortable(),
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}