<?php
namespace App\Http\Controllers;
use App\Aluno;
use App\Supervisor;
use App\Http\Requests\AlunoRequest;
class AlunoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {  
        $dados = Aluno::all();
        return view('aluno.index', compact('dados'));
    }
    public function incluir()
    {
        //Recebe dados do supervisor
        $supervisores = Supervisor:: all();
        return view('aluno.form', compact('supervisores'));
    }
    public function alterar($id)
    {
        $dados = Aluno::where('id_aluno', $id)->get();
        $dados = $dados[0];
        $supervisores = Supervisor:: all();
//            print_r($dados);
//            die;
        return view('aluno.form', ['dados' => $dados, 'supervisores' => $supervisores]);
    }
    public function salvar(AlunoRequest $dados)
    {
        if ($dados['id_aluno']) {
            Aluno::find($dados['id_aluno'])->update($dados->all());
            return redirect(route('aluno.index'));
        } else {
            Aluno::create($dados->all());
            return redirect(route('aluno.index'));
        }
    }
    public function deletar($dados)
    {
        Aluno::where('id_aluno', $dados)->delete();
        return redirect(route('aluno.index'));
    }
    
}




//<?php
// namespace App\Http\Controllers;
// use App\Aluno;
// use App\Supervisor;
// use App\Http\Requests\AlunoRequest;
// class AlunoController extends Controller
// {
//     public function index()
//     {
//         $dados = Aluno::all();
//         return view('aluno.index', compact('dados'));
//     }
    
//     public function show($id){
        
//         $aluno = Aluno::find($id); 
//         $supervisor = Supervisor::all();
    	
//     	return view('aluno.show', compact('aluno','supervisor'));
        
//     }
    
    
//     public function create()
//     {
//         //Recebe dados do supervisor
//         $supervisores = Supervisor:: all();
//         return view('aluno.create', compact('supervisores'));
//     }
//     public function alterar($id)
//     {
//         $dados = Aluno::where('id_aluno', $id)->get();
//         $dados = $dados[0];
//         $supervisores = Supervisor:: all();
// //            print_r($dados);
// //            die;
//         return view('aluno.form', ['dados' => $dados, 'supervisores' => $supervisores]);
//     }
//   public function store(Request $request){
        
//         $aluno = new Aluno();
		
// 		$aluno->nu_codigo = $request->input('nu_codigo');
// 		$aluno->tx_nome = $request->input('tx_nome');
// 		$aluno->nu_cep = $request->input('nu_cep');
// 		$aluno->tx_endereco = $request->input('tx_endereco');
// 		$aluno->nu_numero = $request->input('nu_numero');
// 		$aluno->tx_bairro = $request->input('tx_bairro');
// 		$aluno->tx_cidade = $request->input('tx_cidade');
// 		$aluno->tx_uf = $request->input('tx_uf');
// 		$aluno->nu_fone = $request->input('nu_fone');
// 		$aluno->fk_supervisor = $request->input('fk_supervisor');
	
		
// 		if($aluno->save()){ return redirect('aluno.index');	}}
		
//     public function deletar($dados)
//     {
//         Aluno::where('id_aluno', $dados)->delete();
//         return redirect(route('aluno.index'));
//     }
    
//}