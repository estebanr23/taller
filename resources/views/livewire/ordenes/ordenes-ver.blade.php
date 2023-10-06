<div x-data="{ showModal: @entangle('showModal') }">
    <form wire:submit.prevent>
        <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
            x-show="showModal" role="dialog" @keydown.window.escape="showModal = false">
            <div class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300" @click="showModal = false"
                x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"></div>
            <div class="relative flex w-full max-w-2xl origin-top flex-col overflow-hidden rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
                x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="easy-in"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Ver Orden
                    </h3>
                    <button @click="showModal = !showModal"
                        class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
                    <div class="space-y-4">

                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Cliente
                        </p>
                        <div class="mt-4 space-y-4">

                                <label class="block sm:col-span-2">
                                    <span>DNI</span>
                                    <div class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full  rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="DNI" type="text" value="{{ $DNI }}" wire:model="DNI"
                                            id="DNI" disabled />
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                </label>



                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <label class="block">
                                    <span> Nombre</span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            value="{{ $nombre_cliente }}" wire:model="nombre_cliente" id="nombre_cliente"
                                            placeholder="Nombre" type="text" disabled/>
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="far fa-user text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span> Apellido</span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            value="{{ $apellido_cliente }}" wire:model="apellido_cliente" id="apellido_cliente"
                                            placeholder="Apellido" type="text" disabled/>
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="far fa-user text-base"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span> Numero de telefono</span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="(999) 999-9999" type="text" value="{{ $telefono }}"
                                            wire:model="telefono" id="telefono"
                                            x-input-mask="{numericOnly: true, blocks: [0, 3, 3, 4], delimiters: ['(', ') ', '-']}" disabled/>
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                    </span>
                                </label>

                                <label class="block">
                                    <span> Secretaria:</span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            type="text" value="{{ $secretaria_nombre }}"
                                            wire:model.defer="secretaria_nombre" id="secretaria_nombre" disabled/>
                                    </span>
                                  </label>

                                <label class="block">
                                  <span> Area:</span>
                                  <span class="relative mt-1.5 flex">
                                      <input
                                          class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                          type="text" value="{{$area_nombre}}"
                                          wire:model.defer="area_nombre" id="area_nombre" disabled/>
                                  </span>
                                </label>

                                <label class="block" >
                                    <span>Legajo</span>
                                    <div class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="Legajo" type="text" value="{{ $legajo }}" wire:model="legajo"
                                            id="legajo" disabled/>
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fas fa-file"></i>
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Equipos
                        </p>

                        @if ($orden_creada == 'Taller')
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <label class="block">
                                <span>Tipo</span>
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="tipo" wire:model="tipo" type="text" disabled/>
                            </label>


                                <label class="block">
                                    <span>Marca</span>
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="marca" wire:model="marca" type="text" disabled/>
                                </label>
                            </div>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                                <label class="block sm:col-span-6">
                                    <span>Modelo</span>
                                    <input
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="modelo" wire:model="modelo" type="text" disabled/>
                                </label>
                            </div>
                            <label class="block">
                                <span>Accesorios</span>
                                <textarea rows="4" placeholder="" wire:model="accesorios"
                                    class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                </textarea>
                            </label>    
                        @endif
                        
                        <label class="block">
                            <span>Falla</span>
                            <textarea rows="4" placeholder="Falla" wire:model="falla"
                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                            </textarea>
                        </label>
                        <label class="block">
                            <span>Informe cliente</span>
                            <textarea rows="4" placeholder="" wire:model="informe_cliente"
                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" disabled></textarea>
                            @error('informe_cliente')
                                <span class="text-error">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="block">
                            <span>Informe Tecnico</span>
                            <textarea rows="4" placeholder="" wire:model="informe_tecnico"
                                class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" disabled></textarea>
                        </label>


                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                          Tecnico
                      </p>
                      <div class="mt-4 space-y-4">
                          <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                              <label class="block sm:col-span-6">
                                  <span>Receptor:</span>
                                  <div class="flex justify-between align-middle gap-2">
                                    <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="" wire:model="receptor" type="text" disabled /></div>
                              </label>
                              <label class="block sm:col-span-6">
                                  <span>Tecnico asignado:</span>
                                  <div class="flex justify-between align-middle gap-2">
                                    <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="" wire:model="tecnico" type="text" disabled/></div>
                                  </div>
                              </label>
                          </div>
                          <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                              <label class="block sm:col-span-6">
                                  <span> Fecha de emision</span>
                                  <span class="relative mt-1.5 flex">
                                      <input wire:model="fecha_emision"
                                          class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                          type="date" disabled/>
                                  </span>
                              </label>
                              <label class="block sm:col-span-6">
                                    <span> Fecha prometida</span>
                                    <span class="relative mt-1.5 flex">
                                        <input wire:model="fecha_prometida"
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            type="date" disabled/>
                                    </span>
                               </label>
                               <label class="block sm:col-span-6">
                                <span> Fecha de entrega</span>
                                <span class="relative mt-1.5 flex">
                                    <input wire:model="fecha_entrega"
                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        type="date" disabled/>
                                </span>
                           </label>
                              <label class="block sm:col-span-6">
                                  <span>Tipo de orden:</span>
                                  <div class="flex justify-between align-middle gap-6">
                                    <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="" wire:model="tipo_orden" type="text"disabled />
                                  </div>
                              </label>
                              <label class="block sm:col-span-6">
                                  <span>Estado de la orden:</span>
                                  <div class="flex justify-between align-middle gap-6">
                                    <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="" wire:model="estado" type="text" disabled/>
                                  </div>
                              </label>
                              <label class="block sm:col-span-6">
                                  <span>Ticket:</span>
                                  <div class="flex justify-between align-middle gap-6">
                                    <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="" wire:model="ticket" type="text" disabled/>
                                  </div>
                              </label>
                              @if ($orden_creada == 'Domicilio')
                                <label class="block sm:col-span-6">
                                    <p>Cosulta remota</p>
                                    <input
                                        wire:model="consulta"
                                        class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-slate-500 checked:border-slate-500 hover:border-slate-500 focus:border-slate-500 dark:border-navy-400 dark:checked:bg-navy-400"
                                        type="checkbox"
                                        disabled/>
                                </label>
                              @endif
                          </div>

                        <button wire:click="close"
                            class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                            Cerrar
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>












