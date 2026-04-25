<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermohonanRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            // Nama Pemohon
            'nama_pemohon' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[a-zA-Z\s\.\-\'éèêëàâäùûüôöœçñ]+$/', // Hanya huruf dan spasi, tanpa angka/simbol
            ],

            // Email
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],

            // Nomor Telepon
            'no_telepon' => [
                'required',
                'string',
                'regex:/^(\+62|0)[0-9]{9,12}$/', // Indonesia number format
                'min:10',
                'max:15',
            ],

            // Alamat
            'alamat' => [
                'required',
                'string',
                'min:10',
                'max:500',
            ],

            // Jenis Identitas
            'jenis_identitas' => [
                'required',
                'in:KTP,SIM,Paspor,KITAS,Surat Keterangan Lainnya',
            ],

            // Nomor Identitas
            'no_identitas' => [
                'required',
                'string',
                'min:5',
                'max:20',
                'regex:/^[0-9]+$/', // Hanya numeric
            ],

            // Informasi Diminta
            'informasi_diminta' => [
                'required',
                'string',
                'min:10',
                'max:2000',
            ],

            // Tujuan Penggunaan
            'tujuan_penggunaan' => [
                'required',
                'string',
                'min:5',
                'max:500',
            ],

            // Cara Mendapatkan Informasi
            'cara_mendapatkan' => [
                'required',
                'in:Pengambilan Langsung,Dimulai via Email,Faksimili,Pos',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            // Nama Pemohon
            'nama_pemohon.required' => 'Nama lengkap harus diisi.',
            'nama_pemohon.min' => 'Nama lengkap minimal 3 karakter.',
            'nama_pemohon.max' => 'Nama lengkap maksimal 255 karakter.',
            'nama_pemohon.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, dan tanda hubung.',

            // Email
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.regex' => 'Format email tidak sesuai standar.',
            'email.max' => 'Email maksimal 255 karakter.',

            // Nomor Telepon
            'no_telepon.required' => 'Nomor telepon harus diisi.',
            'no_telepon.regex' => 'Nomor telepon harus dimulai dengan +62 atau 0, diikuti 9-12 digit.',
            'no_telepon.min' => 'Nomor telepon minimal 10 karakter.',
            'no_telepon.max' => 'Nomor telepon maksimal 15 karakter.',

            // Alamat
            'alamat.required' => 'Alamat lengkap harus diisi.',
            'alamat.min' => 'Alamat minimal 10 karakter.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',

            // Jenis Identitas
            'jenis_identitas.required' => 'Jenis identitas harus dipilih.',
            'jenis_identitas.in' => 'Jenis identitas tidak valid.',

            // Nomor Identitas
            'no_identitas.required' => 'Nomor identitas harus diisi.',
            'no_identitas.min' => 'Nomor identitas minimal 5 digit.',
            'no_identitas.max' => 'Nomor identitas maksimal 20 digit.',
            'no_identitas.regex' => 'Nomor identitas hanya boleh berisi angka (numeric).',

            // Informasi Diminta
            'informasi_diminta.required' => 'Informasi yang diminta harus diisi.',
            'informasi_diminta.min' => 'Informasi yang diminta minimal 10 karakter.',
            'informasi_diminta.max' => 'Informasi yang diminta maksimal 2000 karakter.',

            // Tujuan Penggunaan
            'tujuan_penggunaan.required' => 'Tujuan penggunaan harus diisi.',
            'tujuan_penggunaan.min' => 'Tujuan penggunaan minimal 5 karakter.',
            'tujuan_penggunaan.max' => 'Tujuan penggunaan maksimal 500 karakter.',

            // Cara Mendapatkan
            'cara_mendapatkan.required' => 'Cara mendapatkan informasi harus dipilih.',
            'cara_mendapatkan.in' => 'Cara mendapatkan informasi tidak valid.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'nama_pemohon' => 'Nama Lengkap',
            'email' => 'Email',
            'no_telepon' => 'Nomor Telepon',
            'alamat' => 'Alamat Lengkap',
            'jenis_identitas' => 'Jenis Identitas',
            'no_identitas' => 'Nomor Identitas',
            'informasi_diminta' => 'Informasi yang Diminta',
            'tujuan_penggunaan' => 'Tujuan Penggunaan',
            'cara_mendapatkan' => 'Cara Mendapatkan Informasi',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama_pemohon'     => strip_tags(trim($this->input('nama_pemohon', ''))),
            'email'            => strtolower(strip_tags(trim($this->input('email', '')))),
            'no_telepon'       => preg_replace('/[^0-9+]/', '', $this->input('no_telepon', '')),
            'alamat'           => strip_tags(trim($this->input('alamat', ''))),
            'no_identitas'     => preg_replace('/[^0-9]/', '', $this->input('no_identitas', '')),
            'informasi_diminta' => strip_tags(trim($this->input('informasi_diminta', ''))),
            'tujuan_penggunaan' => strip_tags(trim($this->input('tujuan_penggunaan', ''))),
        ]);
    }

    private function sanitize(?string $input): string
    {
        $purifier = new \HTMLPurifier();
        return trim($purifier->purify($input ?? ''));
    }

    private function sanitizePlain(?string $input): string
    {
        return strip_tags(trim($input ?? ''));
    }
}
