<template>
  <div>
    <div class="col-md-12">
      <div class="card mt-3">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Brand</h4>
            <button
              class="btn btn-primary btn-round py-1 ml-auto"
              data-toggle="modal"
              data-target="#addNewBrand"
            >
              Add Brand <i class="fa fa-plus"></i>
            </button>
            <button
              class="btn btn-danger btn-round py-1 ml-2"
              @click="deleteBrand()"
            >
              Delete <i class="far fa-trash-alt"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table
              id="brandDataTable"
              ref="brandDataTable"
              class="display table table-striped table-hover"
            >
              <thead>
                <tr>
                  <th></th>
                  <th>Sl.No</th>
                  <th>Brand Name</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Sl.No</th>
                  <th>Brand Name</th>
                </tr>
              </tfoot>
              <tbody>
                <tr
                  @dblclick="editBrand(brand)"
                  v-for="(brand, index) in brands"
                  :key="brand.id"
                >
                  <td class="text-center">
                    <!--  <input
                    class="form-control-input"
                    type="checkbox"
                    id="inlineCheckbox1"
                    :value="brand.id"
                    @change="deleteSelect($event)"
                  />-->
                    <input
                      type="checkbox"
                      v-model="deleteItems"
                      :value="`${brand.id}`"
                    />
                  </td>
                  <td>{{ index + 1 }}</td>
                  <td>{{ brand.name }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!--Add new Brand Modal Start-->
      <!-- Modal -->
      <div
        class="modal fade"
        id="addNewBrand"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
        data-backdrop="static"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <add-brand></add-brand>
          </div>
        </div>
      </div>
      <!--Add new Brand Modal End-->

      <!--Edit new Brand Modal Start-->
      <!-- Modal -->
      <div
        class="modal fade"
        id="editBrand"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
        data-backdrop="static"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <add-brand :edit="true"></add-brand>
          </div>
        </div>
      </div>
      <!--Add new Brand Modal End-->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      brands: {},
      deleteItems: [],
      all_select: false,
    };
  },
  created() {
    this.getBrands();

    var _this = this;
    bus.$on("closing-brand-modal", function () {
      $("#editBrand").modal("hide");

      _this.getBrands();
    });
  },

  methods: {
    editBrand(brand) {
      $("#editBrand").modal("show");

      bus.$emit("edit-brand", brand);
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

    deleteBrand() {
      if (this.deleteItems.length == 0) {
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
          axios.post("delete-brands/" + this.deleteItems).then((response) => {
            if (response.data == "success") {
              Toast.fire({
                icon: "success",
                title: "Brand Deleted successfully",
              });
              this.getBrands();
              this.deleteItems = [];
            }
          });
        }
      });
    },
  },

  watch: {
    brands(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.brandDataTable).DataTable({
          pageLength: 5,
          //   dom: "lBfrtip",
          //         	  buttons: [
          //         {
          //           extend: "copy",
          //           title: "Sales Report",
          //   className:'btn btn-primary btn-xs mt-3 ',
          //           exportOptions: {
          //             columns: ":visible:not(:eq(7))",
          //           },
          //         },
          //         {
          //           extend: "excel",
          //           title: "Sales Report",
          //         className:'btn btn-primary btn-xs mt-3 ml-1',
          //           exportOptions: {
          //             columns: ":visible:not(:eq(7))",
          //           },
          //         },
          //         {
          //           extend: "pdf",
          //           title: "Sales Report",
          // className:'btn btn-primary btn-xs mt-3 ml-1',
          //           exportOptions: {
          //             columns: ":visible:not(:eq(7))",
          //           },
          //         },
          //         {
          //           extend: "print",
          // className:'btn btn-primary btn-xs mt-3 ml-1',
          //           title: "Sales Report",
          //           exportOptions: {
          //             columns: ":visible:not(:eq(7))",
          //           },
          //         },
          //       ],

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.brandDataTable).DataTable({
      pageLength: 5,
      //   dom: "lBfrtip",
      //       	  buttons: [
      //         {
      //           extend: "copy",
      //           title: "Sales Report",
      //   className:'btn btn-primary btn-xs mt-3',
      //           exportOptions: {
      //             columns: ":visible:not(:eq(7))",
      //           },
      //         },
      //         {
      //           extend: "excel",
      //           title: "Sales Report",
      // className:'btn btn-primary btn-xs mt-3 ml-1',
      //           exportOptions: {
      //             columns: ":visible:not(:eq(7))",
      //           },
      //         },
      //         {
      //           extend: "pdf",
      //           title: "Sales Report",
      // className:'btn btn-primary btn-xs mt-3 ml-1',
      //           exportOptions: {
      //             columns: ":visible:not(:eq(7))",
      //           },
      //         },
      //         {
      //           extend: "print",
      //           title: "Sales Report",
      // className:'btn btn-primary btn-xs mt-3 ml-1',
      //           exportOptions: {
      //             columns: ":visible:not(:eq(7))",
      //           },
      //         },
      //       ],

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
