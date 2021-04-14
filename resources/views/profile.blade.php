@extends('layouts.app')

@section('content')

<div class="container" style="padding:30px;align-text:left">
    
    <div >
        <img src="/images/{{$user->imagine}}" style="width:50px; height:50px; float:left; border-radius:50%; margin-right:25px">
            <h2> {{ $user->UserName}}'s Profil</h2>
            
    </div>
    

</div>
   
<div class="col-md-6">
    <div class="form-group">
        <form enctype="multipart/form-data" action="{{ action('App\Http\Controllers\ProfileController@updateAvatar') }}"
            method="POST">
            @csrf
            
            <div class="text-muted small">
                Schimbati fotografia de profil
            </div>
            <input type="file" name="imagine">
            <input type="hidden" name="_token" value="{{ csrf_token()}}"><br><br>
            <button type="submit" class="btn btn-primary">Salveaza poza</button>
            {{-- <input type="submit" class="pull-near btn btn-sm btn-success mt-3"> --}}
            
        </form>
    </div>
</div>
    
<hr>


    <div class="text-muted small">
        Completați câmpurile pentru a schimba datele dumneavoastra
    </div><br>
    <div class="container" >
    {!!Form::open(['action' => [ 'App\Http\Controllers\ProfileController@update_avatar'], 'method'=>'POST' , 'enctype' => 'multipart/form-data'])!!}
    {{Form::label('Nume Utilizator', 'Nume Utilizator')}}
      {{Form::text('Nume_Utilizator', $user->UserName,['class'=>'form-control', 'password'=>$user->UserName])}}
    {{Form::label('Nume ', 'Nume')}}
      {{Form::text('Nume',$user->Nume ,['class'=>'form-control', 'placeholder'=>$user->Nume])}}
    {{Form::label('Prenume ', 'Prenume')}}
      {{Form::text('Prenume', $user->Prenume,['class'=>'form-control', 'placeholder'=>$user->Prenume ])}}
    {{Form::label('email ', 'email')}}
      {{Form::text('Email',$user->email ,['class'=>'form-control', 'placeholder'=>$user->email ])}}
    
     <br>
     <br>
     
   <b> {{Form::submit('Editeaza profilul', ['class'=>'btn btn-primary'])}}</b>
    {!!Form::close()!!}
    <hr>


    <div class="text-muted small">
        Completați câmpurile pentru a schimba parola
    </div>
</div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
            <form action="{{ action('App\Http\Controllers\ProfileController@updatePassword') }}" method="POST">
                @csrf
                <div class="form-group">
                <label class="form-control-label">Parola actuală</label>
                <input name="password" class="form-control" type="password">
                 </div>
            </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Parola nouă</label>
                        <input name="ParolaNoua" class="form-control" type="password">
                    </div>
                </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label">Confirmă parola</label>
                    <input name="ParolaNoua_confirm" class="form-control" type="password">
                </div>
        </div>
    </div>
                    <button type="submit" class="btn btn-primary">Salvează</button>
            </form>
    

    </div>

 
 

@endsection