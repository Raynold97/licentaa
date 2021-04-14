@extends('layouts.app')
@section('content')
<div>
    <a href="keywords" class="btn btn-primary btn-lg" style="padding: 7px">Adaugare cuvinte cheie</a>
    <br>
    <br>
    <table border="1">
        
        <tr>
           @foreach ($continut as $key )
           
           <tr>
                 
                  <td><?php echo $key->titlu?></td>
                  <td><?php echo $key->keywords?></td> 
                  {{-- <?php echo $key->$rez?> --}}
           </tr>
           @endforeach
     </table>
 
  
   
</div>
@endsection