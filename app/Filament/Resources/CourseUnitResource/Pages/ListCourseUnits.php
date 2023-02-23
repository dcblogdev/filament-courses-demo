<?php

namespace App\Filament\Resources\CourseUnitResource\Pages;

use App\Filament\Resources\CourseUnitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseUnits extends ListRecords
{
    protected static string $resource = CourseUnitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->url(fn (): string => url('admin/courses/modules/units/'.request('record').'/create')),
        ];
    }
}
