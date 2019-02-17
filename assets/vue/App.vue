
<template>
    <ul v-if="journies && journies.length">
        <li v-for="journey of journies">
            <p><strong>{{journey.title}}</strong></p>
            <p>{{journey.description}}</p>
        </li>
    </ul>

</template>


<script>
    import axios from 'axios';
    let config = require('../config/config.json');

    export default {
        name: 'app',
        data(){
        	return{
                loading : false,
                journies : [],
                errors : []
        	}
        },
        created () {
            // fetch the data when the view is created and the data is
            // already being observed
            this.fetchData()
        },
        methods : {
            fetchData () {
                this.error = this.post = null;
                this.loading = true;
                // replace `getPost` with your data fetching util / API wrapper

                axios.get(config.host+"/api"+config.getJournies)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        console.log(response.data);
                        this.journies = response.data;
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });

            }
        }
    }
</script>