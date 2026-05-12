@extends('admin.layout')

@section('content')
<section class="admin-page-header admin-page-header-row">
    <div>
        <div class="admin-kicker">{{ $config['title'] }}</div>
        <h1>{{ $config['title'] }} Manager</h1>
        <p>Create, update, and remove website content from this section.</p>
    </div>
    <a class="admin-button-link" href="{{ route('admin.create', $section) }}">Add New</a>
</section>

@if (session('success'))
    <div class="admin-success">{{ session('success') }}</div>
@endif

<section class="admin-panel">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    @foreach ($config['columns'] as $column)
                        <th>{{ str_replace('_', ' ', ucfirst($column)) }}</th>
                    @endforeach
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        @foreach ($config['columns'] as $column)
                            <td>
                                @if (is_bool($item->{$column} ?? null))
                                    {{ $item->{$column} ? 'Yes' : 'No' }}
                                @else
                                    {{ $item->{$column} ?? '-' }}
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <a href="{{ route('admin.edit', [$section, $item->id]) }}">Edit</a>
                            <form action="{{ route('admin.destroy', [$section, $item->id]) }}" method="POST" class="admin-inline-form" onsubmit="return confirm('Delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($config['columns']) + 1 }}" class="admin-empty">No records yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
