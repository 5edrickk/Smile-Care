@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#009CCF] focus:ring-[#009CCF] rounded-md shadow-xs']) }}>
