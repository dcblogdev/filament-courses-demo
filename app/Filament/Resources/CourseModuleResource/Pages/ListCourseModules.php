<?php

namespace App\Filament\Resources\CourseModuleResource\Pages;

use App\Filament\Resources\CourseModuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseModules extends ListRecords
{
    protected static string $resource = CourseModuleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->url(fn (): string => url('admin/courses/modules/'.request('record').'/create')),
        ];
    }
}
