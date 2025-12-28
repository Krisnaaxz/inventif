<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storePeminjamanRequest extends FormRequest
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
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after_or_equal:waktu_mulai',
            'keperluan' => 'required|string|max:1000',
            'inventaris_ids' => 'required|array|min:1',
            'inventaris_ids.*' => 'exists:inventaris,id',
            'surat_pengajuan' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Format tanggal mulai tidak valid.',
            'tanggal_mulai.after_or_equal' => 'Tanggal mulai harus hari ini atau setelahnya.',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.date' => 'Format tanggal selesai tidak valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'waktu_selesai.after_or_equal' => 'Waktu selesai harus setelah atau sama dengan waktu mulai.',
            'keperluan.required' => 'Keperluan wajib diisi.',
            'keperluan.string' => 'Keperluan harus berupa teks.',
            'keperluan.max' => 'Keperluan maksimal :max karakter.',
            'inventaris_ids.required' => 'Pilih minimal satu barang.',
            'inventaris_ids.array' => 'Data inventaris tidak valid.',
            'inventaris_ids.min' => 'Pilih minimal satu barang.',
            'inventaris_ids.*.exists' => 'Barang yang dipilih tidak ditemukan.',
            'surat_pengajuan.file' => 'Surat pengajuan harus berupa file.',
            'surat_pengajuan.mimes' => 'Surat pengajuan harus berformat PDF.',
            'surat_pengajuan.max' => 'Ukuran surat pengajuan maksimal :max KB.',
        ];
    }
}
