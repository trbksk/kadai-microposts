@if (count($microposts) > 0)
    <ul class="list-unstyled">
        @foreach ($microposts as $micropost)
            <li class="media mb-2">
                <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $micropost->user->name, ['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    <div class="row mt-2">
                        <div>
                            @if (Auth::id() == $micropost->user_id)
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger ml-2']) !!}
                            {!! Form::close() !!}
                            @endif
                        </div>
                        <div>
                            <!--お気に入りボタン-->
                            @include('favorites.favorite_button', ['microposts' => $microposts])
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif