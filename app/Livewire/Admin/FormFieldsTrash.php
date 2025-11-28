<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\FormField;

class FormFieldsTrash extends Component
{
    public function render()
    {
        return view('livewire.admin.form-fields-trash', [
            'fields' => FormField::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ])->layout('layouts.admin', [
            'title' => 'Sampah Form Fields',
        ]);
    }

    public function restore($id)
    {
        FormField::withTrashed()->find($id)?->restore();
        session()->flash('message', 'Field berhasil dipulihkan!');
    }

    public function forceDelete($id)
    {
        FormField::withTrashed()->find($id)?->forceDelete();
        session()->flash('message', 'Field telah dihapus permanen!');
    }

    public function emptyTrash()
    {
        FormField::onlyTrashed()->forceDelete();
        session()->flash('message', 'Semua field di sampah telah dihapus permanen!');
    }
}
