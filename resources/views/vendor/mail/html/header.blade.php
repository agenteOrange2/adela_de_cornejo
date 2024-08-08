@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'AdeladeCornejo')
<img src="https://adeladecornejo.com/build/img/logo-adela-black.png" class="logo" alt="Adela Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
