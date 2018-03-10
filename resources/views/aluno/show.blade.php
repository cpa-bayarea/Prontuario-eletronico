@extends('templates/principal')

@section('titulo', $aluno->tx_nome)

@section('conteudo')

    <div class="row">
        <div class="col s10 offset-s1">
            <div class="card">
                <div class="card-content">
                    <div>
                        	<h1> Aluno {{$aluno->tx_nome}} </h1>
                    </div>



	<ul>
	
		<li> Endereço : {{$aluno->tx_endereco}}</li>
		
		<li> Número : {{$aluno->nu_numero}}</li>
		
		<li>Bairro : {{$aluno->tx_bairro}}</li>
		
		<li>Cidade : {{$aluno->tx_cidade}}</li>
		
		<li> UF : {{$aluno->tx_uf}}</li>
		
		<li>Celular : {{$aluno->nu_fone}}</li>
		
		<li>Teelfone : {{$aluno->nu_fone2}}</li>
		
		<li>Adicionado em : {{date("d/m/Y",strtotime($aluno->created_at))}}</li>
		
        <li>Supervisor : {{$aluno->fk_supervisor}} </li>
        
	</ul>


	
	<a href='/aluno' style="text-align:right">Voltar</a>

</div>
</div>
</div>
</div>
@endsection