<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeInventarisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->route('daftar_inventari') !== null;

        return [
            'nama_inventaris' => 'required|string|max:255',
            'deskripsi_inventaris' => 'required|string|min:10',
            'kategori_inventaris_id' => 'required|exists:kategori_inventaris,id',
            'jumlah_inventaris' => 'required|integer|min:1',
            'harga_inventaris' => 'required|numeric|min:0',
            'sewa_inventaris' => 'required|numeric|min:0',
            'gambar_inventaris' => ($isUpdate ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_inventaris.required' => 'Nama Inventaris wajib diisi.',
            'nama_inventaris.string' => 'Nama Inventaris harus berupa string.',
            'nama_inventaris.max' => 'Nama Inventaris maksimal 255 karakter.',

            'deskripsi_inventaris.required' => 'Deskripsi Inventaris wajib diisi.',
            'deskripsi_inventaris.string' => 'Deskripsi Inventaris harus berupa string.',
            'deskripsi_inventaris.min' => 'Deskripsi Inventaris minimal 10 karakter.',

            'kategori_inventaris_id.required' => 'Kategori Inventaris wajib dipilih.',
            'kategori_inventaris_id.exists' => 'Kategori Inventaris tidak valid.',

            'jumlah_inventaris.required' => 'Jumlah Inventaris wajib diisi.',
            'jumlah_inventaris.integer' => 'Jumlah Inventaris harus berupa angka bulat.',
            'jumlah_inventaris.min' => 'Jumlah Inventaris minimal 1.',

            'harga_inventaris.required' => 'Harga Inventaris wajib diisi.',
            'harga_inventaris.numeric' => 'Harga Inventaris harus berupa angka.',
            'harga_inventaris.min' => 'Harga Inventaris minimal 0.',

            'sewa_inventaris.required' => 'Sewa Inventaris wajib diisi.',
            'sewa_inventaris.numeric' => 'Sewa Inventaris harus berupa angka.',
            'sewa_inventaris.min' => 'Sewa Inventaris minimal 0.',

            'gambar_inventaris.required' => 'Gambar Inventaris wajib diunggah.',
            'gambar_inventaris.image' => 'Gambar Inventaris harus berupa file gambar.',
            'gambar_inventaris.mimes' => 'Gambar Inventaris harus berformat jpeg, png, jpg, gif, atau svg.',
            'gambar_inventaris.max' => 'Gambar Inventaris maksimal berukuran 2048 KB.',
        ];
    }
}
