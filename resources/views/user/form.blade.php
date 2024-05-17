<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('name') }}</label>
    <div>
        {{ Form::text('name', $user->name ?? '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">user <b>name</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('email') }}</label>
    <div>
        {{ Form::text('email', $user->email ?? '', ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">user <b>email</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('activo') }}</label>
    <div>
        {{ Form::select('activo', [0 => 'Usuario Común', 1 => 'Administrador'], null, ['class' => 'form-control' . ($errors->has('activo') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Rol']) }}
        {!! $errors->first('activo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">user <b>activo</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('password') }}</label>
    <div>
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password']) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">user <b>password</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('password_confirmation') }}</label>
    <div>
        {{ Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'Confirm Password']) }}
        {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">user <b>password_confirmation</b> instruction.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>
