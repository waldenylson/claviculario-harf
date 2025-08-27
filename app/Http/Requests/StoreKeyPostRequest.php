<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeyPostRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'department_id' => 'required|exists:departments,id',
      'number' => 'required|integer|min:1|nullable|regex:/^\d+$/',
      'internal_hallway' => 'required|boolean',
      'eps' => 'required|boolean',
      'epms' => 'required|boolean',
      'comments' => 'nullable|string',
    ];
  }

  public function messages()
  {
    return [
      'department_id.required' => 'Seção é obrigatória!',
      'department_id.exists' => 'Selecione uma seção válida!',
      'number.required' => 'Número é obrigatório!',
      'number.integer' => 'Número deve ser um valor inteiro e não pode ser fracionado!',
      'number.min' => 'Número deve ser pelo menos 1!',
      'internal_hallway.required' => 'Corredor interno é obrigatório!',
      'internal_hallway.boolean' => 'Corredor interno deve ser verdadeiro ou falso!',
      'eps.required' => 'EPS é obrigatório!',
      'eps.boolean' => 'EPS deve ser verdadeiro ou falso!',
      'epms.required' => 'EPMS é obrigatório!',
      'epms.boolean' => 'EPMS deve ser verdadeiro ou falso!',
      'comments.string' => 'Comentários devem ser um texto válido!',
    ];
  }
}
