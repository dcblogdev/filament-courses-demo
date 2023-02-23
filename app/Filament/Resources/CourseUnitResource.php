<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseUnitResource\Pages;
use App\Filament\Resources\CourseUnitResource\RelationManagers;
use App\Models\CourseUnit;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseUnitResource extends Resource
{
    protected static ?string $model = CourseUnit::class;

    protected static ?string $slug                     = 'courses/modules/units';
    protected static bool    $shouldRegisterNavigation = false;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('module_id', request('record'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Unit details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')->required(),
                                Hidden::make('module_id')->default(request('record')),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('module.course.name'),
                Tables\Columns\TextColumn::make('module.title'),
            ])
            ->actions([
                Action::make('units')->url(fn($record): string => url('admin/courses/modules/'.$record->id)),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseUnits::route('/'),
            'modules' => Pages\ListCourseUnits::route('/{record}'),
            'modules/units' => Pages\CreateCourseUnit::route('/create'),
            'edit' => Pages\EditCourseUnit::route('/{record}/edit'),
        ];
    }    
}
