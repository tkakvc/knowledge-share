<!--@if (count($users) > 0)-->
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p>
                        @if (count($knowledges) > 0)
                @foreach ($knowledges as $knowledge)
                    <div class="plan"> 
                        <h3>{!! link_to_route('knowledges.show', $knowledge->title, ['id' => $knowledge->id]) !!}</h3>
                        <p>分類</p>
                        <h4>{{ $knowledge->content }}</h4>
                        <p>{{  $knowledge->user_id  }}</p>
                    </div>
                @endforeach
            @endif
            {{ $knowledges->links('pagination::bootstrap-4') }}
            
            </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        
<!--@endif-->