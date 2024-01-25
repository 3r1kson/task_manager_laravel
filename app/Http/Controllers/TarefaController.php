<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    public function __construct(Tarefa $tarefa) {
        $this->middleware('auth'); // only access when logged in
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        // $tarefas = Tarefa::where('user_id', $user_id)->get();
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);
        return view('tarefa.index', ['tarefas' => $tarefas]);
        // Using Method auth()
        // if(auth()->check()) {
        //     $id = auth()->user()->id;
        //     $nome = auth()->user()->name;
        //     $email = auth()->user()->email;
        //     return "Logado ID: $id, Nome: $nome, Email: $email";
        // } else {
        //     return "Nao logado";
        // }

        // Second Method using Auth from Facades
        // if (Auth::check()) {
        //     $id = Auth::user()->id;
        //     $nome = Auth::user()->name;
        //     $email = Auth::user()->email;
        //     return "Logado ID: $id, Nome: $nome, Email: $email";
        // } else {
        //     return "Nao logado";
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // return view('tarefa.store');

        $dados = $request->all();
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email; //email from logged user. 
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefas.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        return view('tarefa.edit', ['tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $tarefa->update($request->all());
        return redirect()->route('tarefas.show', ['tarefa' => $tarefa->id]);
        // print_r($request->all());
        // echo '<hr>';
        // print_r($tarefa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        //
    }
}
