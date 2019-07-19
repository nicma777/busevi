<template>
    <div>
        <div class="form-row">
            <div class="col  col-md-3 col-sm-12 col-xs-12">
                <label for="">Grad</label>
                <input type="text" name="city"
                       v-model="data.city"
                       class="form-control" >
            </div>
            <div class="col  col-md-3 col-sm-12 col-xs-12">
                <label for="">Prijevoznik</label>
                <input type="text"
                       v-model="data.carrier"
                       class="form-control" >
            </div>

            <div class="col  col-md-3 col-sm-12 col-xs-12">
                <label for="">Datum i vrijeme</label>

                <datetime type="datetime"
                          format="yyyy-MM-dd HH:mm:ss"
                          input-class="form-control"
                          v-model="data.datetime">
                </datetime>
            </div>

            <div class="col col-md-2 col-sm-12 col-xs-12">
                <label for="">Status</label>

                <select v-model="data.status" class="form-control"id="">
                    <option value="">OK</option>
                    <option value="1">DELAY</option>
                </select>
            </div>

            <div class="col col-md-1 col-sm-12 col-xs-12">
                <label for="">&nbsp;</label>

                <button class="btn btn-block btn-success" @click="addTransfer()"><i class="fa fa-save"></i></button>
            </div>

        </div>

        <div class="row mt-3">
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
                            <th class="text-right">Akcija</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="transfer in transfers">
                            <td>{{ transfer.datetime | date }}</td>
                            <td>{{ transfer.city }}</td>
                            <td>{{ transfer.carrier }}</td>
                            <td>{{ transfer.datetime | time }}</td>
                            <td>
                                <span v-if="!transfer.status" class="badge badge-success">OK</span>
                                <span v-else class="badge badge-danger">DELAY</span>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-sm btn-secondary" @click="changeStatus(transfer.id, transfer.status)"><i class="fa fa-clock-o"></i></button>

                                <button class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></button>
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

                changeStatus(id, currentStatus){

                    axios.put('/' + this.type + '/' + id, {status: currentStatus}
                    ).then(response => {
                        this.getTransfers();

                    }).catch(error => {
                        this.error = true
                    });
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
