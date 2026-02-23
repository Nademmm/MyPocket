@props(['align'=>'right','width'=>'48'])
<div class="relative" x-data="{open:false}" @click.outside="open=false">
    <div @click="open=!open">
        {{ $trigger }}
    </div>
    <div x-show="open" class="absolute z-50 mt-2 w-{{ $width }} rounded-md shadow-lg bg-black text-white" style="display:none;">
        {{ $content }}
    </div>
</div>
