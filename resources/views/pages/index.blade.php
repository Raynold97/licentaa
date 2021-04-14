@extends('layouts.app')

@section('content')

{{-- <div class="jumbotron text-center">
    {{-- <h1> Welcome to Laravel !  </h1>
    <p> This is the laravel application from the "Laravel From Scrach" </p> --}}
{{-- <p><a class="btn btn-primary btn-lg" href="/login" role="button"> Login </a>
   <a class="btn btn-success btn-lg" href="/register" role="button"> Register </a></p>
</div> --}} 




   <div class="postari" style="align-content: center;padding-top:60px">
   <b> Cautare postari</b>
</div>


   <form action="{{ route('search') }}" method="GET" style="padding:35px;">
    <!DOCTYPE html>
    
<html lang="es">
 
 <body>
  <div class="search-box">
    
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/016ab521a3.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <form action="{{ route('search') }}" method="GET" style="padding:15px;">
   <input type="text" name="search" class="search-txt" placeholder="Cautare..."/>
   <a class="search-btn" type="submit"><i class="far fa-search"></i>
   </a>
    
  </form>
  </div>

 </body>
</html>
   </form>

  
    @endsection
