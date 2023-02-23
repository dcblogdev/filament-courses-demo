<?php

namespace App\Filament\Resources\CourseUnitResource\Pages;

use App\Filament\Resources\CourseUnitResource;
use App\Models\CourseUnit;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCourseUnit extends EditRecord
{
    protected static string $resource = CourseUnitResource::class;

    public function mount($record): void
    {
        $this->record = CourseUnit::find($record);

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $course = CourseUnit::findOrFail($record->getKey());
        $course->title = $data['title'];
        $course->save();

        return CourseUnit::find($record->getKey());
    }
}
