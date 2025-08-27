<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEfetivoPostRequest extends FormRequest
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
    $rules = [
      'name'  => 'required|min:10',
      'department_id'    => 'required',
      'military'    => 'required',
      'electronic_signature' => 'required',
      'email' => 'email',
      'phone' => 'required',
      'extension' => 'min:4|nullable|regex:/^\d+$/',
    ];

    if ($this->isMethod('post')) {
      // Regras para criação
      $rules['electronic_signature'] = 'required|min:6|max:6|regex:/^\d+$/';
    } else if ($this->isMethod('put') || $this->isMethod('patch')) {
      // Regras para atualização
      $rules['electronic_signature'] = 'nullable|min:6|max:6|regex:/^\d+$/';
    }

    return $rules;
  }

  public function messages()
  {
    return [
      'name.required'  => 'Nome Completo é Obrigatório!',
      'name.min'  => 'Nome Completo deve ter pelo menos :min caracteres!',
      'milirary.required'  => 'Definir se Militar/Civil é Obrigatório!',
      'department_id.required'  => 'Seção é Obrigatório!',
      'phone.required'  => 'Tel. Contato é Obrigatório!',
      'electronic_signature.required'  => 'Assinatura Eletrônica é Obrigatório!',
      'electronic_signature.min'  => 'Assinatura Eletrônica deve ter :min caracteres!',
      'electronic_signature.max'  => 'Assinatura Eletrônica deve ter :max caracteres!',
      'electronic_signature.regex'  => 'Assinatura Eletrônica deve conter apenas números!',
      'extension.regex'  => 'Ramal deve conter apenas números!',
      'extension.min'  => 'Ramal deve ter pelo menos :min caracteres!',
    ];
  }
}
