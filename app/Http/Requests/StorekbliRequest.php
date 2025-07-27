<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorekbliRequest extends FormRequest
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
            'kode_kbli' => 'required|string|max:10|unique:kblis,kode_kbli',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:10',
            'id_perusahaan' => 'required|exists:perusahaans,id'
        ];
    }

    public function messages(): array
    {
        return [
            'kode_kbli.required' => 'Kode KBLI wajib diisi',
            'kode_kbli.unique' => 'Kode KBLI sudah ada',
            'judul.required' => 'Judul KBLI wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'kategori.required' => 'Kategori wajib dipilih',
            'id_perusahaan.required' => 'Perusahaan wajib dipilih',
            'id_perusahaan.exists' => 'Perusahaan tidak valid'
        ];
    }
}
