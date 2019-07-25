<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function _getApiKey(){
        $apikey = "099559e0bbb2116b028305cdc8796356489b6ed9e1a2edeecc8a797a84d95f92b977bae1";
        return $apikey;
    }
    public Function __contructorXML($data){

        $xml ='<?xml version="1.0" encoding="UTF-8"?>
            <produto>
                <codigo>'.$data['codigo'].'</codigo>
                <descricao>'.$data['descricao'].'</descricao>
                <un>'.$data['un'].'</un>
                <situacao>Ativo</situacao>
                <descricaoCurta>Descrição curta da caneta</descricaoCurta>
                <vlr_unit>'.$data['preco'].'</vlr_unit>
                <preco_custo></preco_custo>
                <peso_bruto></peso_bruto>
                <peso_liq></peso_liq>
                <class_fiscal></class_fiscal>
                <marca></marca>
                <origem></origem>
                <estoque></estoque>
            </produto>';
        return $xml;

    }


    public function postProduto($data){
        $url = 'https://bling.com.br/Api/v2/produto/json/';
        $xml = ApiController::__contructorXML($data);
        $posts = array (
            "apikey" => ApiController::_getApiKey(),
            "xml" => rawurlencode($xml)
        );

        function executeInsertProduct($url, $data){
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_POST, count($data));
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $response;
        }

        $response = executeInsertProduct($url, $posts);
        // echo $response;
        return back();

    }

    public function getProdutos(){
        $apikey = ApiController::_getApiKey();

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produtos/' . $outputType;

        function executeGetProducts($url, $apikey){
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $response;
        }
        $retorno = executeGetProducts($url, $apikey);
        $manage = json_decode($retorno, true);
        return $manage['retorno']['produtos'];
    }

    public function deleteProduto($codigo_produto){
        $apikey = ApiController::_getApiKey();
        $code = $codigo_produto;
        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produto/' . $code . '/' . $outputType;
        $data = array (
            "apikey" => $apikey
        );

        function executeDeleteProduct($url, $data) {
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $response;
        }

        $retorno = executeDeleteProduct($url, $data);
        return back();
    }

    public function getProduto($codigo){
        $code = $codigo;
        $apikey = ApiController::_getApiKey();
        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produto/' . $code . '/' . $outputType;

        function executeGetProduct($url, $apikey){
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $response;
        }

        $retorno = executeGetProduct($url, $apikey);
        $manage = json_decode($retorno, true);
        return $manage['retorno']['produtos'];
    }

    public function editProduto($codigo){
        $produto = ApiController::getProduto($codigo);
        return view('produtos.edit')->with('produto', $produto);
    }

    public function updateProduto(Request $request){
        $code = $request->input('codigo');
        $data = $request->all();

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produto/' . $code . '/';

        $xml = ApiController::__contructorXML($data);

        $posts = array (
            "apikey" => ApiController::_getApiKey(),
            "xml" => rawurlencode($xml)
        );

        function executeUpdateProduct($url, $data){
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_POST, count($data));
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $response;
        }

        $retorno = executeUpdateProduct($url, $posts);
        return redirect()->route('produto.index');

    }
}
