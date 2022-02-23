<template>
  <div class="col-md-12">
    <div class="card mt-3">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">Ready For Sale</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="readyForSaleTable"
            ref="readyForSaleTable"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Reg No</th>
                <th>Selling Price</th>
                <th>Vehicle Status</th>
                <th>Website Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Reg No</th>
                <th>Selling Price</th>
                <th>Vehicle Status</th>
                <th>Website Status</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(data, index) in readyVehicles" :key="data.id">
                <td>{{ index + 1 }}</td>
                <td>{{ data.brands.name }}</td>
                <td>{{ data.models.name }}</td>
                <td>{{ data.reg_no }}</td>
                <td>{{ data.selling_price }}</td>
                <td v-if="data.sale_status == 0">
                  <span class="badge badge-info">Pending</span>
                </td>
                <td v-if="data.sale_status == 1">
                  <span class="badge badge-success">Booked</span>
                </td>

                <td v-if="data.add_to_website == 1">
                  <span class="badge badge-success">Added</span>
                </td>
                <td v-if="data.add_to_website == 0">
                  <span class="badge badge-danger">Removed</span>
                </td>
                <td v-if="data.add_to_website == null">
                  <span class="badge badge-info">Not Added</span>
                </td>

                <td style="white-space: nowrap">
                  <button
                    class="btn btn-success btn-xs"
                    @click="addToWebsite(data)"
                  >
                    <i
                      class="fas fa-plus-circle fa-lg"
                      title="add to website"
                    ></i>
                  </button>
                  <button
                    class="btn btn-warning btn-xs"
                    @click="removeFromWeb(data)"
                  >
                    <i
                      class="fas fa-minus-circle fa-lg"
                      title="remove from website"
                    ></i>
                  </button>
                  <button
                    class="btn btn-secondary btn-xs"
                    @click="addToHome(data)"
                  >
                    <i
                      class="far fa-star fa-lg"
                      title="add to homepage"
                      v-if="
                        data.add_to_homepage == 0 ||
                        data.add_to_homepage == null
                      "
                    ></i>
                    <i
                      class="fas fa-star fa-lg"
                      title="added to homepage"
                      v-if="data.add_to_homepage == 1"
                    ></i>
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
  data() {
    return {
      readyVehicles: {},
    };
  },
  created() {
    this.getReadyVehicles();
  },

  methods: {
    getReadyVehicles() {
      axios
        .get("ready-vehicles")
        .then((response) => {
          this.readyVehicles = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    addToWebsite(data) {
      if (data.add_to_website == 1) {
        Toast.fire({
          icon: "warning",
          title: "Already Added to Website",
        });
        return false;
      }
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Add to Website",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("add-to-web", { id: data.id }).then((response) => {
            if (response.data == "success") {
              Toast.fire({
                icon: "success",
                title: "Vehicle Successfully Added To Website",
              });
              this.getReadyVehicles();
            }
          });
        }
      });
    },

    removeFromWeb(data) {
      if (data.add_to_website == 0) {
        Toast.fire({
          icon: "warning",
          title: "Already Removed From Website",
        });
        return false;
      }
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Remove From Website",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("remove-from-web", { id: data.id }).then((response) => {
            if (response.data == "success") {
              Toast.fire({
                icon: "success",
                title: "Vehicle Successfully Removed From Website",
              });
              this.getReadyVehicles();
            }
          });
        }
      });
    },

    addToHome(data) {
      if (data.add_to_homepage == 1) {
        Swal.fire({
          title: "Are you sure?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Remove from Home",
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post("add-home", { id: data.id }).then((response) => {
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: "Vehicle Successfully Added to Homepage",
                });
                this.getReadyVehicles();
              }
            });
          }
        });
      } else {
        Swal.fire({
          title: "Are you sure?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Add to Home",
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post("add-home", { id: data.id }).then((response) => {
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: "Vehicle Successfully Added to Homepage",
                });
                this.getReadyVehicles();
              }
            });
          }
        });
      }
    },
  },

  watch: {
    readyVehicles(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.readyForSaleTable).DataTable({
          pageLength: 5,

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.readyForSaleTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
