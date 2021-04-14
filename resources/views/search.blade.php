@extends('layouts.app')

@section('content')


{{-- //<h1>Postarile care contin cuvantul cheie sunt<h1> --}}

  @if(count($continut)>0)
  <h1 style="text-align: center"><b>S-au gasit {{count($continut)}} postari!</b><h1>
  @foreach ($continut as $post)
     <div class="card p-3 mt-3 mb-3" style="height: 140px;padding-top:20px">
        <div class="row">
            <div class="col-md-2 col-sm-2" style="background: rgb(250, 250, 250); text-align:center;height: 110px;width:110px">
                <img style="height:80%;width:80%" src="/storage/cover_images/{{$post->cover_image}}">
            </div>
            <div class="col-md-9 col-sm-9"  style="height: 110px">
               <h4><a href="/continut/{{$post->id}}"> {{$post->titlu}}</a></h4>
                  <h6  >Postat la <b>{{$post->created_at}}</b></h6>
                 <h6 style="height: 10px" >Postat de <b>{!!$post->user->UserName!!}</b></h6>
              
                   <?php $c = 0; ?>
                  @foreach ($comentarii as $coment)
                    @if($coment->commentable_id==$post->id)
                    <?php $c++; ?>
                  
                  @endif
               @endforeach
               @if($c!=1)
                   <b><h5><a style="color: green" href="/continut/{{$post->id}}"><b>{!!$c, ' comentarii'!!}</b></a></h5></b>
                @else
                   <b><h5><a style="color: green" href="/continut/{{$post->id}}"><b>{!!$c, ' comentariu'!!}</b></a></h5></b>  
               {{-- {!!$c, ' comentarii'!!} --}}
               @endif
       

                </div>
         
       
       
      
           
       </div>
      </div>
     
  @endforeach
    {{-- {{$continut1->links('pagination::bootstrap-4')}} --}}
@else
  <p> Nu exista postari</p>
@endif

    

    

    

@endsection