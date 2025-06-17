<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateperusahaanRequest extends FormRequest
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
            'nama_perusahaan' => 'required|string|max:255',
            'nib' => ['required', 'regex:/^[0-9]{13}$/'],
            'notaris' => 'required|string|max:255',
            'npwp' => ['required', 'regex:/^\d{2}\.\d{3}\.\d{3}\.\d{1}-\d{3}\.\d{3}$/'],
            'deskripsi' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'alamat_kantor' => 'required|string',
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'no_telpon' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'instagram' => ['required', 'regex:/^[a-zA-Z0-9._]+$/'],
            'facebook' => ['required', 'regex:/^[a-zA-Z0-9._]+$/'],
            'tiktok' => ['required', 'regex:/^[a-zA-Z0-9._]+$/'],
            'twitter' => ['required', 'regex:/^[a-zA-Z0-9._]+$/'],
            'moto' => 'required|string|max:255',
            'visi' => 'required|string|max:255',
            'misi' => 'required|string|max:255',
            'status' => 'required|in:anak,induk',
            'logo_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'logo_website' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'nib.regex' => 'Format NIB harus 13 digit angka',
            'npwp.regex' => 'Format NPWP harus sesuai format XX.XXX.XXX.X-XXX.XXX',
            'email.regex' => 'Format email tidak valid',
            'no_telpon.regex' => 'Format nomor telepon harus 10-15 digit angka',
            'instagram.regex' => 'Format username Instagram tidak valid',
            'facebook.regex' => 'Format username Facebook tidak valid',
            'tiktok.regex' => 'Format username TikTok tidak valid',
            'twitter.regex' => 'Format username Twitter tidak valid',
            'logo_utama.max' => 'Ukuran file logo utama maksimal 5MB',
            'logo_website.max' => 'Ukuran file logo website maksimal 5MB',
        ];
    }
}