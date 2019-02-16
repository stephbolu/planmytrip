


<template>
    <div class="container">
        <h1 class="red">H1 : test sur la page</h1>
        <h2>Affichage des données de voyage</h2>
        <p>Titre du voyage : {{journey.title}}</p>
        <p>Description du voyage : {{journey.description}}</p>
    </div>
</template>


<script>
    export default {
        name: 'app',
        data(){
        	return{
        		journey:{
        			title : "périple au Pérou",
        			description : "voyage de 2 semaine au coeur des cités incas"
        		}

        	}
        }
    }
</script>