<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center  px-5 py-2.5 me-2 mb-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
