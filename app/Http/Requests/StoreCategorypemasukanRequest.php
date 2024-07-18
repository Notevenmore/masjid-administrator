<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCategorypemasukanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->admin->status && (Auth::user()->admin->role === "Bendahara" || Auth::user()->admin->role === "Ketua DKM");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoryname' => 'required',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            redirect()->route('dashboard.pemasukan')->withInput()->withErrors([
                'categoryname' => 'Nama kategori harus diisi',
            ])
        );
    }
}
