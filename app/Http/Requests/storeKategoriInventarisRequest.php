<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeKategoriInventarisRequest extends FormRequest
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
        return [
            'nama_kategori' => 'required|string|unique:kategori_inventaris,nama_kategori|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama Kategori Inventaris wajib diisi.',
            'nama_kategori.string' => 'Nama Kategori Inventaris harus berupa string.',
            'nama_kategori.unique' => 'Nama Kategori Inventaris sudah ada.',
            'nama_kategori.max' => 'Nama Kategori Inventaris maksimal 255 karakter.',
        ];
    }
}