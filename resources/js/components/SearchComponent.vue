<template>
    <div class="mb-3">
        <h1>Buscar Vehiculo</h1>
        <form action="">
            <div class="row">
                <div class="col-md-3">
                    <select  id="parametro" class="form-control">
                        <option value="placa">Por placa</option>
                        <option value="nombre">Por nombre</option>
                        <option value="cedula">Por cedula</option>
                    </select>
                </div>
                <div class="col-md-9">
                    <input type="search" id="search" class="form-control">
                </div>
            </div>
        </form>

        <div id="resultados" class="mt-3 bg-white rounded p-3 border">
            <div class="row">
            </div>
        </div>


    </div>
</template>
<script>
export default {
    data: function(){
        return {
            vehiculos:{}
        }
    },
    mounted(){
        const search = document.querySelector('#search');
        search.addEventListener('input', function(){
            const parametro = document.querySelector('#parametro').value
            let url = `/api/vehiculos/search/?${parametro}=${this.value}`
            
            let resultado = document.querySelector('#resultados').firstChild

            axios.get(url)
                .then( (response) => {
                    
                    let vehiculosData = response.data

                    while( resultado.firstChild){
                        resultado.removeChild(resultado.firstChild)
                    }
    
                    vehiculosData.forEach(vehiculo => {
                        let element = document.createElement('div')
                        element.classList.add('col-md-4')
                        element.classList.add('mb-2')
                        element.classList.add('rounded')
                        element.classList.add('border')
                        element.innerHTML = `
                            <div><span class="font-weight-bold">Placa: </span>${vehiculo.placa}</div>
                            <div><span class="font-weight-bold">Marca: </span>${vehiculo.marca}</div>
                            <div><span class="font-weight-bold">Tipo: </span>${vehiculo.tipo}</div>
                            <div><span class="font-weight-bold">Nombre: </span>${vehiculo.propietario.nombre}</div>
                            <div><span class="font-weight-bold">Cedula: </span>${vehiculo.propietario.cedula}</div>
                        `;
                        resultado.appendChild(element)
                    });
                })
                .catch( (error) => {
                    console.log(error)
                })
        })
    },
    computed:{
        vehiculosSearch: function(){
            return this.vehiculos;
        }
    }
}
</script>