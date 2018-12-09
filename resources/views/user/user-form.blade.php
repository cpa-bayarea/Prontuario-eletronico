@csrf

<div class="form-group">
    <label for="tx_name">{{ __('Nome') }}<span class="obrigatorio">*</span></label>
    <input id="tx_name" type="text"
            class="form-control{{ $errors->has('tx_name') ? ' is-invalid' : '' }}"
            name="tx_name" value="{{ old('tx_name') }}" required autofocus>
    @if ($errors->has('tx_name'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('tx_name') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    <label for="matricula">{{ __('Matrícula') }} <span class="obrigatorio">*</span></label>
    <input id="matricula" type="text"
            class="form-control inteiro{{ $errors->has('username') ? ' is-invalid' : '' }}"
            name="username" value="{{ old('username') }}" required autofocus>
    @if ($errors->has('username'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('username') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    <label for="id_perfil">{{ __('Perfil') }}<span class="obrigatorio">*</span></label>
    <select name="id_perfil" class="form-control" id="id_perfil" required>
        <option disabled selected>Selecione o Perfil</option>
        @foreach($perfis as $perfil)
            <option value="{{ $perfil->id_perfil }}">{{ $perfil->tx_name  }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_perfil'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('id_perfil') }}</strong>
        </span>
    @endif
</div>

<div class="form-group form-sup">
    <label for="id_theoretical_line">{{ __('Linha Teórica') }}<span class="obrigatorio">*</span></label>
    <select name="id_theoretical_line" class="form-control" id="id_theoretical_line">
        <option disabled selected>Selecione a Linha Teórica</option>
        @foreach($lines as $line)
            <option value="{{ $line->id_theoretical_line }}">{{ $line->tx_name  }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_theoretical_line'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('id_theoretical_line') }}</strong>
        </span>
    @endif
</div>

<div class="form-group all-profile">
    <label for="nu_telephone">{{ __('Nº Telefone') }} <span class="obrigatorio">*</span></label>
    <input id="nu_telephone" type="text"
            class="form-control inteiro{{ $errors->has('nu_telephone') ? ' is-invalid' : '' }}"
            name="nu_telephone" value="{{ old('nu_telephone') }}" required autofocus>
    @if ($errors->has('nu_telephone'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nu_telephone') }}</strong>
        </span>
    @endif
</div>

<div class="form-group all-profile">
    <label for="nu_cellphone">{{ __('Nº Celular') }}</label>
    <input id="nu_cellphone" type="text"
            class="form-control inteiro{{ $errors->has('nu_cellphone') ? ' is-invalid' : '' }}"
            name="nu_cellphone" value="{{ old('nu_cellphone') }}" autofocus>
    @if ($errors->has('nu_cellphone'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nu_cellphone') }}</strong>
        </span>
    @endif
</div>

<div class="form-group form-sup">
    <label for="nu_crp">{{ __('Nº CRP') }}<span class="obrigatorio">*</span></label>
    <input id="nu_crp" type="text"
            class="form-control inteiro{{ $errors->has('nu_crp') ? ' is-invalid' : '' }}"
            name="nu_crp" value="{{ old('nu_crp') }}" autofocus>
    @if ($errors->has('nu_crp'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nu_crp') }}</strong>
        </span>
    @endif
</div>

<div class="form-group form-alu">
    <label for="nu_half">{{ __('Semestre') }}<span class="obrigatorio">*</span></label>
    <input id="nu_half" type="text"
            class="form-control inteiro{{ $errors->has('nu_half') ? ' is-invalid' : '' }}"
            name="nu_half" value="{{ old('nu_half') }}" autofocus>
    @if ($errors->has('nu_half'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nu_half') }}</strong>
        </span>
    @endif
</div>

<div class="form-group" style="display: none;">
    <label for="tx_justify" title="Motivo do acesso ao sistema">{{ __('Justificativa') }}</label>
    <input id="tx_justify" type="text" class="form-control{{ $errors->has('tx_justify') ? ' is-invalid' : '' }}"
            name="tx_justify" value="{{ old('tx_justify') }}" autofocus>
    @if ($errors->has('tx_justify'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('tx_justify') }}</strong>
        </span>
    @endif
</div>

<div class="form-group form-alu">
    <label for="id_supervisor">{{ __('Supervisor') }}<span class="obrigatorio">*</span></label>
    <select name="id_supervisor" class="form-control" id="id_supervisor">
        <option disabled selected>Selecione o Supervisor</option>
        @foreach($supervisors as $supervisor)
            <option value="{{ $supervisor->id_supervisor }}">{{ $supervisor->tx_name  }}</option>
        @endforeach
    </select>

    @if ($errors->has('id_supervisor'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('id_supervisor') }}</strong>
        </span>
    @endif
</div>

<div class="form-group form-all">
    <label for="tx_email">{{ __('E-Mail') }}<span class="obrigatorio">*</span></label>
    <input id="tx_email" type="email"
        class="form-control{{ $errors->has('tx_email') ? ' is-invalid' : '' }}"
        name="tx_email" value="{{ old('tx_email') }}" required>
    @if ($errors->has('tx_email'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('tx_email') }}</strong>
    </span>
    @endif
</div>

<div class="form-group form-all">
    <label for="password">{{ __('Senha') }}<span class="obrigatorio">*</span></label>
    <input id="password" type="password"
        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
        name="password" required>

    @if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
</div>

<div class="form-group form-all">
    <label for="password-confirm">{{ __('Confirme a senha') }}<span class="obrigatorio">*</span></label>
    <input id="password-confirm" type="password" class="form-control"
            name="password_confirmation" required>
</div>

<div class="form-group mb-0 right">
    <button type="submit" class="btn btn-primary block full-width m-b btn-register">
        <i class="fa fa-send">&nbsp; {{ __('Cadastre-se') }}</i>
    </button>
</div>