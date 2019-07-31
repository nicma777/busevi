<template>
  <div>
    <div class="form-row">
      <div class="col col-md-3 col-sm-12 col-xs-12">
        <label for>Grad</label>
        <input
          type="text"
          name="city"
          v-model="data.city"
          class="form-control"
          :class="{ 'is-invalid': errors['city'] }"
        >

        <span class="invalid-feedback" role="alert">
          <strong v-for="error in errors.city">{{ error }}</strong>
        </span>
      </div>

      <div class="col col-md-3 col-sm-12 col-xs-12">
        <label for>Prijevoznik</label>
        <input
          type="text"
          v-model="data.carrier"
          class="form-control"
          :class="{ 'is-invalid': errors['carrier'] }"
        >

        <span class="invalid-feedback" role="alert">
          <strong v-for="error in errors.carrier">{{ error }}</strong>
        </span>
      </div>

      <div class="col col-md-3 col-sm-12 col-xs-12 is-invalid">
        <label for>Vrijeme</label>

        <datetime type="time" v-model="data.time" input-class="form-control"></datetime>

        <span v-if="errors.time" role="alert" class="invalid-feedback" style="display: block">
          <strong v-for="error in errors.time">{{ error }}</strong>
        </span>
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
      <div class="col col-md-12 mt-3">
        <div class="form-check form-check-inline">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': errors['days'] }"
            value="1"
            v-model="data.days"
            id="mon"
          >
          <label for="mon" class="form-check-label">Ponedeljak</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': errors['days'] }"
            value="2"
            v-model="data.days"
            id="tue"
          >
          <label for="tue" class="form-check-label">Utorak</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': errors['days'] }"
            value="3"
            v-model="data.days"
            id="wed"
          >
          <label for="wed" class="form-check-label">Srijeda</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': errors['days'] }"
            value="4"
            v-model="data.days"
            id="thu"
          >
          <label for="thu" class="form-check-label">Četvrtak</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': errors['days'] }"
            value="5"
            v-model="data.days"
            id="fri"
          >
          <label for="fri" class="form-check-label">Petak</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': errors['days'] }"
            value="6"
            v-model="data.days"
            id="sat"
          >
          <label for="sat" class="form-check-label">Subota</label>
        </div>
        <div class="form-check form-check-inline">
          <input
            type="checkbox"
            class="form-check-input"
            :class="{ 'is-invalid': errors['days']}"
            value="7"
            v-model="data.days"
            id="sun"
          >
          <label for="sun" class="form-check-label">Nedelja</label>
        </div>
        <button class="btn btn-sm btn-primary" @click="selectAll()">Odaberi sve</button>

        <span v-if="errors.days" role="alert" class="invalid-feedback" style="display: block">
          <strong>Odaberite barem jedan dan.</strong>
        </span>
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
                <th>Dani</th>
                <th>Status</th>
                <th>Activity</th>
                <th class="text-right">Akcija</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="transfer in transfers">
                <td>{{ transfer.city }}</td>
                <td>{{ transfer.carrier }}</td>
                <td>{{ transfer.time}}</td>
                <td>
                  <span v-for="day in transfer.days">{{day.day_hr}} &nbsp;</span>
                </td>
                <td>
                  <span v-if="!transfer.status" class="badge badge-success">OK</span>
                  <span v-else-if="transfer.status == '1'" class="badge badge-danger">DELAY</span>
                  <span v-else-if="transfer.status == '2'" class="badge badge-success">ON GATE</span>
                  <span v-else-if="transfer.status == '3'" class="badge badge-info">LEAVE</span>
                </td>
                <td>
                  <div class="btn-group">
                    <button
                      class="btn btn-sm btn-success"
                      v-bind:class="[ transfer.activity ? 'active' : 'disabled']"
                      @click="activityChange(transfer.id, 1)">
                      <i class="fa fa-check"></i>
                    </button>
                    <button
                      class="btn btn-sm btn-danger"
                      v-bind:class="[ !transfer.activity ? 'active' : 'disabled']"
                      @click="activityChange(transfer.id, 0)">
                      <i class="fa fa-times"></i>
                    </button>
                  </div>
                </td>
                <td class="text-right">
                  <div class="btn-group">
                    <button class="btn btn-sm btn-secondary" @click="statusChange(transfer.id, 0)">
                      <i class="fa fa-thumbs-o-up"></i>
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
                  </div>
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
        activity: "1",
        days: []
      },
      transfers: [],
      errors: {},
      error: false,
      allSelected: false
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

    selectAll() {
      this.data.days = [1, 2, 3, 4, 5, 6, 7];
    },

    statusChange(id, newStatus) {
      axios
        .put("/" + this.type + "/" + id, { status: newStatus })
        .then(response => {
          this.getTransfers();
        })
        .catch(error => {
          this.error = true;
        });
    },

    activityChange(id, newActivity) {
      axios
        .put("/" + this.type + "/" + id, { activity: newActivity })
        .then(response => {
          this.getTransfers();
        })
        .catch(error => {
          this.error = true;
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
          this.$swal("Ruta je unesena!", null, "success");
          this.getTransfers();
          this.data = {
            city: "",
            carrier: "",
            status: "0",
            time: "",
            activity: "1",
            days: []
          };
          this.errors = {};
        })
        .catch(error => {
          this.error = true;
          this.errors = error.response.data.errors;
        });
    }
  }
};
</script>