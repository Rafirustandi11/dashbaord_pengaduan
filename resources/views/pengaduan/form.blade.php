<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan Warga • DKIS Kota Cirebon</title>
</head>
<body class="bg-gray-100">

<div class="w-full max-w-lg bg-white shadow-2xl rounded-2xl p-8 border border-gray-100 animate-fadeInUp mx-auto mt-10">
    <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Isi Data Pengaduan Anda</h2>

    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-5">
        @foreach ($formFields as $field)
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $field->label }}</label>

                @if ($field->type === 'text' || $field->type === 'email')
                    <input type="{{ $field->type }}"
                        wire:model.defer="inputs.{{ $field->name }}"
                        placeholder="{{ $field->placeholder }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3" />

                @elseif ($field->type === 'textarea')
                    <textarea wire:model.defer="inputs.{{ $field->name }}"
                        placeholder="{{ $field->placeholder }}"
                        rows="4"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3"></textarea>

                @elseif ($field->type === 'select')
                    <select wire:model.defer="inputs.{{ $field->name }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3 bg-white">
                        <option value="">-- Pilih {{ $field->label }} --</option>
                        @foreach (json_decode($field->options ?? '[]', true) as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>

                @elseif ($field->type === 'file')
                    <input type="file"
                        wire:model="files.{{ $field->name }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 p-3" />
                    <div wire:loading wire:target="files.{{ $field->name }}" class="text-sm text-gray-500 mt-1">
                        ⏳ Mengupload...
                    </div>
                @endif

                @error('inputs.' . $field->name)
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('files.' . $field->name)
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        {{-- Tombol Kirim --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-black font-semibold py-3 rounded-lg shadow-md transition-all duration-200">
                <span wire:loading.remove>Kirim Laporan</span>
                <span wire:loading class="animate-pulse">Mengirim...</span>
            </button>
        </div>
    </form>

    <p class="text-center text-gray-400 text-xs mt-6">
        🔒 Data pribadi Anda bersifat rahasia dan hanya digunakan untuk keperluan tindak lanjut laporan.
    </p>
</div>

</body>

<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out;
}
</style>

</html>
