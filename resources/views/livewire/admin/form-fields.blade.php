<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Kelola Form Pengaduan</h2>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.form-fields.trash') }}"
                class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition
                bg-red-500 hover:bg-red-600 text-white shadow-md">
                🗑️ Sampah
            </a>

            <button wire:click="resetInput"
                class="px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition
                bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white shadow-md">
                ➕ Tambah Field
            </button>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session()->has('message'))
        <div class="bg-green-100 dark:bg-green-900 dark:text-green-200 border border-green-200 
            dark:border-green-700 text-green-700 rounded-lg p-3 shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    {{-- FORM INPUT --}}
    <div class="bg-white dark:bg-gray-900 dark:border-gray-700 p-6 rounded-xl shadow-md border border-gray-100">
        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}"
            class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Label --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Label</label>
                <input type="text" wire:model="label"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 
                    dark:text-gray-200 p-2.5"
                    placeholder="Contoh: Nama Warga">
                @error('label')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Nama Field</label>
                <input type="text" wire:model="name"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 
                    dark:text-gray-200 p-2.5"
                    placeholder="nama_warga">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Tipe</label>
                <select wire:model="type"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 
                    dark:text-gray-200 p-2.5">
                    <option value="text">Text</option>
                    <option value="email">Email</option>
                    <option value="textarea">Textarea</option>
                    <option value="select">Select</option>
                    <option value="file">File</option>
                </select>
            </div>

            {{-- Placeholder --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Placeholder</label>
                <input type="text" wire:model="placeholder"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 
                    dark:text-gray-200 p-2.5">
            </div>

            {{-- Required --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" wire:model="required"
                    class="rounded border-gray-300 dark:border-gray-600 text-blue-600 dark:bg-gray-700">
                <label class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Wajib Diisi?</label>
            </div>

            {{-- Active --}}
            <div class="flex items-center gap-2">
                <input type="checkbox" wire:model="active"
                    class="rounded border-gray-300 dark:border-gray-600 text-blue-600 dark:bg-gray-700">
                <label class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Aktif?</label>
            </div>

            {{-- Order --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Urutan</label>
                <input type="number" wire:model="order"
                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 
                    dark:text-gray-200 p-2.5">
            </div>

            {{-- Buttons --}}
            <div class="col-span-2 flex gap-2 pt-2">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md">
                    {{ $updateMode ? 'Update Field' : 'Tambah Field' }}
                </button>

                @if ($updateMode)
                    <button type="button" wire:click="resetInput"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg font-semibold shadow-md">
                        Batal
                    </button>
                @endif
            </div>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-gray-900 dark:border-gray-700 rounded-xl shadow-md border border-gray-100 overflow-hidden mt-6">

        <table class="w-full text-sm text-gray-700 dark:text-gray-300">
            <thead class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Drag</th>
                    <th class="px-4 py-3 text-left">Label</th>
                    <th class="px-4 py-3 text-left">Tipe</th>
                    <th class="px-4 py-3 text-center">Wajib</th>
                    <th class="px-4 py-3 text-center">Aktif</th>
                    <th class="px-4 py-3 text-center">Order</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody wire:sortable="updateOrder" wire:sortable.options="{ animation: 200 }">
                @forelse ($fields as $field)
                    <tr wire:sortable.item="{{ $field->id }}"
                        class="border-b border-gray-200 dark:border-gray-700 
                               hover:bg-blue-50 dark:hover:bg-gray-800 transition-all">

                        <td wire:sortable.handle class="px-4 py-3 cursor-grab text-gray-600 dark:text-gray-400 hover:text-blue-600">
                            ☰
                        </td>

                        <td class="px-4 py-3 font-semibold">{{ $field->label }}</td>
                        <td class="px-4 py-3">{{ ucfirst($field->type) }}</td>

                        <td class="px-4 py-3 text-center">
                            {!! $field->required
                                ? '<span class="text-green-600 font-bold">✔</span>'
                                : '<span class="text-gray-400">✖</span>' !!}
                        </td>

                        <td class="px-4 py-3 text-center">
                            {!! $field->active
                                ? '<span class="text-green-600 font-bold">✔</span>'
                                : '<span class="text-gray-400">✖</span>' !!}
                        </td>

                        <td class="px-4 py-3 text-center">{{ $field->order }}</td>

                        <td class="px-4 py-3 text-center flex justify-center gap-3">
                            <button wire:click="edit({{ $field->id }})"
                                class="text-blue-600 hover:text-blue-800">
                                ✏️
                            </button>

                            <button wire:click="delete({{ $field->id }})"
                                class="text-red-600 hover:text-red-800">
                                🗑️
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400 italic">
                            Belum ada field yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>
