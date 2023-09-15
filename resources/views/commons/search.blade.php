<div class="flex items-center" x-data="{isInputActive:false}">
    <label class="block">
        <input
        x-effect="isInputActive === true && $nextTick(() => { $el.focus()});"
        :class="isInputActive ? 'w-32 lg:w-48' : 'w-0'"
        class="form-input bg-transparent px-1 text-right transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
        placeholder="Buscar..."
        type="text"
        wire:model='search'
        />
    </label>
    <button
        @click="isInputActive = !isInputActive"
        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
    >
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-4.5 w-4.5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.5"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
        />
        </svg>
    </button>
</div>