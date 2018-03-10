<style>
    .logo{
        width: 55px;
        margin-left: 10px;
    }
    @media only screen and (min-width: 993px) {
    .logo {
            width: 65px;
        }
    }
</style>
<nav class="red darken-3">
	<div class="nav-wrapper">
		<a href="/" class="brand-logo"><img src="{{asset('img/logo.png')}}" class="logo"></a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul class="right hide-on-med-and-down">
			<li><a href="{{route('aluno.index')}}">Aluno</a></li>
			<li><a href="{{route('supervisor.index')}}">Supervisor</a></li>
			<li><a href="{{route('triagem.index')}}">Triagem</a></li>
			<li><a href="{{route('paciente.index')}}">Paciente</a></li>

		</ul>
		<ul class="side-nav" id="mobile-demo">
			<li><a href="{{route('aluno.index')}}">Aluno</a></li>
			<li><a href="{{route('supervisor.index')}}">Supervisor</a></li>
			<li><a href="/triagem}">Triagem</a></li>
			<li><a href="{{route('paciente.index')}}">Paciente</a></li>

		</ul>
	</div>
</nav>