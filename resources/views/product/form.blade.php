
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('name') }}</label>
    <div>
        {{ Form::text('name', $product->name, ['class' => 'form-control' .
        ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">product <b>name</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('description') }}</label>
    <div>
        {{ Form::text('description', $product->description, ['class' => 'form-control' .
        ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">product <b>description</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('price') }}</label>
    <div>
        {{ Form::text('price', $product->price, ['class' => 'form-control' .
        ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price']) }}
        {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">product <b>price</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('image', 'Image') }}</label>
    <div>
        {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'onchange' => 'previewImage(event)']) }}
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Product <b>image</b> instruction.</small>
        <img id="imagePreview" src="#" alt="your image" style="display: none; max-width: 200px; margin-top: 10px;" />
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
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
