<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorePengeluaranRequest extends FormRequest
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
            'jumlah' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
            redirect()->route('dashboard.pengeluaran')->withInput()->withErrors([
                'jumlah' => 'Jumlah harus diisi', 
                'tanggal' => 'Tanggal harus diisi', 
                'keterangan' => 'Sumber dana harus diisi'
            ])
        );
    }
}
