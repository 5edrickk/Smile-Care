<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#009CCF] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#066586] focus:bg-[#066586] active:bg-[#066586] focus:outline-hidden focus:ring-2 focus:ring-[#066586] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
