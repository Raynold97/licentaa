@inject('markdown', 'Parsedown')
@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
@endphp
<div>
 <div id="comment-{{ $comment->getKey() }}" class="media" @if($comment->child_id!=NULL) style="margin-left: 150px;" @endif>
       @if($comment->guest_name)
       <img class="mr-3" src="/images/default.jpg" style="width: 50px">
       @else
      
           <img class="mr-3" src="/images/{{$comment->commenter->imagine}}" style="width:75px; height:75px" alt="{{ $comment->commenter->UserName ?? $comment->guest_name }} ">
    {{-- ?? $comment->guest_name --}}
        @endif 
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $comment->commenter->UserName ?? $comment->guest_name }} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
        <div  style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div>

        <div>
            @can('reply-to-comment', $comment)
                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.reply')</button>
            @endcan
        </div>
        
          @if($comment->comment_image!=NULL)   
        <img style="width:800px; height:800px" src="/storage/comment_images/{{$comment->comment_image}}">
           

          @endif   
         
    </div>
</div>
        <div>
            @can('edit-comment', $comment)
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" @if($comment->child_id!=NULL) style="margin-left: 150px; @endif class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.edit')</button>
            @endcan
            
            @can('delete-comment', $comment)
                <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="btn btn-sm btn-link text-danger text-uppercase">@lang('comments::comments.delete')</a>
                <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            @endcan
        </div>

        @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                            @method('PUT')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">@lang('comments::comments.update_your_message_here')</label>
                                    <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                    <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.update')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

         @can('reply-to-comment', $comment)
            <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                                    <textarea required class="form-control" name="message" rows="3"></textarea>
                                    <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan 

        <br />{{-- Margin bottom --}}

        <?php
            if (!isset($indentationLevel)) {
                $indentationLevel = 1;
            } else {
                $indentationLevel++;
            }
        ?>

        {{-- Recursion for children --}}
         @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
            {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
             @foreach($grouped_comments[$comment->getKey()] as $child)
                @include('comments::_comment', [
                    'comment' => $child,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif 

    
{{-- <div>
    {!! Form::open(['action' => 'App\Http\Controllers\ContinutController@imagineComentariu', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    
      
    <div class="form-group">
        {{Form::file('cover_image')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!} 
 
     </div>
</div> --}}
{{-- 
    <form class="form-horizontal poststars" action="{{route('postStar', $continut->id)}}" id="addStar" method="POST">
        {{ csrf_field() }}
              <div class="form-group required">
                <div class="col-sm-12">
                  <input class="star star-5" value="5" id="star-5" type="radio" name="star"/>
                  <label class="star star-5" for="star-5"></label>
                  <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
                  <label class="star star-4" for="star-4"></label>
                  <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
                  <label class="star star-3" for="star-3"></label>
                  <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
                  <label class="star star-2" for="star-2"></label>
                  <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
                  <label class="star star-1" for="star-1"></label>
                 </div>
              </div>
      </form>
      <script>
        $('#addStar').change('.star', function(e) {
        $(this).submit();
        });
    </script> --}}
</div>

{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
    {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
    @foreach($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments
        ])
    @endforeach
@endif