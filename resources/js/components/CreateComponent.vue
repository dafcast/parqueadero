<template>
    <div>
        <h1 class="text-center">Nuevo vehiculo</h1>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form>
                    <div class="form-group">
                        <label for="placa">Placa del Vehiculo:</label>
                        <input type="text" class="form-control" id="placa">
                        <span class="invalid-feedback font-weight-bold" role="alert" id="alerta-placa"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="marca">Marca del Vehiculo:</label>
                        <input type="text" class="form-control" id="marca">
                        <span class="invalid-feedback font-weight-bold" role="alert" id="alerta-marca"></span>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de Vehiculo:</label>
                        <input type="text" class="form-control" id="tipo">
                        <span class="invalid-feedback font-weight-bold" role="alert" id="alerta-tipo"></span>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre del propietario:</label>
                        <input type="text" class="form-control" id="nombre">
                        <span class="invalid-feedback font-weight-bold" role="alert" id="alerta-nombre"></span>
                    </div>

                    <div class="form-group">
                        <label for="cedula">Cedula del propietario:</label>
                        <input type="text" class="form-control" id="cedula">
                        <span class="invalid-feedback font-weight-bold" role="alert" id="alerta-cedula"></span>
                    </div>
                    <input type="submit" value="Crear" class="btn btn-primary text-uppercase" @click="crear">
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        crear(e){
            e.preventDefault();

            let params = new FormData();

            params.append('placa',document.querySelector('#placa').value)
            params.append('marca',document.querySelector('#marca').value)
            params.append('tipo',document.querySelector('#tipo').value)
            params.append('nombre',document.querySelector('#nombre').value)
            params.append('cedula',document.querySelector('#cedula').value)

            axios.post('/api/vehiculos', params)
                .then( (response) => {

                    var inputsVehiculo = document.querySelectorAll('.form-control');
                    inputsVehiculo.forEach( (element) => {
                        element.classList.remove('is-invalid')
                    });

                    if(response.data.created){
                        window.location.href = "/";
                    }else{
                        let errores = response.data.message;

                        for(var [key,value] of Object.entries(errores)){
                            var elementError = document.querySelector('#'+key);
                            elementError.classList.add('is-invalid')
                            
                            var alerta = document.querySelector('#alerta-'+key)
                            alerta.innerHTML = value
                        }

                    }
                })
                .catch( (error) => {
                    console.log(error)
                })
        }
    }
}
</script>