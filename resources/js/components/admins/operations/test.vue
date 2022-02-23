<template>
  <div>
    <pre-loader v-if="preLoader"></pre-loader>

    <div class="main-div">
      <div class="col-lg-12 add-designation" v-show="showAddCard">
        <div class="card mb-4">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h5 class="m-0 font-weight-bold text-dark">{{ card_title }}</h5>

            <button
              type="button"
              class="btn btn-primary rounded-pill"
              @click="showTableComponent()"
            >
              Designation Table<i class="fas fa-table fa-fw"></i>
            </button>
          </div>
          <!-- add designation component  -->
          <add-designation :edit="showEdit"> </add-designation>
          <!-- add designation component  end -->
        </div>
      </div>

      <div class="col-lg-12" v-if="showTable">
        <div class="card mb-4">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h5 class="m-0 font-weight-bold text-dark">Designations</h5>

            <button
              type="button"
              class="btn btn-primary rounded-pill"
              @click="showAddComponent()"
            >
              Add Designation<i class="fas fa-plus-circle fa-fw"></i>
            </button>
          </div>
          <div class="table-responsive p-3">
            <table
              class="table align-items-center table-flush table-hover"
              id="designationTable"
              ref="designationTable"
            >
              <thead class="thead-light">
                <tr>
                  <th>Index</th>

                  <th>Name</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  v-for="(designation, index) in designation_details"
                  :key="designation.id"
                >
                  <td>{{ index + 1 }}</td>
                  <td>{{ designation.name }}</td>
                  <td>{{ designation.description }}</td>
                  <!-- 0 = Active 1= Not Active -->
                  <td v-if="designation.status == 0">
                    <span class="text-success font-weight-bold"> Active </span>
                  </td>

                  <td>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary"
                      @click="editDesignation(designation)"
                    >
                      <i class="fas fa-edit fa-fw"></i>
                    </button>

                    <button
                      type="button"
                      class="btn btn-sm btn-danger"
                      name=""
                      @click="deleteDesignation(designation)"
                    >
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      preLoader: false,
      card_title: "",
      designation_details: {},
      errors: {},
      edit: false,
      showTable: true,
      showEdit: true,
      showAddCard: false,
    };
  },
  created() {
    this.getDesignations();
    var _this = this;
    bus.$on("designation-added", function () {
      _this.showAddCard = false;
      _this.showTable = true;
      _this.showEdit = true;
      _this.getDesignations();
    });
  },

  methods: {
    getDesignations() {
      this.preLoader = true; //the loading begin
      axios
        .get("get-designation")
        .then((res) => {
          this.designation_details = res.data;
          this.preLoader = false; //the loading end
        })
        .catch((err) => {
          this.preLoader = false; //the loading end
          console.log(err);
        });
    },

    deleteDesignation(designation) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("#", {
              id: designation.id,
            })
            .then((response) => {
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: " Deleted successfully ",
                });

                this.getDesignations();
              }

              if (response.data == "failed") {
                Toast.fire({
                  icon: "error",
                  title: "Some Error Occurred,Please Try Again Later",
                });

                this.getDesignations();
              }
            })
            .catch((err) => {
              Toast.fire({
                icon: "error",
                title: "Request failed ",
              });
            });
        }
      });
    },

    editDesignation(designation) {
      this.card_title = "Edit Designation";
      this.showAddCard = true;
      this.showTable = false;
      bus.$emit("edit-designation", designation);
    },
    showAddComponent() {
      this.card_title = "Add Designation";
      this.showAddCard = true;
      this.showTable = false;
      this.showEdit = false;
    },

    showTableComponent() {
      bus.$emit("clear-field");
      this.card_title = "";
      this.showAddCard = false;
      this.showTable = true;
      this.showEdit = true;
    },
  },

  watch: {
    designation_details(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.designationTable).DataTable({
          pageLength: 10,
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
          bSort: false,
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.designationTable).DataTable({
      pageLength: 10,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
      bSort: false,
    });
  },
};
</script>
