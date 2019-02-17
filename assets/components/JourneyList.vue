
<template>
    <ul v-if="journeyList && journeyList.length">
        <li v-for="journeyItem of journeyList">
            <p><strong>{{journeyItem.title}}</strong></p>
            <p>{{journeyItem.description}}</p>
        </li>
    </ul>

</template>


<script>
    import axios from 'axios';
    let config = require('../config/config.json');

    export default {
        name: 'JourneyList',
        data(){
        	return{
                loading : false,
                journeyList : [],
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
                        this.journeyList = response.data;
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });

            }
        }
    }
</script>