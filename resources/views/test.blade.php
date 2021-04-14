@extends('layouts.app')

@section('content')

<form action="{{ route('search') }}" method="GET" style="padding:25px;">
  <input type="text" name="search" required/>
  <button type="submit">Introdu cuvantul cheie</button>

</form>
<br> 



<h1>Nume postari</h1>



   <table border="2" >
    
  <tr>
    {{-- @if(Auth::user()->id == $continut->idUtilizator) --}}
    @foreach ($continut1 as $key )
    @if(Auth::user()->id == $key->idUtilizator)
       
       <tr border="2" >
             {{-- <td>{{$key['titlu']}}</td>    --}}
             {{-- <td>{{$key['keywords']}}</td>    --}}
             <td width="200"><h4><a href="/continut/{{$key->id}}"> {{$key->titlu}}</a></h4></td>
              {{-- <td><b><?php echo $key->titlu?></b></td> --}}
              
              

            
        <td border="2" width="150"> 

             <form enctype="multipart/form-data" action="{{ action('App\Http\Controllers\ContinutController@insert2') }}"
            method="POST">

             
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <input type="text"  name=<?php echo $keywordS->id?>  class="form-control" placeholder="keywordS"/>
                 <input type="submit" class="btn btn-primary"/>
            </form> 
            
            
            
           
        </td>
       
        @endif
      @endforeach
      {{-- @endif --}}
    </tr>
  </table> 

     

      

  

@endsection