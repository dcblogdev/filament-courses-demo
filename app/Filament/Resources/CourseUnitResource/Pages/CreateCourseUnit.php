<?php

namespace App\Filament\Resources\CourseUnitResource\Pages;

use App\Filament\Resources\CourseUnitResource;
use App\Models\CourseModule;
use App\Models\CourseUnit;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseUnit extends CreateRecord
{
    protected static string $resource = CourseUnitResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): CourseUnit
    {
        $module = CourseModule::findOrFail($data['module_id']);

        $attributes = [
            'course_id' => $module->course_id,
            'module_id' => $module->id,
            'title'     => $data['title']
        ];

        return CourseUnit::create($attributes);
    }
}
