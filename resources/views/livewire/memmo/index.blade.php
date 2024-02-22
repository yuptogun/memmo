<div>
    @if ($memmos->isNotEmpty())
    <dl>
        @foreach ($memmos as $memmo)
        <dt><strong>{{ $memmo->title }}</strong></dt>
        <dd>{!! nl2br($memmo->content) !!} - {{ $memmo->timestamp }}</dd>
        @endforeach
    </dl>
    {{ $memmos->links() }}
    @else
    <h3>y u no memo</h3>
    @endif
</div>
