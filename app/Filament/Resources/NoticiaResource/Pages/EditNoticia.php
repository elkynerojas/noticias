<?php

namespace App\Filament\Resources\NoticiaResource\Pages;

use App\Filament\Resources\NoticiaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNoticia extends EditRecord
{
    protected static string $resource = NoticiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Asegurar que la imagen se guarde con la ruta correcta
        if (isset($data['imagen']) && $data['imagen']) {
            // Si es una ruta relativa, convertirla a absoluta
            if (!filter_var($data['imagen'], FILTER_VALIDATE_URL)) {
                $data['imagen'] = url('images/' . $data['imagen']);
            }
        }

        return $data;
    }
}
