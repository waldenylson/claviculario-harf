<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersPostRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Manipula os dados de entrada antes de aplicar as regras de validação.
   */
  protected function prepareForValidation()
  {
    if ($this->filled('email')) {
      $email = $this->input('email');
      $this->merge([
        'name' => explode('@', $email)[0],
      ]);
    }
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $rules = [
      'full_name'  => 'required|min:10',
      'service_name'    => 'required|min:3',
      'military_rank'    => 'required|min:5',
      'military_unit' => 'required|min:4',
      'electronic_signature' => 'required',
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required',

    ];

    if ($this->isMethod('post')) {
      // Regras para criação
      $rules['electronic_signature'] = 'required|min:6|max:6|regex:/^\d+$/';
      $rules['password'] = 'required|confirmed|min:6';
    } else if ($this->isMethod('put') || $this->isMethod('patch')) {
      // Regras para atualização
      $rules['electronic_signature'] = 'nullable';
      $rules['password'] = 'nullable';
    }

    return $rules;
  }

  public function messages()
  {
    return [
      'full_name.required'  => 'Nome Completo é Obrigatório!',
      'full_name.min'  => 'Nome Completo deve ter pelo menos :min caracteres!',
      'service_name.required'  => 'Nome de Guerra é Obrigatório!',
      'service_name.min'  => 'Nome de Guerra deve ter pelo menos :min caracteres!',
      'military_rank.required'  => 'Posto/Graduação Esp é Obrigatório!',
      'military_rank.min'  => 'Posto/Graduação deve ter pelo menos :min caracteres!',
      'military_unit.required' => 'Unidade Militar é Obrigatório',
      'military_unit.min' => 'Unidade Militar deve ter pelo menos :min caracteres!',
      'electronic_signature.required' => 'Assinatura eletrônica é Obrigatório',
      'name.required' => 'Erro ao processar email!',
      'email.required'  => 'E-Mail é Obrigatório!',
      'phone.required'  => 'Tel. Contato é Obrigatório!',
      'password.required'  => 'Senha é Obrigatório!',
      'password.confirmed'  => 'Senhas não coincidem!',
      'password.min'  => 'Senha deve ter pelo menos :min caracteres!',
      'electronic_signature.required'  => 'Assinatura Eletrônica é Obrigatório!',
      'electronic_signature.min'  => 'Assinatura Eletrônica deve ter :min caracteres!',
      'electronic_signature.max'  => 'Assinatura Eletrônica deve ter :max caracteres!',
      'electronic_signature.regex'  => 'Assinatura Eletrônica deve conter apenas números!',
    ];
  }

  private function sanitizeValues($value)
  {
    $value = trim($value);
    $value = str_replace(".", "", $value);
    $value = str_replace(",", "", $value);
    $value = str_replace("-", "", $value);

    return $value;
  }
}
