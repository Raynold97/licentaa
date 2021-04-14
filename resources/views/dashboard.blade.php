@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 800px;heigth: 800px">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Sunteti logat!') }}
                </div>

                <p style="align-content: center"><h3>Postarile mele</h3></p>
                <br>
                @if(count($continut)>0)
                <table class="table table-striped" style="width:75">
                    {{-- <tr> --}}
                        <th>Titluri</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    {{-- </tr> --}}

                    @foreach($continut as $continut)
                    <tr >
                        
                        {{-- <td style="font-weight: 100%; text-align: center; font-size: x-large">{{$continut->titlu}}</td> --}}
                        <td><h4><a href="/continut/{{$continut->id}}">{{$continut->titlu}}</a></h4></td>
                        {{-- <td><a href="/continut/{{$continut->id}}/edit" class="btn" style="float: right">Edit</td>
                        <td>{!!Form::open(['action' => ['App\Http\Controllers\ContinutController@destroy', $continut->id], 'mehod' => 'Post', 'class'=>'btn btn-primary', 'style'=>'float: right', 'class' => ''])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete',['class' => 'btn btn-danger'])}} 
                           {!!Form::close()!!}
                        </td>   --}}
                        <td>{{$continut->created_at}}</td>
                    </tr>
                    @endforeach
                </table>
                @else
                <p>Nu exista postari</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
