<div class="flex justify-between py-0.5">
    <span class="text-gray-500 {{ isset($bold) && $bold ? 'font-semibold' : '' }}">{{ $label }}</span>
    <span class="{{ isset($bold) && $bold ? 'font-bold' : 'font-medium' }} text-gray-900">{{ $value }}</span>
</div>
