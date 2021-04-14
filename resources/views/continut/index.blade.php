@extends('layouts.app')
    
@section('content')
    {{-- <div style="padding-top:60px"> --}}
 

    <div class="container2">
    
        <div class="sort-item orderby">
          <form enctype="multipart/form-data" action="{{ action('App\Http\Controllers\ContinutController@index') }}"
          method="GET">

           <select name="orderby" class="use-chosen" wire:model="sorting" onchange="this.form.submit()">
             
             <option value="default" selected="selected">----</option>
             <option value="crescator" >Crescator</option> 
             <option value="descrescator">Descrescator</option>
              <option value="A-Z" >Sortare A-Z</option>
             <option value="Z-A" >Sortare Z-A</option> 
          </select>
          {{-- <input type="submit" value="submit"> --}}
        </form>
        </div>
    

    <h3 style="text-align: center"><b>Postari</b></h3>

  
    
    </div class="principala">
   @if(count($continut)>0)
      @foreach ($continut as $post)
      <?php $cont=0; ?>
         <div class="card p-3 mt-3 mb-3" style="height: 180px">
            <div class="row">
                <div class="col-md-2 col-sm-2"  style="background: rgb(250, 250, 250); text-align:center;height: 110px;width:110px;;align-items: center;margin-top:15px">
                  
                    <img style="height:70%;width:120px;margin-top:15px" src="/storage/cover_images/{{$post->cover_image}}">
                         
                </div>
                <div class="col-md-8 col-sm-8"  style="height: 110px">
                   <h5><a href="/continut/{{$post->id}}"> {{$post->titlu}}</a></h5>
                     <small>Postat la <b>{{$post->created_at}}</b></small><br>
                     <small style="height: 10px" >Postat de <b>{!!$post->user->UserName!!}</b></small><br>
                  
                  
                  
                      <?php $c = 0; ?>
                      @foreach ($comentari as $coment)
                        @if($coment->commentable_id==$post->id)
                        <?php $c++; ?>
                      
                      @endif
                   @endforeach
                   @if($c!=1)
                   <b><h5><a style="color: green" href="/continut/{{$post->id}}"><b>{!!$c, ' comentarii'!!}</b></a></h5></b>
                       @else
                       <b><h5><a style="color: green" href="/continut/{{$post->id}}"><b>{!!$c, ' comentariu'!!}</b></a></h5></b>  
                   
                 
              
              @endif
    
              <?php

              $cap = DB::table('categoriicontinut')->where('continut_id',$post->id)->get(); ?>
             @if($cont==0)
             @foreach ($cap as $item)  
             <?php
              $cat1 =  DB::table('categorii')->where('id',$item->categorii_id)->get();
             ?>
                
             <div style="display: inline-block" >
             @foreach($cat1 as $m)
             
             {!! Form::open(['action' => 'App\Http\Controllers\ContinutController@categorii_index', 'method'=>'POST']) !!}
             
             <button type="submit" class="btn btn-primary" style="display: inline-block" class="btn btn-success" name={{$m->id}} value={{$m->id}}>{{$m->nume}}</button>
             {!! Form::close() !!}
             
      
             
             @endforeach
             </div>
             @endforeach
             <?php $cont++ ?>
             @endif
             
             
          
    



                    </div>
             
           
           
          
               
           </div>
          </div>
         
      @endforeach
        {{$continut->links('pagination::bootstrap-4')}}
  @else
      <p> Nu exista postari</p>
   
  @endif 
    </div>
        
    </div>
@endsection