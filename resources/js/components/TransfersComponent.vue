<template>
    <div>
        <div class="form-row">
            <div class="col">
                <input type="text" name="city"
                       v-model="data.city"
                       class="form-control" placeholder="Grad">
            </div>
            <div class="col">
                <input type="text"
                       v-model="data.carrier"
                       class="form-control" placeholder="Prijevoznik">
            </div>

            <div class="col">
                <datetime type="datetime"
                          format="yyyy-MM-dd HH:mm:ss"
                          input-class="form-control"
                          v-model="data.datetime">
                </datetime>
            </div>


            <div class="col">
                <button class="btn btn-block btn-primary" @click="addTransfer()">Unos</button>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table  table-striped" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Autobusna linija</th>
                            <th>Prijevoznik</th>
                            <th>Vrijeme</th>
                            <th>Status</th>
                            <th>Akcija</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="transfer in transfers">
                            <td>{{ transfer.datetime | date }}</td>
                            <td>{{ transfer.city }}</td>
                            <td>{{ transfer.carrier }}</td>
                            <td>{{ transfer.datetime | time }}</td>
                            <td>{{ transfer.status }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger">Brisanje</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import moment from 'moment'

    export default {


        mounted() {
            this.getTransfers()
        },


        data() {
            return {

                data: {
                    city: '',
                    carrier: '',
                    status: '',
                    datetime: '',
                },
                transfers: [],
            }
        },

        props: ['type'],


            methods: {
                delete() {

                },


                getTransfers() {

                    axios.get('/' + this.type + '/'
                    ).then(response => {
                        this.transfers = response.data
                    }).catch(error => {
                        this.error = true
                    });
                },


                addTransfer() {

                    axios.post('/' + this.type + '/', this.data
                    ).then(response => {
                        this.getTransfers();

                    }).catch(error => {
                        this.error = true
                    });
                },


            }
        }
</script>
