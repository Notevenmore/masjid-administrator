<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UpdateInformasikegiatanRequest extends FormRequest
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
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            redirect(URL::previous())->withInput()->withErrors([
                'tanggal' => 'Tanggal harus diisi',
                'name' => 'Nama kegiatan harus diisi',
                'deskripsi' => 'deskripsi kegiatan harus diisi',
                'penanggungjawab' => 'penanggung jawab kegiatan harus diisi',
            ])
        );
    }
}
