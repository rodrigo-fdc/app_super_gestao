<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request){
        
        $motivo_contatos = MotivoContato::all();
        

        
        /*
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');
        $contato->save();
       */

        return view('site.contato', ['motivo_contatos' => $motivo_contatos]);
    }

        public function salvar(Request $request) {
            
            //Realizar a validação dos dados do formulário recebidos no request
            $request->validate(
            [
                'nome' => 'required|min:3|max:40|unique:site_contatos',
                'telefone' => 'required',
                'email' => 'email',
                'motivo_contatos_id' => 'required',
                'mensagem' => 'required|max:2000',
            ],
            [
                'nome.required' => 'O campo nome precisa ser preenchido',
                'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'nome.unique' => 'O nome informado já está em uso',
                'telefone.required' => 'O campo telefone precisa ser preenchido',
                'email.email' => 'O e-mail informado precisa ser um e-mail válido',

                'required' => 'O campo :attribute deve ser preenchido',
            ]
        );
            SiteContato::create($request->all());
            return redirect()->route('site.index');
        }

}
