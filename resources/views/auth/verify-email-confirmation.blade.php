<x-guest-layout>
  <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('E-mail do usuário cadastrado confirmado! Clique no botão abaixo!') }}
  </div>



  <div class="mt-4 flex items-center justify-between">
    <form method="GET" action="/">
      @csrf

      <div>
        <x-primary-button>
          {{ __('PAGINA DE LOGIN') }}
        </x-primary-button>
      </div>
    </form>


  </div>
</x-guest-layout>

