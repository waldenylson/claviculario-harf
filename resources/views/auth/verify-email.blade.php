<x-guest-layout>
  <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('E-mail do usuário cadastrado não confirmado! Verificar seu endereço de e-mail clicando no link enviado! Se você não recebeu o e-mail, clique no botão abaixo!') }}
  </div>

  @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
      {{ __('Um novo link de verificação foi enviado para o e-mail cadastrado!') }}
    </div>
  @endif

  <div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf

      <div>
        <x-primary-button>
          {{ __('REENVIAR E-MAIL DE VERIFICAÇÃO') }}
        </x-primary-button>
      </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <button type="submit"
        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
        {{ __('Sair') }}
      </button>
    </form>
  </div>
</x-guest-layout>

