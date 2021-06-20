<template>
    <div>
        <h1>Listado de Vehiculos por marca</h1>
        <div v-for="(vehiculos,marca) in listaVehiculos" :key="marca" class="mt-2">
            <h3 class="text-primary">{{marca}}</h3>
            <div class="bg-white rounded p-3 border">
                <div class="row">
                    <div v-for="vehiculo in vehiculos" :key="vehiculo.id" class="col-md-4 mt-2 border rounded">
                        <div><span class="font-weight-bold">Placa: </span>{{vehiculo.placa}}</div>
                        <div><span class="font-weight-bold">Marca: </span>{{vehiculo.marca}}</div>
                        <div><span class="font-weight-bold">Tipo: </span>{{vehiculo.tipo}}</div>
                        <div><span class="font-weight-bold">Nombre: </span>{{vehiculo.propietario.nombre}}</div>
                        <div><span class="font-weight-bold">Cedula: </span>{{vehiculo.propietario.cedula}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function(){
        return {
            listaVehiculos: {}
        }
    },
    mounted(){
        axios.get('/api/vehiculos/')
            .then( (response) => {
                this.listaVehiculos = response.data
            })
            .catch( (error) =>{
                console.log(error)
            });
    }
}
</script>