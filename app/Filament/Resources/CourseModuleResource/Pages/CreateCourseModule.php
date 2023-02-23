<?php

namespace App\Filament\Resources\CourseModuleResource\Pages;

use App\Filament\Resources\CourseModuleResource;
use App\Models\CourseModule;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseModule extends CreateRecord
{
    protected static string $resource = CourseModuleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): CourseModule
    {
        $attributes = [
            'course_id' => $data['course_id'],
            'title'     => $data['title']
        ];

        return CourseModule::create($attributes);
    }
}
