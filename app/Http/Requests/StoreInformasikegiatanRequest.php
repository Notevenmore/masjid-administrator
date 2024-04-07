<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class StoreInformasikegiatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->admin->status;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal' => 'required',
            'name' => 'required',
            'deskripsi' => 'required',
            'penanggungjawab' => 'required',
            'image' => 'mimes:jpg,png',
            'document' => 'mimes:docx,pdf'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            redirect()->route('informasikegiatan.create')->withInput()->withErrors([
                'tanggal' => 'Tanggal harus diisi',
                'name' => 'Nama kegiatan harus diisi',
                'deskripsi' => 'deskripsi kegiatan harus diisi',
                'penanggungjawab' => 'penanggung jawab kegiatan harus diisi',
                'image' => 'file yang diupload harus bertipe JPG atau PNG',
                'document' => 'file yang diupload harus bertipe DOCX atau PDF'
            ])
        );
    }
}
