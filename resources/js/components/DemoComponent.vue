<template>
    <div>
        <h1>DEMO</h1>
        <h2>Arreglo de entrada</h2>
        <div id="entrada"></div>

    </div>
</template>
<script>
export default {
    mounted(){
        const arreglo = [
            ["2018-12-01","AM","ID123", 5000], 
            ["2018-12-01","AM","ID545", 7000], 
            ["2018-12-01","PM","ID545", 3000], 
            ["2018-12-02","AM","ID545", 7000]	
        ]
        
        mostrarEntrada(arreglo)

        agrupar(arreglo)

        function agrupar(arreglo){
            let objeto = {}

            arreglo.forEach(elemento => {
                let franja = {}
                franja[elemento[1]] = elemento[3]
                
                if(objeto[elemento[0]]){
                    if(objeto[elemento[0]][elemento[1]]){
                        objeto[elemento[0]][elemento[1]] = objeto[elemento[0]][elemento[1]] + elemento[3]
                    }else{
                        objeto[elemento[0]][elemento[1]] = elemento[3]
                    }
                }else{
                    objeto[elemento[0]] = franja
                }
            });
            console.log(objeto)
        }

        function mostrarEntrada(arreglo){

            var htmlEntreda = document.querySelector('#entrada')
            htmlEntreda.innerHTML = '['

            arreglo.forEach( (element) => {
                var htmlEntreda = document.querySelector('#entrada')
                var fila = document.createElement('div')
                fila.innerHTML = '['
                element.forEach( (element2) => {
                    fila.innerHTML = fila.innerHTML + `"${element2}",`
                })
                fila.innerHTML = fila.innerHTML + `]`
                
                htmlEntreda.appendChild(fila)
            })
            htmlEntreda.innerHTML = htmlEntreda.innerHTML + ']'
        }

    }
}
</script>