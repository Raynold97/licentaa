@extends('layouts.app')

@section('content')


   {{-- <a href="/continut" class="btn btn-primary btn-lg" style="padding: 25px">Go Back</a>
    <br>
       <br> --}}

       <?php

 $cap = DB::table('categoriicontinut')->where('continut_id',$continut->id)->get(); ?>

<a href="/continut" class="btn btn-primary"> Inapoi </a>
<hr>

{{-- @foreach ($cap as $item)  
<?php
 $cat1 =  DB::table('categorii')->where('id',$item->categorii_id)->get();?>

@foreach($cat1 as $m)
<div style="display:inline-block">
{!! Form::open(['action' => 'App\Http\Controllers\ContinutController@categorii_index', 'method'=>'POST']) !!}


<button type="submit" class="btn btn-primary" name ={{$m->id}} value ={{$m->id}}>{{$m->nume}}</button>

{!! Form::close() !!}
@endforeach
</div>
@endforeach --}}

{{-- <div>
  @php
  var_dump($utilizator);
@endphp
</div> --}}
   <div> 
 {{-- <h1 >Postat de {!!$utilizator[0]->name!!}</h1> --}}
      <small >Postat de {!!$continut->user->UserName!!}</small>
         <br>
      <small>Postat la {{$continut->created_at}}</small>
    </div>
        <hr>
     <h1 style="text-align: center" color="blue">{{$continut->titlu}}</h1> 

     <p style="text-align:center;">
      @if($continut->cover_image!='noimage.jpg')
      <img style="width:50%;margin-left=100px" class="center" src="/storage/cover_images/{{$continut->cover_image}}">
        @endif
    </p>
            <br>
              <br>
      <h3   style="font-weight: bold">Descriere</h3>

<hr>
      <div>
        {!!$continut->descriere!!}
      </div>
      
     @if(!Auth::guest())
      @if(Auth::user()->id == $continut->idUtilizator)
        
      <a href="/continut/{{$continut->id}}/edit"  class="btn btn-primary"  >Edit</a>

        {!!Form::open(['action' => ['App\Http\Controllers\ContinutController@destroy' , $continut->id],'method' => 'POST' ,'style'=>'float:right', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'bnt btn-danger ', 'style'=> 'float: right'])}}
        {!!Form::close()!!}
      
         @endif
     @endif
    
     <br>
     <br>
     <h1 style="color:DodgerBlue;text-align:center">Comentarii</h1>
     <div>
        
        @comments(['model' => $continut])
    
    </div> 
          
   
@endsection