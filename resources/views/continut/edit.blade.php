@extends('layouts.app')

@section('content')

<h1 style="font-weight: bold">Creeaza postarea</h1>


     

    {!! Form::open(['action' => ['App\Http\Controllers\ContinutController@update', $continut->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    
    
    <div class="form-group">
        <b>{{Form::label('titlu', 'Titlu')}}</b>
        {{Form::text('titlu',$continut->titlu , ['class' => 'form-control', 'placeholder' => 'Titlu'])}}
    </div>

    <div class="form-group">
        <b>{{Form::label('descriere', 'Descriere')}}</b>
        <textarea class="form-control" id="descriere" name="descriere">
            <?php echo htmlspecialchars($continut->descriere); ?>
        </textarea>
    </div> 

    <div class="form-group">
        {{Form::file('cover_image')}}
 
 
     </div>
<div>
     @foreach ($categorii as $item)
{{Form::label($item->id,$item->nume)}} 
{{Form::checkbox($item->nume, $item->id, false)}}
@endforeach
    
</div>
 {{Form::hidden('_method', 'PUT')}} 
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
    CKEDITOR.replace( 'descriere' );
    </script>
@endsection





























