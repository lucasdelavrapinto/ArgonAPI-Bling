@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Adicionar Produto')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Gerenciamento') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('updateproduto') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Informações do Produto') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Descrição') }}</label>
                                        <input type="text" name="descricao" id="input-name" class="form-control form-control-alternative" value="{{ $produto[0]['produto']['descricao'] }}" placeholder="" required>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Código') }}</label>
                                        <input type="text" name="codigo" id="input-name" class="form-control form-control-alternative" value="{{ $produto[0]['produto']['codigo'] }}" readonly="readonly" placeholder="" required>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="form-control-label" for="input-name">{{ __('UN') }}</label>
                                        <input type="text" name="un" id="input-name" class="form-control form-control-alternative" value="{{ $produto[0]['produto']['unidade'] }}" placeholder="Ex: UN" required>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="form-control-label" for="input-name">{{ __('Preço') }}</label>
                                        <input type="text" name="preco" id="input-name" class="form-control form-control-alternative"  value="{{ $produto[0]['produto']['preco'] }}" placeholder="" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection