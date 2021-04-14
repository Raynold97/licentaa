@extends('layouts.app')

@section('content')

<h1 style="font-weight: bold">Creeaza postarea</h1>


     

    {!! Form::open(['action' => 'App\Http\Controllers\ContinutController@store','style'=>'padding-top:25px', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
       
         
        @foreach ($categorii as $item)
          {{Form::label($item->id,$item->nume)}} 
          {{Form::checkbox($item->nume, $item->id, false)}}
        @endforeach
       

<br>

</div>
    
    
    <div class="form-group">
        {{-- <b>{{Form::label('titlu', 'Titlu')}}</b> --}}
        {{Form::text('titlu','' , ['class' => 'form-control', 'placeholder' => 'Titlu'])}}
    </div>

    <div class="form-group">
        <b>{{Form::label('descriere', 'Descriere')}}</b>
        <textarea class="form-control" id="descriere" name="descriere"></textarea>
    </div> 
    <div class="form-group">
        {{Form::file('cover_image')}}
 
 
     </div>

     
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
    CKEDITOR.replace( 'descriere' );
    </script>
@endsection





























