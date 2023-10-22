<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 p-0">
        @foreach($breadcrumb_items as $item)
            <li class="breadcrumb-item {{ $item['is_active'] ? 'active' : '' }}" aria-current="page">
                {{ $item['text'] }}
            </li>
        @endforeach
    </ol>
    <h6 class="font-weight-bolder mb-0">{{ $breadcrumb_items[count($breadcrumb_items)-1]['text'] }}</h6>
</nav>
