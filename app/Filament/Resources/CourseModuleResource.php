<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseModuleResource\Pages;
use App\Filament\Resources\CourseModuleResource\RelationManagers;
use App\Filament\Resources\Insight\CourseModuleResource\Pages\ListModules;
use App\Models\CourseModule;
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

class CourseModuleResource extends Resource
{
    protected static ?string $model = CourseModule::class;

    protected static ?string $slug                     = 'courses/modules';
    protected static bool    $shouldRegisterNavigation = false;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('course_id', request('record'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Module details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')->required(),
                                Hidden::make('course_id')->default(request('record')),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('course.title')->sortable()->searchable(),
            ])
            ->actions([
                Action::make('units')->url(fn($record): string => url('admin/courses/modules/units/'.$record->id)),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListCourseModules::route('/'),
            'edit'    => Pages\EditCourseModule::route('/{record}/edit'),
            'modules' => Pages\ListCourseModules::route('/{record}'),
            'create'  => Pages\CreateCourseModule::route('/{record}/create'),
        ];
    }
}
