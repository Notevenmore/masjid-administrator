<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\URL;

class UpdateAsetRequest extends FormRequest
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
            'name' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'kondisi' => 'required'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            redirect(URL::previous())->withInput()->withErrors([
                'name' => 'Nama aset harus diisi', 
                'jumlah' => 'Jumlah aset harus diisi', 
                'satuan' => 'Satuan yang digunakan harus diisi',
                'kondisi' => 'Kondisi aset harus diisi'
            ])
        );
    }
}
