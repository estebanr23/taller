<div x-data="{ showModal: @entangle('showModal') }">
  <form wire:submit.prevent>
      <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" x-show="showModal" role="dialog" @keydown.window.escape="showModal = false">
          <div class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300" @click="showModal = false" x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
          <div class="relative flex w-full max-w-lg origin-top flex-col overflow-hidden rounded-lg bg-white transition-all duration-300 dark:bg-navy-700" x-show="showModal" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="easy-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
              <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                Modificar Dispositivo
              </h3>
              <button @click="showModal = !showModal" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>
            <div class="flex flex-col overflow-y-auto px-4 py-4 sm:px-5">
  
              <div class="space-y-4">
                <label class="block">
                  <span>Número de serie</span>
                  <input wire:model.defer="serial_number" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Nombre del modelo" type="text">
                  @error('serial_number') <span class="text-error">{{ $message }}</span> @enderror
                </label>

                @if (!$showNewTypeInput)
                <label class="block">
                  <span>Tipo:</span>
                  <div class="flex justify-between align-middle gap-2">
                    <select
                      class="mt-1.5 w-full"
                      x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                      wire:model="type_device_id"
                    >
                        <option value="" disabled>-- Seleccionar un tipo --</option>
                      @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                      @endforeach
                    </select>
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-primary p-0 font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90"
                      wire:click="toggleNewTypeInput"
                      x-tooltip.light="'Ingresar nuevo tipo'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                      </svg>
                    </button>
                  </div>
                  @error('type_device_id') <span class="text-error">{{ $message }}</span> @enderror
                </label>    
                @else
                <label class="block">
                  <span>Tipo Dispositivo:</span>
                  <div class="flex justify-between align-middle gap-2">
                    <input wire:model.defer="type_name" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Ingrese el nombre para el nuevo tipo de dispositivo" type="text">
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-success p-0 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"
                      wire:click="storeNewType"
                      x-tooltip.light="'Registrar tipo'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                      </svg>
                    </button>
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-error p-0 font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90"
                      wire:click="toggleNewTypeInput"
                      x-tooltip.light="'Volver a listado de tipos'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18 6l-12 12"></path>
                        <path d="M6 6l12 12"></path>
                      </svg>
                    </button>
                  </div>
                  @if($errors->has('type_name'))
                    <span class="text-error">{{ $errors->first('type_name') }}</span>
                  @endif
                </label>
                @endif

                @if (!$showNewBrandInput)
                <label class="block">
                  <span>Marca:</span>
                  <div class="flex justify-between align-middle gap-2">
                    <select
                      class="mt-1.5 w-full"
                      x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                      wire:model="brand_id"
                    >
                        <option value="" disabled>-- Seleccionar una marca --</option>
                      @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                      @endforeach
                    </select>
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-primary p-0 font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90"
                      wire:click="toggleNewBrandInput"
                      x-tooltip.light="'Ingresar nueva marca'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                      </svg>
                    </button>
                  </div>
                  @error('brand_id') <span class="text-error">{{ $message }}</span> @enderror
                </label>
                @else
                <label class="block">
                  <span>Marca:</span>
                  <div class="flex justify-between align-middle gap-2">
                    <input wire:model.defer="brand_name" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Ingrese el nombre para la nueva marca" type="text">
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-success p-0 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"
                      wire:click="storeNewBrand"
                      x-tooltip.light="'Registrar marca'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                      </svg>
                    </button>
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-error p-0 font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90"
                      wire:click="toggleNewBrandInput"
                      x-tooltip.light="'Volver a listado de marcas'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18 6l-12 12"></path>
                        <path d="M6 6l12 12"></path>
                      </svg>
                    </button>
                  </div>
                  @if($errors->has('brand_name'))
                    <span class="text-error">{{ $errors->first('brand_name') }}</span>
                  @endif
                </label>  
                @endif

                @if (!$showNewModelInput)
                <label class="block">
                  <span>Modelo:</span>
                  <div class="flex justify-between align-middle gap-2">
                    <select
                      class="mt-1.5 w-full"
                      x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                      wire:model="model_id"
                    >
                        <option value="" disabled>-- Seleccionar un modelo --</option>
                      @foreach ($models as $model)
                        <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                      @endforeach
                    </select>
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-primary p-0 font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90"
                      wire:click="toggleNewModelInput"
                      x-tooltip.light="'Ingresar nuevo modelo'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 5l0 14"></path>
                        <path d="M5 12l14 0"></path>
                      </svg>
                    </button>
                  </div>
                  @error('model_id') <span class="text-error">{{ $message }}</span> @enderror
                </label>
                @else
                <label class="block">
                  <span>Modelo:</span>
                  <div class="flex justify-between align-middle gap-2">
                    <input wire:model.defer="model_name" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Ingrese el nombre del nuevo modelo" type="text">
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-success p-0 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"
                      wire:click="storeNewModel"
                      x-tooltip.light="'Registrar modelo'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                      </svg>
                    </button>
                    <button
                      class="btn h-9 w-9 mt-1.5 bg-error p-0 font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90"
                      wire:click="toggleNewModelInput"
                      x-tooltip.light="'Volver a listado de modelos'"
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M18 6l-12 12"></path>
                        <path d="M6 6l12 12"></path>
                      </svg>
                    </button>
                  </div>
                  @if($errors->has('model_name'))
                    <span class="text-error">{{ $errors->first('model_name') }}</span>
                  @endif
                </label>  
                @endif
  
                <div class="space-x-2 text-right">
                  <button 
                      wire:click="close"
                      class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                  >
                    Cancelar
                  </button>

                  <button 
                      type="submit"
                      wire:click="update"
                      wire:loading.attr="disabled"
                      class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                  >
                    Actualizar
                  </button>
                </div>
  
              </div>
            </div>
          </div>
      </div>
  </form>
</div>

