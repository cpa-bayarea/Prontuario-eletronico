@csrf

{{ $user }}<br><br>
{{ $supervisors }}
{{ $perfil }}
<input id="id_user" type="hidden" name="id" value="{{ $user->id }}">

<div class="form-group">
    <label for="tx_name">{{ __('Nome') }}<span class="obrigatorio">*</span></label>
    <input id="tx_name" type="text" class="form-control" name="tx_name"
           value="{{ $user->tx_name }}" required autofocus>
</div>

<div class="form-group">
    <label for="username">{{ __('Matrícula') }} <span class="obrigatorio">*</span></label>
    <input id="username" type="text" class="form-control inteiro" name="username"
           value="{{ $user->username }}" required autofocus>
</div>
@can('Admin')
    <input type="hidden" id="val-pfl" value="{{ $user->id_perfil }}">
    <div class="form-group">
        <label for="id_perfil">{{ __('Perfil') }}<span class="obrigatorio">*</span></label>
        <select name="id_perfil" class="form-control" id="id_perfil" required>
            <option selected value="{{ $user->id_perfil }}">{{ $perfil[0]['tx_name'] }}</option>
            @foreach($perfis as $pfl)
                <option value="{{ $pfl->id_perfil }}">{{ $pfl->tx_name }}</option>
            @endforeach
        </select>
    </div>
@endcan

@can('Admin')
    <div class="form-group form-sup">
        <label for="id_theoretical_line">{{ __('Linha Teórica') }}<span class="obrigatorio">*</span></label>
        <select name="id_theoretical_line" class="form-control" id="id_theoretical_line">
            <option disabled selected>Selecione a Linha Teórica</option>
            @foreach($lines as $line)
                <option value="{{ $line->id_theoretical_line }}">{{ $line->tx_name  }}</option>
            @endforeach
        </select>
    </div>
@endcan
<div class="form-group all-profile">
    <label for="nu_telephone">{{ __('Nº Telefone') }} <span class="obrigatorio">*</span></label>
    <input id="nu_telephone" type="text" class="form-control inteiro" name="nu_telephone"
           value="{{ $user->nu_telephone }}" required autofocus>
</div>

<div class="form-group all-profile">
    <label for="nu_cellphone">{{ __('Nº Celular') }}</label>
    <input id="nu_cellphone" type="text" class="form-control inteiro" name="nu_cellphone"
           value="{{ $user->nu_cellphone ? $user->nu_cellphone : '-'}}" autofocus>
</div>

<div class="form-group form-sup">
    <label for="nu_crp">{{ __('Nº CRP') }}<span class="obrigatorio">*</span></label>
    <input id="nu_crp" type="text" class="form-control inteiro" name="nu_crp"
           value="{{ $user->nu_crp }}" autofocus>
</div>

<div class="form-group form-alu">
    <label for="nu_half">{{ __('Semestre') }}<span class="obrigatorio">*</span></label>
    <input id="nu_half" type="text" class="form-control inteiro" name="nu_half"
           value="{{ $user->nu_half }}" autofocus>
</div>

<div class="form-group" style="display: none;">
    <label for="tx_justify" title="Motivo do acesso ao sistema">{{ __('Justificativa') }}</label>
    <input id="tx_justify" type="text" class="form-control" name="tx_justify"
           value="{{ $user->tx_justify }}" autofocus>
</div>

<div class="form-group form-alu">
    <label for="id_supervisor">{{ __('Supervisor') }}<span class="obrigatorio">*</span></label>
    <select name="id_supervisor" class="form-control" id="id_supervisor">
        <option disabled selected>Selecione o Supervisor</option>
        @foreach($supervisors as $supervisor)
            <option value="{{ $supervisor->id_supervisor }}">{{ $supervisor->tx_name  }}</option>
        @endforeach
    </select>
</div>

<div class="form-group form-all">
    <label for="tx_email">{{ __('E-Mail') }}<span class="obrigatorio">*</span></label>
    <input id="tx_email" type="email" class="form-control" name="tx_email"
           value="{{ $user->tx_email }}" required>
</div>

{{-- Checks if user logged is owner of record or manager of system --}}
@if ( ( ((int)Auth()->user()->id) === $user->id ) || ( Auth()->user()->id_perfil === \App\User::PFL_ADM ) )
    <div class="form-group form-all">
        <label for="password">{{ __('Senha') }}<span class="obrigatorio">*</span></label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>

    <div class="form-group form-all">
        <label for="password-confirm">{{ __('Confirme a senha') }}<span class="obrigatorio">*</span></label>
        <input id="password-confirm" type="password" class="form-control"
                name="password_confirmation" required>
    </div>
@endif

<div class="form-group mb-0 right">
    <button type="submit" class="btn btn-primary block full-width m-b btn-register">
        <i class="fa fa-send">&nbsp; {{ __('Cadastre-se') }}</i>
    </button>
</div>