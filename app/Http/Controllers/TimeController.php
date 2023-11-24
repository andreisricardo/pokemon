<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Pokemon;
use App\Models\TimePokemon;
use App\Models\Treinador;
use Illuminate\Http\Request;

class TimeController extends Controller
{

    public function index()
    {
        $data = array();
        $time = TimePokemon::orderBy('id')->get();

        foreach ($time as $d) {
            $pokemon1 = Pokemon::find($d->pokemon1);
            $pokemon2 = Pokemon::find($d->pokemon2);
            $pokemon3 = Pokemon::find($d->pokemon3);
            $pokemon4 = Pokemon::find($d->pokemon4);
            $pokemon5 = Pokemon::find($d->pokemon5);
            $pokemon6 = Pokemon::find($d->pokemon6);

            $data[] = [
                'pokemon1' => $pokemon1 ? $pokemon1->nome : "-",
                'pokemon2' => $pokemon2 ? $pokemon2->nome : "-",
                'pokemon3' => $pokemon3 ? $pokemon3->nome : "-",
                'pokemon4' => $pokemon4 ? $pokemon4->nome : "-",
                'pokemon5' => $pokemon5 ? $pokemon5->nome : "-",
                'pokemon6' => $pokemon6 ? $pokemon6->nome : "-",
            ];
        }

        return view('time.index', compact('data', 'time'));
    }



    public function create()
    {

        $poks = Pokemon::orderBy('id')->get();

        return view('time.create', compact('poks'));
    }

    public function store(Request $request)
    {
        $regras = [
            'pokemon1' => 'required',
            'pokemon2',
            'pokemon3',
            'pokemon4',
            'pokemon5',
            'pokemon6',
        ];
    
        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
    
        $request->validate($regras, $msgs);
    
        $treinador = Treinador::orderBy('id')->first();

        $reg = new TimePokemon();

        $id_timePokemon = "{$request->pokemon1}{$request->pokemon2}{$request->pokemon3}{$request->pokemon4}{$request->pokemon5}{$request->pokemon6}";
        $reg->id = $id_timePokemon;
        $reg->pokemon1 = $request->pokemon1;
        $reg->pokemon2 = $request->pokemon2;
        $reg->pokemon3 = $request->pokemon3;
        $reg->pokemon4 = $request->pokemon4;
        $reg->pokemon5 = $request->pokemon5;
        $reg->pokemon6 = $request->pokemon6;
        $reg->save();
    

        $reg = new Time();

        $reg->id_timePokemon = $id_timePokemon;
        $reg->id_treinador = $treinador->id;
        $reg->save();
        
        return redirect()->route('time.index');
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Time::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('time.edit', compact('dados'));
    }

    public function update(Request $request, $id)
    {
        $regras = [
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $reg = Time::find($id);
        
        if(isset($reg)) {
            $reg->save();
        } else {
            return "<h1>ID: $id não encontrado!";
        }

        return redirect()->route('time.index');
    }

    public function destroy($id)
    {
        $reg=Time::find($id);

        if(!isset($reg)) { return "<h1>ID: $id não encontrado!"; }

        $reg->delete();

        return redirect()->route('time.index');
    }
}
