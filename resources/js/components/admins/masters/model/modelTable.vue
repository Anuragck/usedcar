<template>
  <div class="col-md-12">
    <div class="card mt-3">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title">Model</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            data-toggle="modal"
            data-target="#addModel"
@click="addModelForFilter()"
          >
            Add Model <i class="fa fa-plus"></i>
          </button>
          <button
            class="btn btn-danger btn-round py-1 ml-2"
            @click="deleteModel()"
          >
            Delete <i class="far fa-trash-alt"></i>
          </button>
        </div>
      </div>
      <div class="row mr-auto pl-4">
        <div class="col mr-auto w-25">
          <div class="form-group">
            <label for="Coursename" class="text-muted font-weight-bold"
              >Brand Wise</label
            >
            <select v-model="filter.brand_id" class="form-control">
              <option disabled value="">Please select one</option>
              <option value="" class="">All</option>
              <option v-for="brand in brands" :value="brand.id" :key="brand.id">
                {{ brand.name }}
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="modelTable"
            ref="modelTable"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <th></th>
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
              </tr>
            </tfoot>
            <tbody>
              <tr
                @dblclick="forEditModel(model)"
                v-for="(model, index) in models"
                :key="model.id"
              >
                <td class="text-center">
                  <input
                    class="form-control-input"
                    type="checkbox"
                    v-model="deleteModels"
                    :value="`${model.id}`"
                  />
                </td>
                <td>{{ index + 1 }}</td>
                <td>{{ model.vehicle_brand.name }}</td>
                <td>{{ model.name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!--Add new  Modal Start-->
    <!-- Modal -->
    <div
      class="modal fade"
      id="addModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <add-model :filter_brand="filter_brand"></add-model>
        </div>
      </div>
    </div>
    <!--Add new  Modal End-->

    <!--Edit new Brand Modal Start-->
    <!-- Modal -->
    <div
      class="modal fade"
      id="editModel"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <add-model :edit="true"></add-model>
        </div>
      </div>
    </div>
    <!--Add new Brand Modal End-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      models: {},
      deleteModels: [],

      brands: {},

filter_brand:false,

      filter: {
        brand_id: "",
      },
    };
  },
  created() {
    this.getBrands();
    this.getModels();
    var _this = this;
    bus.$on("closing-model-modal", function () {
      $("#editModel").modal("hide");
      _this.getModels();
    });
  },

  methods: {
    forEditModel(model) {
      $("#editModel").modal("show");
      bus.$emit("edit-model", model);
    },

    getModels() {
      axios
        .get("get-models", {
          params: {
            brand: this.filter.brand_id,
          },
        })
        .then((response) => {
          this.models = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getBrands() {
      axios
        .get("get-brands")
        .then((response) => {
          this.brands = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    deleteModel() {
      if (this.deleteModels.length == 0) {
        Toast.fire({
          icon: "warning",
          title: "Please Select any Data",
        });
        return false;
      }
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
          axios.post("delete-model/" + this.deleteModels).then((response) => {
            if (response.data == "success") {
              Toast.fire({
                icon: "success",
                title: "Model Deleted successfully",
              });
              this.getModels();
              this.deleteModels = [];
            }
          });
        }
      });
    },

addModelForFilter(){

if(this.filter.brand_id != null){
this.filter_brand=true;
}else{
this.filter_brand=false;
}
bus.$emit("filter_brand_id",this.filter.brand_id)



}
  },

  watch: {
    models(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.modelTable).DataTable({
          pageLength: 5,

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },

    "filter.brand_id": function () {
      this.getModels();

    },
  },

  mounted() {
    this.dt = $(this.$refs.modelTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
