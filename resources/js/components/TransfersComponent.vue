<template>
  <div>
    <div class="form-row">
      <div class="col col-md-3 col-sm-12 col-xs-12">
        <label for>Grad</label>
        <input type="text" name="city" v-model="data.city" class="form-control">
      </div>
      <div class="col col-md-3 col-sm-12 col-xs-12">
        <label for>Prijevoznik</label>
        <input type="text" v-model="data.carrier" class="form-control">
      </div>

      <div class="col col-md-3 col-sm-12 col-xs-12">
        <label for>Vrijeme</label>
        <datetime type="time" input-class="form-control" v-model="data.time"></datetime>
      </div>

      <div class="col col-md-2 col-sm-12 col-xs-12">
        <label for>Status</label>

        <select v-model="data.status" class="form-control" id>
          <option value="0">OK</option>
          <option value="1">DELAY</option>
          <option value="2">ON GATE</option>
        </select>
      </div>

      <div class="col col-md-1 col-sm-12 col-xs-12">
        <label for>&nbsp;</label>

        <button class="btn btn-block btn-success" @click="addTransfer()">
          <i class="fa fa-save"></i>
        </button>
      </div>
    </div>
    <div class="form-row">
      <div class="col">
            <p class="dani">Aktivni dani: </p>
        <input
          type="checkbox"
          input-class="form-control"
          value="1"
          v-model="data.days"
          id="mon"
        >
        <label for="mon">Ponedeljak</label>
        <input
          type="checkbox"
          input-class="form-control"
          value="2"
          v-model="data.days"
          id="tue"
        >
        <label for="tue">Utorak</label>
        <input
          type="checkbox"
          input-class="form-control"
          value="3"
          v-model="data.days"
          id="wed"
        >
        <label for="wed">Srijeda</label>
        <input
          type="checkbox"
          input-class="form-control"
          value="4"
          v-model="data.days"
          id="thu"
        >
        <label for="thu">Četvrtak</label>
        <input
          type="checkbox"
          input-class="form-control"
          value="5"
          v-model="data.days"
          id="fri"
        >
        <label for="fri">Petak</label>
        <input
          type="checkbox"
          input-class="form-control"
          value="6"
          v-model="data.days"
          id="sat"
        >
        <label for="sat">Subota</label>
        <input
          type="checkbox"
          input-class="form-control"
          value="7"
          v-model="data.days"
          id="sun"
        >
        <label for="sun">Nedelja</label>

      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped" style="width: 100%">
            <thead>
              <tr>
                <th>Autobusna linija</th>
                <th>Prijevoznik</th>
                <th>Vrijeme</th>
                <th>Status</th>
                <th class="text-right">Akcija</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="transfer in transfers">
                <td>{{ transfer.city }}</td>
                <td>{{ transfer.carrier }}</td>
                <td>{{ transfer.time}}</td>
                <td>
                  <span v-if="!transfer.status" class="badge badge-success">OK</span>
                  <span v-else-if="transfer.status == '1'" class="badge badge-danger">DELAY</span>
                  <span v-else-if="transfer.status == '2'" class="badge badge-success">ON GATE</span>
                  <span v-else-if="transfer.status == '3'" class="badge badge-info">LEAVE</span>
                </td>
                <td class="text-right">
                  <button class="btn btn-sm btn-secondary" @click="statusChange(transfer.id, 0)">
                    <i class="fa fa-check"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" @click="statusChange(transfer.id, 1)">
                    <i class="fa fa-clock-o"></i>
                  </button>

                  <button class="btn btn-sm btn-success" @click="statusChange(transfer.id, 2)">
                    <i class="fa fa-bus"></i>
                  </button>
                  <button class="btn btn-sm btn-info" @click="statusChange(transfer.id, 3)">
                    <i class="fa fa-road"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" @click="remove(transfer.id)">
                    <i class="fa fa-fw fa-trash"></i>
                  </button>
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
    this.getTransfers();
  },

  data() {
    return {
      data: {
        city: "",
        carrier: "",
        status: "0",
        time: "",
        days: []
      },
      transfers: []
    };
  },

  props: ["type"],

  methods: {
    remove(id) {
      this.$swal({
        title: "Jeste li sigurni da želite obrisati rutu?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Da!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("/" + this.type + "/" + id)
            .then(response => {
              this.getTransfers();
            })
            .catch(error => {
              this.error = true;
            });

          this.$swal("Ruta je obrisana!", null, "success");
        }
      });
    },

    statusChange(id, newStatus) {
      this.$swal({
        title: "Jeste li sigurni?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Da!"
      }).then(result => {
        if (result.value) {
          axios
            .put("/" + this.type + "/" + id, { status: newStatus })
            .then(response => {
              this.getTransfers();
            })
            .catch(error => {
              this.error = true;
            });

          this.$swal("Status je promjenjen!", null, "success");
        }
      });
    },

    getTransfers() {
      axios
        .get("/" + this.type + "/")
        .then(response => {
          this.transfers = response.data;
        })
        .catch(error => {
          this.error = true;
        });
    },

    addTransfer() {
      axios
        .post("/" + this.type + "/", this.data)
        .then(response => {
          this.getTransfers();
        })
        .catch(error => {
          this.error = true;
        });
    }
  }
};
</script>