<?php

namespace App\Http\Controllers;
use\Illuminate\Support\Facades\Storage;
use App\Models\Continut;
use App\Models\Key;
use DB;
use App\Models\Comments;
use App\Models\Categorii;

// use App\Models\Comentarii;

use Illuminate\Http\Request;

class ContinutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

         public function __construct()
     {
    $this->middleware('auth',['except' => ['index','show','search']]);

     }

   public $sorting;

    public function index(Request $request)
    {
        // print_r('mesaj');
        $sorting=$request->orderby;
        // // print_r($sorting);
        // print_r($sorting);

      
         if(strcmp($sorting,'crescator')==0)
         {

          $continut =Continut::orderBy('created_at','asc')->paginate(10);
         }
           else if(strcmp($sorting,'descrescator')==0){
            $continut =Continut::orderBy('created_at','desc')->paginate(10);
           }
           else if(strcmp($sorting,'A-Z')==0){
            $continut =Continut::orderBy('titlu','asc')->paginate(10);
           }
           else if(strcmp($sorting,'Z-A')==0){
            $continut =Continut::orderBy('titlu','desc')->paginate(10);
           }
           else
            $continut =Continut::paginate(10);
             
        // print_r(strcmp($sorting,'descrescator'));

 
        //  $continut =Continut::orderBy('created_at','asc')->paginate(10);
        // $continut=Continut::orderBy('created_at','desc')->get();
         $comentari=Comments::get();
         $categorii = DB::table('categorii')->get();
        //  $c=0;
    return view('continut.index')->with('continut',$continut)->with('comentari',$comentari)->with('categorii',$categorii);
    // ->with('c',$c);
        //return view('continut.index')->with('continut',$continut);
    }


    public function categorii_index(Request $request){
        $categorii = DB::table('categorii')->get();
        $comentari=Comments::get();
        $id_cat=0;
       
     
       foreach($categorii as $categori){
        
    if(isset($_POST[$categori->id]))
        {
       $id_cat=$categori->id;
       break;
        }
       }
      
        $categorii_post=DB::table('categoriicontinut')->where('categorii_id',$id_cat)->get();
        $i=0;
       
      foreach($categorii_post as $cat_post){
      $vector[$i]=$cat_post->continut_id;
      $i++;
    } 
    
       
    $categorii = DB::table('categorii')->get();
    // $continut=Post::orderBy('created_at','desc')->where('id',$vector[0])->orWhere('id',$vector[1])->Paginate(5);
    $continut=Continut::orderBy('created_at','desc')->whereIN('id',$vector)->Paginate(5);
    
        return view('continut.index')->with('continut',$continut)->with('categorii',$categorii)->with('comentari', $comentari);
    
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      $categorii = Categorii::all();
        return view('continut.create',compact('categorii'));
       // return view('continut.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titlu' => 'required',
            'descriere' => 'required',
            'cover_image' => 'image|nullable|max:1999'
            
             
            ]);

            if($request->hasFile('cover_image')){
                // get filename with the extension
             $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
                 //get just filename
                 $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
     
                 //get just extension
     
                $extension = $request->file('cover_image')->getClientOriginalExtension();
     
                 //create filename to store
                 //$fileNameToStore = $filename.'_'.time().'.'.$extension;
                 $fileNameToStore=$filename.'_'.time().'.'.$extension;
     
                 //upload image
                 $upload = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
     
              }else{
                $fileNameToStore = 'noimage.jpg';
                
             }


            $continut = new Continut;
            $cat = DB::table('categoriicontinut');
             $continut->titlu=$request->input('titlu');
             $continut->descriere=$request->input('descriere');
             $continut->idUtilizator = auth()->user()->id;
             $continut->cover_image= $fileNameToStore;
             $continut->save();

             $cat=DB::table('categorii')->get();
             foreach($cat as $a)
               if($request->__isset($a->nume))
              {
                  DB::table('categoriicontinut')->insert([
                   'categorii_id'       => $a->id,
                   'continut_id'          => $continut->id
               ]);
                  }

           
            return redirect('/continut')->with('success' , 'Postarea a fost creata');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //$utilizator= DB::select ("SELECT * FROM `a9cm79W85D`.users , `a9cm79W85D`.continut  where continut.id =".$id." and users.id=idUtilizator");
        $continut = Continut::find($id);
        $cap = DB::table('categoriicontinut')->where('continut_id',$id)->get();
        $categorii = DB::table('categorii')->get();
       print_r($id);
       // return view('continut.show')->with('continut', $continut)->with('utilizator', $utilizator);
       // return view('continut.show')->with('continut', $continut);
        return view('continut.show')->with('continut',$continut)->with('categorii',$categorii)->with('categoriicontinut',$cap);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $continut = Continut::find($id);
        $categorii = DB::table('categorii')->get();

       // verificam daca e utiliatorul postarii
        if(auth()->user()->id !==$continut->idUtilizator){

        return redirect('/continut')->with('error', 'Pagina neautorizata');
             }
             $cat=DB::table('categorii')->get();
             foreach($cat as $a)
               if($request->__isset($a->nume))
              {
                  DB::table('categoriicontinut')->insert([
                   'categorii_id'       => $a->id,
                   'continut_id'          => $continut->id
               ]);
                  }

                  return view('continut.edit')->with('continut', $continut)->with('categorii',$categorii);
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titlu' => 'required',
            'descriere' => 'required',
            'cover_image' => 'image|nullable|max:1999'
           
            ]);

            if($request->hasFile('cover_image')){
                // get filename with the extension
             $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
                 //get just filename
                 $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
     
                 //get just extension
     
                $extension = $request->file('cover_image')->getClientOriginalExtension();
     
                 //create filename to store
                 //$fileNameToStore = $filename.'_'.time().'.'.$extension;
                 $fileNameToStore=$filename.'_'.time().'.'.$extension;
     
                 //upload image
                 $upload = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
     
              }


            $continut =Continut::find($id);
             $continut->titlu=$request->input('titlu');
             $continut->descriere=$request->input('descriere');
             if($request->hasFile('cover_image')){
                $continut->cover_image = $fileNameToStore;
            }
             $continut->save();

             $cat=DB::table('categorii')->get();
             foreach($cat as $a)
               if($request->__isset($a->nume))
              {
                  DB::table('categoriicontinut')->insert([
                   'categorii_id'       => $a->id,
                   'continut_id'          => $continut->id
               ]);
     
                  }
                  else
                  DB::table('categoriicontinut')->where('continut_id',$continut->id)->where('categorii_id',$a->id)->delete();
           
            return redirect('/continut')->with('success' , 'Postarea a fost updatata');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $continut = Continut::find($id);
        if(auth()->user()->id !==$continut->idUtilizator){
           return redirect('/continut')->with('error', 'Pagina neautorizata');
                 }
                     
        if($continut->cover_image != 'noimage.jpg'){
                    // Delete Image
            Storage::delete('public/cover_images/'.$continut->cover_image);
        }
          $continut->delete();
        return redirect('/continut')->with('success' , 'Post Removed');
    }


      

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        
        
        // Search in the title and body columns from the posts table
        $comentarii=Comments::get();
          $var=strlen($search)+1;
        $continut = Continut::query('SELECT')
            ->where('keywords', 'LIKE', "%{$search}%")
            ->orderbyRaw("substr(keywords,position('$search' in keywords)+$var,1) desc")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('/search', compact('continut'))->with('comentarii', $comentarii);
    }


      
    
    function showKeywords(){
        // $continut = Continut::find($titlu);
       
        $key = Continut::get();
       
        
        //  return view('keywords',['continut'=>$key])->with('continut', $key);
         return view('keywords')->with('continut', $key);
         

    }


    function storeKeywords(Request $request){
        
         
       

            //  dd($request['titlu']);
            //  $continut = Continut::where('titlu', $request->titlu)->get();
           
             $rez="";
          
           $continut1=  Continut::get();
             
        //  $i=1; 
                foreach($continut1 as $key){
                    if(isset($_POST[$key->id])) //verifica daca e setata o valoare in textfield 
                     

                { 
                          
                        
                        $keywordActual=Continut::find($key->id);//returneaza inregistrarea cu  id 1
                        $key1=$keywordActual->keywords; // selecteaza keywords-urile 
                        $rez=$request->input($key->id)."[],".$key1;//adauga textul din textfield la keywords

        
                         $keywordActual->keywords=$rez;
                         $keywordActual->save();
                      
                    
                   
                    }

                    // $cheie =Key::query()
                    // ->from('keywords', 'k')
                    // ->innerJoin('continut', 'c', 'k.continut_id = c.continut_id')
                    // ->orderBy('pondere', 'desc')
                    // ->get();
                 
                  
                   
                }

               
            
            
            $continut= DB::select('SELECT * FROM continut');
              //return view('keywords')->with('continut',$continut)->with($rez);
              return redirect('keywords')->with('continut', $key)->with('success' , 'Keyword adaugat cu succes!');
              
          
          
     
            }

              

            
    function update2Keywords(Request $request){
        
         
       
      
    //  $continut1= DB::select('SELECT * FROM continut');
    //   foreach($continut1 as $key){
      
             $continut=Continut::find($request->id);//returneaza inregistrarea cu  id 1
            
             $continut->keywords=$request->input('keywords');//adauga textul din textfield la keywords
             $continut->save();
                 
      
         //$continut= DB::select('SELECT * FROM continut');
         return redirect('keywords')->with('continut', $continut);
         
      
      
 
        }


        function updateKeywords(Request $request){
         // $rez="";
          
           $continut1=  Continut::get();
             
       
                foreach($continut1 as $key){
                     if(isset($_POST[$key->id])) //verifica daca e setata o valoare in textfield 
                        //  $m=0;
                      { 
                          
                        // $var=explode(',',$_POST[$key->id]);
                        // $first=substr($var[3], strpos($var[3], "[") + 1);
                        // $second=str_replace(']','',$first);
                        // print_r($second);die;


                        // $var2=explode('[',$_POST[$key->id]);
                        //     $first2=substr($var2[3], strpos($var2[3], "]") + 1);
                        //     $second2=str_replace(',','',$first2);
                           
                        //     print_r($second2);die;

                        $keywordActual=Continut::find($key->id);//returneaza inregistrarea cu  id 1
                         $keywordActual->keywords=$request->input($key->id);
                         $keywordActual->save();
                     }
                }
             $continut= DB::select('SELECT * FROM continut');
           
              return redirect('keywords')->with('continut', $key)->with('success' , 'Editare finalizata cu succes!');
              
          
          
     
            }


//             function insert2(Request $request){
//                 // $rez="";
                 
//                   $continut1=  Continut::get();
                    
              
//                        foreach($continut1 as $key){
//                             if(isset($_POST[$key->id])) //verifica daca e setata o valoare in textfield 
//                                 $m=0;
//                              { foreach ($key as $i => $keyword)
                                 
//                                $var[$m]=explode(',',$_POST[$key->id]);
//                                $first=substr($var[$m], strpos($var[$m], "[") + 1);
//                                $second=str_replace(']','',$first);
                               
//                                   // print_r($second);die;
                                  
//                                    $var2=explode('[',$_POST[$key->id]);
//                                    $first2=substr($var2[$m], strpos($var2[$m], "]") + 1);
//                                    $second2=str_replace(',','',$first2);
                                  
//                                    print_r($second2);die;
       
//                                    $keywordS=Continut::find($key->id);//returneaza inregistrarea cu  id 1
                                           
//                                           DB::table('key')->insert([
//                                               'continut_id' => $keywordActual,
//                                               'keyword' => $second2,
//                                               'pondere' => $second,
//                                           ]);
                                
//                                 $keywordS->keywords=$request->input($key->id);
//                                 $keywordS->save();
//                                 $m++;
//                             }
//                        }
                   
                  
//                      return redirect('test')->with('continut1', $keywordS)->with('success' , 'Editare finalizata cu succes!');

//                     }
            
// function insert(Request $request){
//                 // $rez="";
                 
//                   $continut1=  Continut::get();
                 
          
              
//                        foreach($continut1 as $key){
//                             if(isset($_POST[$key->id])) //verifica daca e setata o valoare in textfield 
                                
//                                  $m=0;
//                              {foreach ($key as $i => $keyword)
                                 
//                                $var=explode(',',$_POST[$key->id]);
//                                $first=substr($var[$m], strpos($var[$m], "[") + 1);
//                                $second=str_replace(']','',$first);
//                                  // print_r(substr($var[1], strpos($var[1], "[") + 1));die;
//                               // print_r(substr_replace ( $var[1] ,  strpos($var[1],) , array|int $offset , array|int|null $length = null ));die;
//                                    print_r($second);die;
//                                    //print_r($first);die;
//                                 $keywordS=Continut::find($key->id);//returneaza inregistrarea cu  id 1
                                    
//                                    DB::table('key')->insert([
//                                        'continut_id' => $keywordActual,
//                                        'keyword' => $keywordS,
//                                        'pondere' => $second,
//                                    ]);
//                                 $keywordActual->keywords=$request->input($key->id);
//                                 $keywordActual->save();
//                                 $m++;
//                             }
//                        }
//                    // $continut= DB::select('SELECT * FROM continut');
                  
//                      return redirect('keywords')->with('continut', $key)->with('success' , 'Editare finalizata cu succes!');
                     
                 
                 
            
//                     }

//  function storeKey(Request $request){
        
         
       

//                         //  dd($request['titlu']);
//                         //  $continut = Continut::where('titlu', $request->titlu)->get();
                       
//                          $rez="";
                      
//                        $continut1=  Continut::get();
//                        $keys=Key::get();
                         
//                     //  $i=1; 
//                             foreach($continut1 as $key){
//                                 if(isset($_POST[$key->id])) //verifica daca e setata o valoare in textfield 
                                 

//                                 $keyword=Continut::find($key->id);
//                                 $key1=$keyword->key;
//                                     $keywordActual=Continut::find($key->id);//returneaza inregistrarea cu  id 1
                                    
//                                     $key1=$keywordActual->keywords; // selecteaza keywords-urile 
//                                     $rez=$request->input($key->id)."[],".$key1;//adauga textul din textfield la keywords
            
                    
//                                      $keywordActual->keywords=$rez;
//                                      $keywordActual->save();
                                  
                                
                               
//                                 }
            
//                                 // $cheie =Key::query()
//                                 // ->from('keywords', 'k')
//                                 // ->innerJoin('continut', 'c', 'k.continut_id = c.continut_id')
//                                 // ->orderBy('pondere', 'desc')
//                                 // ->get();
                             
                              
                               
//                             }
                        
                        
//                         $continut= DB::select('SELECT * FROM continut');
//                           //return view('keywords')->with('continut',$continut)->with($rez);
//                           return redirect('keywords')->with('continut', $key)->with('success' , 'Keyword adaugat cu succes!');
                          
                      
                      
//                   }


//    function sortare(){

//     //$continut=Continut::get();
//     $continut = Continut::orderBy('titlu', 'ASC')->get();

//     // $continut = Continut::query('SELECT')
//     //         ->where('keywords', 'LIKE', "%{$search}%")
//     //         ->orderbyRaw("substr(keywords,position('$search' in keywords)+$var,1) desc")
//     //         ->get();

//     return redirect('/continut')->with('continut', $continut);

// }
 
  public function categorie(Request $request){
 
    $this->validate($request, [
        'nume'=> 'required'

    ]);

    $categorie = new Categorii([
      'nume' => $request->get('nume')
    ]);
   
    $categorie->save();

    return redirect('keywords')->with('categorie', $categorie);

  }

   public function filter(Request $request){

         $continut1=Continut::orderBy('created_at','desc')->Paginate(10);
         $continut2=Continut::orderBy('created_at','asc')->Paginate(10);
         $continut3=Continut::sortBy('titlu','desc')->Paginate(10);
         $continut4=Continut::sortBy('titlu','asc')->Paginate(10);
         
         return redirect('/continut')->with('continut1',$continut1);
         

   }
        
          
    
}
