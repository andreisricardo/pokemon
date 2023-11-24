@extends('template.main', ['menu' => "list", "submenu" => "Tipos"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<link rel="stylesheet" href="{{asset('css/tipo.css')}}">

<div class="row mb-3">
    <div class="col">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_{{$item->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="descricao fs-5">{{ $item->nome }}</span>
                        </button>
                    </h2>
                    <div id="flush_{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-2 col-xs-12">         
                                <img src="{{ asset("storage/$item->foto")}}" width="128" height="128" style="border-radius: 50%;" <a nohref style="cursor:pointer" onclick="showFotoModal('{{ asset('storage/') }}', '{{ $item->foto }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection