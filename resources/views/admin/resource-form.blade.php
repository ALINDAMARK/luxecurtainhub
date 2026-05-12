@extends('admin.layout')

@section('content')
<section class="admin-page-header admin-page-header-row">
    <div>
        <div class="admin-kicker">{{ $config['title'] }}</div>
        <h1>{{ $item ? 'Edit' : 'Create' }} {{ $config['title'] }}</h1>
    </div>
    <a class="admin-button-link" href="{{ route('admin.index', $section) }}">Back to List</a>
</section>

@if ($errors->any())
    <div class="admin-error-box">
        Please fix the highlighted fields and try again.
    </div>
@endif

<section class="admin-panel">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="admin-form-grid">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        @foreach ($config['fields'] as $field)
            <div class="admin-field admin-field-{{ $field['type'] }}">
                <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>

                @if ($field['type'] === 'textarea')
                    <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}">{{ old($field['name'], data_get($item, $field['name'])) }}</textarea>
                @elseif ($field['type'] === 'select')
                    <select id="{{ $field['name'] }}" name="{{ $field['name'] }}">
                        <option value="">Select...</option>
                        @foreach ($field['options'] as $value => $label)
                            <option value="{{ $value }}" @selected(old($field['name'], data_get($item, $field['name'])) == $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                @elseif ($field['type'] === 'checkbox')
                    <div class="admin-checkbox-row">
                        <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="checkbox" value="1" @checked(old($field['name'], data_get($item, $field['name'], false)))>
                        <span>Enabled</span>
                    </div>
                @elseif ($field['type'] === 'file')
                    <input type="file" name="image_file" id="image_file" accept="image/*">
                    @if ($item && data_get($item, 'image_url'))
                        <img src="{{ data_get($item, 'image_url') }}" alt="Current image" class="admin-preview">
                    @endif
                @else
                    <input
                        id="{{ $field['name'] }}"
                        name="{{ $field['name'] }}"
                        type="{{ $field['type'] }}"
                        value="{{ old($field['name'], data_get($item, $field['name'])) }}"
                        @if (!empty($field['step'])) step="{{ $field['step'] }}" @endif
                    >
                @endif

                @error($field['name'])
                    <div class="admin-field-error">{{ $message }}</div>
                @enderror
                @if ($field['type'] === 'file')
                    @error('image_file')
                        <div class="admin-field-error">{{ $message }}</div>
                    @enderror
                @endif
            </div>
        @endforeach

        <div class="admin-form-actions">
            <button type="submit" class="admin-button">Save</button>
        </div>
    </form>
</section>
@endsection
