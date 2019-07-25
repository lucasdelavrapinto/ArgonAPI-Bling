
<?php
function formatPrice($data){
    $valor = number_format($data,2,",",".");
    return $valor;
}

?>
@extends('layouts.app', ['title' => __('User Management')])
@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Produtos') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('produto.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Produto') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Descrição') }}</th>
                                    <th scope="col">{{ __('Código') }}</th>
                                    <th scope="col">{{ __('Unidade') }}</th>
                                    <th scope="col">{{ __('Preço') }}</th>
                                    <th scope="col">{{ __('Opções')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $key => $value)

                                    <tr>
                                        <td>
                                            <a href="{{route('editproduto', $value['produto']['codigo'])}}">
                                            {{$value['produto']['descricao'] or ''}}
                                            </a>
                                        </td>
                                        <td>{{$value['produto']['codigo'] or ''}}</td>
                                        <td>{{$value['produto']['unidade'] or ''}}</td>
                                        <td>R$ {{ formatPrice($value['produto']['preco']) }}</td>

                                        <td>
                                            <div class="row">
                                                <div style="margin-left: 10px;">
                                                    <a class="btn btn-sm btn-primary" href="{{route('editproduto', $value['produto']['codigo'])}}">{{ __('Editar') }}</a>
                                                </div>
                                                <div style="margin-left: 10px;">
                                                    <a class="btn btn-sm btn-danger" href="{{route('apideleteproduto', $value['produto']['codigo'])}}">{{ __('Deletar') }}</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection