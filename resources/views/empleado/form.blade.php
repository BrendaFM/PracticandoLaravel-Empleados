<style>
    .color{
        background-color: white;
    }
</style>
<h1>{{$modo}} empleado</h1>
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="form-group">
    <label for="Nombres">Nombre</label>
    <input type="text" class="form-control mb-4 color" name="Nombres" value="{{isset($empleado->Nombres)?$empleado->Nombres:old('Nombres') }}" id="Nombres">
</div>
<div class="form-group">
    <label for="PrimerApellido">Primer Apellido</label>
    <input type="text" class="form-control mb-4 color" name="PrimerApellido" value="{{isset($empleado->PrimerApellido)?$empleado->PrimerApellido:old('PrimerApellido')}}" id="PrimerApellido">
</div>
<div class="form-group">
    <label for="SegundoApellido">Segundo Apellido</label>
    <input type="text" class="form-control mb-4 color" name="SegundoApellido" value="{{isset($empleado->SegundoApellido)?$empleado->SegundoApellido:old('SegundoApellido') }}" id="SegundoApellido">
</div>
<div class="form-group">
    <label for="Numerodoc">Número de doc.</label>
    <input type="text" class="form-control mb-4 color" name="Numerodoc" value="{{isset($empleado->Numerodoc)?$empleado->Numerodoc:old('Numerodoc') }}" id="Numerodoc">
</div> 
<div class="form-group">
    <label for="Correo">Correo</label>
    <input type="text" class="form-control mb-4 color" name="Correo" value="{{isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" id="Correo">
</div>
<div class="form-group">
    <label for="Fotografia">Fotografia</label>
    @if(isset($empleado->Fotografia))
    <img src="{{asset('storage').'/'.$empleado->Fotografia}}" width="120" alt="">
    @endif
    <input class="form-control mb-4 color"  type="file" name="Fotografia" value="" id="Fotografia">
</div>

<input type="submit" class="btn btn-success" value="{{$modo}} datos">
<a class="btn btn-primary" href="{{url('empleado/')}}">Regresar</a>
<br>