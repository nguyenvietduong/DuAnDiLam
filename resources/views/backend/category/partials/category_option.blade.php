@php
$indentation = str_repeat('-- ', $level ?? 0);
@endphp

<option value="{{ $category->id }}" {{ $category->id == old('parent_id') ? 'selected' : '' }}
    @if (isset($categories) && isset($cate))
    {{ $category->id == $category->parent_id ? 'selected' : '' }}
    @endif>
    {{ $indentation }}{{ $category->name }}
</option>

@if ($category->children->isNotEmpty())
@foreach ($category->children as $child)
@include('backend.category.partials.category_option', ['category' => $child, 'level' => ($level ?? 0) + 1])
@endforeach
@endif