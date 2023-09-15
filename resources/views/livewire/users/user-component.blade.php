<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
  <div>
    <div class="flex items-center justify-between">
      <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
        Tabla de Usuarios
      </h2>
      <div class="flex gap-2">
          {{-- Buscador --}}
        @include('commons.search')

        <div class="inline-flex">
          {{-- Modal Crear usuario --}}
          <livewire:users.user-create />
          <div @notification.window="$notification({text:$event.detail.message,variant:'success',position:'center-top'})"></div>
        </div>
      </div>
    </div>
    {{-- Tabla usuario --}}
    <div class="card mt-3">
      <div
        class="is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th
                class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Id
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Nombre
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Usuario
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Documento
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Rol
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Estado
              </th>
              <th
                class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
              <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $user->id }}</td>
                <td class="whitespace-nowrap px-3 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">{{ $user->name }}</td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $user->username }}</td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $user->dni }}</td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                @if ($user->role == 'administrador')
                  <div class="badge rounded-full bg-secondary/10 text-secondary dark:bg-secondary-light/15 dark:text-secondary-light">
                    Administrador
                  </div>
                @else
                  <div class="badge rounded-full bg-info/10 text-info dark:bg-info/15">
                    Técnico
                  </div>
                @endif
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  @if (is_null($user->deleted_at))
                      <div class="badge bg-success text-white">Activo</div>
                  @else
                      <div class="badge bg-error text-white">Inactivo</div>
                  @endif
                </td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <span>
                    <div class="flex justify-start space-x-2">
                      <button 
                        x-tooltip.info="'Editar'"
                        wire:click="$emitTo('users.user-edit', 'edit', {{ $user->id }})" 
                        class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
                      >
                        <i class="fa fa-edit"></i>
                      </button>

                      @if ( is_null($user->deleted_at) )
                      <button 
                        x-tooltip.error="'Dar de Baja'"
                        wire:click="$emitTo('users.user-delete', 'delete', {{ $user->id }})" 
                        class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25"
                      >
                        <i class="fa fa-trash-alt"></i>
                      </button>
                      @else
                      <button 
                        x-tooltip.error="'Dar de Alta'"
                        wire:click="$emitTo('users.user-delete', 'restore', {{ $user->id }})"
                        class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
                      >
                        <i class="fa fa-trash-restore-alt"></i>
                      </button>  
                      @endif  
                    </div>
                  </span>
                </td>
              </tr>   
            @empty
                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                    <td class="whitespace-nowrap px-3 py-3 font-medium text-center text-slate-700 dark:text-navy-100 lg:px-5 w-full" colspan="7">
                        No se encontraron registros coincidentes para lo que buscas
                    </td>
                </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    
      {{-- Paginacion --}}
      {{ $users->links() }}
    </div>
  </div>
</div>