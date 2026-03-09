<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Untuk UTS, boleh semua (atau pakai auth nanti)
    }

    public function rules(): array
    {
        $rules = [
            'judul'         => 'required|min:3|max:255',
            'penulis'       => 'required|min:3|max:255',
            'penerbit'      => 'required|max:255',
            'tahun_terbit'  => 'required|integer|min:1900|max:' . date('Y'),
            'jumlah_halaman'=> 'required|integer|min:1',
            'kategori'      => 'required',
            'stok'          => 'required|integer|min:0',
            'sinopsis'      => 'nullable|string',
            'sampul'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        // ISBN unique, kecuali saat update (ignore ID buku yang sedang diedit)
        if ($this->isMethod('POST')) {
            $rules['isbn'] = 'required|unique:bukus,isbn|max:20';
        } else {
            $rules['isbn'] = [
                'required',
                'max:20',
                Rule::unique('bukus', 'isbn')->ignore($this->route('buku')),
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'judul.required'         => 'Judul buku wajib diisi.',
            'judul.min'              => 'Judul minimal 3 karakter.',
            'penulis.required'       => 'Nama penulis wajib diisi.',
            'isbn.required'          => 'ISBN wajib diisi.',
            'isbn.unique'            => 'ISBN ini sudah terdaftar.',
            'tahun_terbit.min'       => 'Tahun terbit minimal 1900.',
            'tahun_terbit.max'       => 'Tahun terbit tidak boleh lebih dari tahun sekarang.',
            'sampul.image'           => 'File sampul harus berupa gambar.',
            'sampul.mimes'           => 'Format gambar yang diperbolehkan: jpeg, png, jpg.',
            'sampul.max'             => 'Ukuran file maksimal 2MB.',
        ];
    }
}