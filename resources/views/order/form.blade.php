
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('user_id') }}</label>
    <div>
        {{ Form::text('user_id', $order->user_id, ['class' => 'form-control' .
        ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>user_id</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('nombre') }}</label>
    <div>
        {{ Form::text('nombre', $order->nombre, ['class' => 'form-control' .
        ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>nombre</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('email') }}</label>
    <div>
        {{ Form::text('email', $order->email, ['class' => 'form-control' .
        ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>email</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('telefono') }}</label>
    <div>
        {{ Form::text('telefono', $order->telefono, ['class' => 'form-control' .
        ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
        {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>telefono</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('direccion') }}</label>
    <div>
        {{ Form::text('direccion', $order->direccion, ['class' => 'form-control' .
        ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
        {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>direccion</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('ciudad') }}</label>
    <div>
        {{ Form::text('ciudad', $order->ciudad, ['class' => 'form-control' .
        ($errors->has('ciudad') ? ' is-invalid' : ''), 'placeholder' => 'Ciudad']) }}
        {!! $errors->first('ciudad', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>ciudad</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('departamento') }}</label>
    <div>
        {{ Form::text('departamento', $order->departamento, ['class' => 'form-control' .
        ($errors->has('departamento') ? ' is-invalid' : ''), 'placeholder' => 'Departamento']) }}
        {!! $errors->first('departamento', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>departamento</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('postal') }}</label>
    <div>
        {{ Form::text('postal', $order->postal, ['class' => 'form-control' .
        ($errors->has('postal') ? ' is-invalid' : ''), 'placeholder' => 'Postal']) }}
        {!! $errors->first('postal', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>postal</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('total') }}</label>
    <div>
        {{ Form::text('total', $order->total, ['class' => 'form-control' .
        ($errors->has('total') ? ' is-invalid' : ''), 'placeholder' => 'Total']) }}
        {!! $errors->first('total', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">order <b>total</b> instruction.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
