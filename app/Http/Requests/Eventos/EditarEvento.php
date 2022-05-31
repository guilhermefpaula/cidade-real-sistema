<?php

namespace App\Http\Requests\Eventos;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditarEvento extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $ignoreSelf = Rule::unique('cidade_real_eventos')->ignore($this->id);
        return [
            'titulo' => [$ignoreSelf, 'required', 'max:255'],
            'min_players'  => ['required'],
            'min_staffs' => ['required'],
            'frequencia' => ['nullable'],
            'backstory' => ['nullable'],
            'realizacao' => ['nullable'],
            'observacoes' => ['nullable'],
            'responsavel'  => ['required'],
            'status_evento' => ['nullable'],
            'proximo_evento' => ['nullable'],
            'tamanho' => ['nullable'],
            'regras' => ['nullable'],
            'premio' => ['nullable'],
            'vencedor' => ['nullable'],
        ];
    }
}
