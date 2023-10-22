<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        @foreach($breadcrumb_items as $item)
            <li class="breadcrumb-item {{ $item['is_active'] ? 'active' : '' }}" aria-current="page">
                {{ $item['text'] }}
            </li>
        @endforeach
    </ol>
</nav>
