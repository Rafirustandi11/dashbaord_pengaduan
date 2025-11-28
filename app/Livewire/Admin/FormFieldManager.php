<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\FormField;

class FormFieldManager extends Component
{
    public $field_id;
    public $label;
    public $name;
    public $type = 'text';
    public $placeholder;
    public $required = false;
    public $active = true;
    public $order;
    public $options;
    public $updateMode = false;

    // TAB (active / trash)
    public $tab = 'active';

    public function render()
    {
        return view('livewire.admin.form-fields', [
            'fields' => FormField::orderBy('order')->get(),
            'trashCount' => FormField::onlyTrashed()->count(),
        ])->layout('layouts.admin', [
            'title' => 'Kelola Form Pengaduan',
        ]);
    }

    public function switchTab($tab)
    {
        $this->tab = $tab;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->field_id = null;
        $this->label = '';
        $this->name = '';
        $this->type = 'text';
        $this->placeholder = '';
        $this->required = false;
        $this->active = true;
        $this->order = '';
        $this->options = '';
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate([
            'label' => 'required',
            'name'  => 'required',
        ]);

        $lastOrder = FormField::max('order') ?? 0;
        $this->order = $this->order ?: $lastOrder + 1;

        FormField::create([
            'label'       => $this->label,
            'name'        => $this->name,
            'type'        => $this->type,
            'placeholder' => $this->placeholder,
            'required'    => $this->required,
            'active'      => $this->active,
            'order'       => $this->order,
            'options'     => $this->type === 'select'
                ? json_encode(array_map('trim', explode(',', $this->options)))
                : null,
        ]);

        session()->flash('message', 'Field berhasil ditambahkan!');
        $this->resetInput();
    }

    public function edit($id)
    {
        $field = FormField::findOrFail($id);

        $this->field_id = $id;
        $this->label = $field->label;
        $this->name = $field->name;
        $this->type = $field->type;
        $this->placeholder = $field->placeholder;
        $this->required = $field->required;
        $this->active = $field->active;
        $this->order = $field->order;
        $this->options = $field->options
            ? implode(', ', json_decode($field->options, true))
            : '';

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'label' => 'required',
            'name'  => 'required',
        ]);

        $field = FormField::findOrFail($this->field_id);

        $field->update([
            'label'       => $this->label,
            'name'        => $this->name,
            'type'        => $this->type,
            'placeholder' => $this->placeholder,
            'required'    => $this->required,
            'active'      => $this->active,
            'order'       => $this->order ?? 0,
            'options'     => $this->type === 'select'
                ? json_encode(array_map('trim', explode(',', $this->options)))
                : null,
        ]);

        session()->flash('message', 'Field berhasil diperbarui!');
        $this->resetInput();
    }

    public function delete($id)
    {
        FormField::find($id)?->delete();
        session()->flash('message', 'Field dipindahkan ke sampah!');
    }

    public function restore($id)
    {
        FormField::withTrashed()->find($id)?->restore();
        session()->flash('message', 'Field berhasil dipulihkan!');
    }

    public function forceDelete($id)
    {
        FormField::withTrashed()->find($id)?->forceDelete();
        session()->flash('message', 'Field dihapus permanen!');
    }

    public function emptyTrash()
    {
        FormField::onlyTrashed()->forceDelete();
        session()->flash('message', 'Semua data sampah sudah dihapus permanen!');
    }

    // DRAG & DROP REORDER
    public function updateOrder($orderData)
    {
        foreach ($orderData as $item) {
            FormField::find($item['value'])?->update(['order' => $item['order']]);
        }
    }
}
