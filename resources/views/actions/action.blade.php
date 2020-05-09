<div class="action" up-expand>

  <div class="date">
    <div class="day">
      {{$action->start->format('d')}}
    </div>
    <div class="month">
      {{$action->start->format('M')}}
    </div>
  </div>

  <div class="content">


    <div class="name mr-2">
      <a up-follow href="{{ route('groups.actions.show', [$action->group, $action]) }}">
        {{ $action->name }}
      </a>
    </div>
    <div class="tags">
      @if ($action->tags->count() > 0)
        @foreach ($action->tags as $tag)
          @include('tags.tag')
        @endforeach
      @endif
    </div>


    <div class="meta">
      {{$action->start->format('H:i')}} - {{$action->stop->format('H:i')}}, {{$action->location}}, {{ $action->group->name }}
    </div>
    <div class="summary">
      {{ summary($action->body) }}
    </div>



    <div>
      <div class="d-flex flex-wrap users mt-2 mb-2">
        @foreach($action->users as $user)
          <div class="mb-1">
            @include('users.user-avatar')
          </div>
        @endforeach
      </div>

      <div class="mb-2">
        @if (Auth::user() && Auth::user()->isAttending($action))
          <a class="btn btn-warning btn-sm" up-modal=".dialog" href="{{route('groups.actions.unattend', [$action->group, $action])}}">{{trans('messages.unattend')}}</a>
        @elseif (Auth::user() && !Auth::user()->isAttending($action))
          <a class="btn btn-success btn-sm" up-modal=".dialog" href="{{route('groups.actions.attend', [$action->group, $action])}}">{{trans('messages.attend')}}</a>
        @endif
      </div>
    </div>


  </div>


</div>
