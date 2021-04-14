@extends('layouts.app')

@section('content')

<form action="{{ route('search') }}" method="GET" style="padding:15px;">
  <input type="text" name="search" required/>
  <button type="submit">Introdu cuvantul cheie</button>

</form>
<br>



<h1>Nume postari</h1>

  <table border="2">
    
  <tr>
    @foreach ($continut as $key )
       
       <tr>
             {{-- <td>{{$key['titlu']}}</td>    --}}
             {{-- <td>{{$key['keywords']}}</td>    --}}
              <td><b><?php echo $key->titlu?></b></td>
             <td><b><?php echo $key->keywords?></b></td>
         
        <td> 

             <form enctype="multipart/form-data" action="{{ action('App\Http\Controllers\ContinutController@storeKeywords') }}"
            method="POST">

             
                @csrf
                <input type="text"  name=<?php echo $key->id?>  class="form-control" placeholder="keywords"/>
                 <input type="submit" class="btn btn-primary"/>
            </form> 
            
            
            
           
        </td>
       

      @endforeach
    </tr>
  </table>

  

@endsection