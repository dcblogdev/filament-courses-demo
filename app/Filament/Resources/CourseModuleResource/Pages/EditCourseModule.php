<?php

namespace App\Filament\Resources\CourseModuleResource\Pages;

use App\Filament\Resources\CourseModuleResource;
use App\Models\CourseModule;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseModule extends EditRecord
{
    protected static string $resource = CourseModuleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    public function mount($record): void
    {
        $this->record = CourseModule::find($record);

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
