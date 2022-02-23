<template>
  <div class="col-md-12">
    <div class="card mt-3">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title">Expense Category</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            data-toggle="modal" data-target="#addExpenseCategoryModal"
>
            Add Expense Category <i class="fa fa-plus"></i>
          </button>
          <button
            class="btn btn-danger btn-round py-1 ml-2"
            @click="deleteExpenseCategory()"
          >
            Delete <i class="far fa-trash-alt"></i>
          </button>
        </div>
      </div>
      <div class="row mr-auto pl-4">
      </div>
      <div class="card-body">
         
        <div class="table-responsive">
          <table
            id="expensecategoryTable"
            ref="expensecategoryTable"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <th></th>
                <th>Sl.No</th>
                <th>Expense Category Name</th>
                
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Sl.No</th>
                <th>Expense Category Name</th>
                
              </tr>
            </tfoot>
            <tbody>
              <tr
                @dblclick="forEditExpenseCategory(expensecategory)"
                v-for="(expensecategory, index) in expensecategories"
                :key="expensecategory.id"
              >
                <td class="text-center">
                  <input
                    class="form-control-input"
                    type="checkbox"
                    v-model="deleteExpenseCategories"
                    :value="`${expensecategory.id}`"
                  />
                </td>
                <td>{{ index + 1 }}</td>
              
                <td>{{ expensecategory.name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!--Add new  Modal Start-->
    <!-- Modal -->
    <div
     class="modal fade" id="addExpenseCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <add-expensecategory></add-expensecategory>
        </div>
      </div>
    </div>
    <!--Add new  Modal End-->

    <!--Edit new Brand Modal Start-->
    <!-- Modal -->
    <div
      class="modal fade"
      id="editExpenseCategory"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <add-expensecategory :edit="true"></add-expensecategory>
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
      expensecategories: {},
      deleteExpenseCategories: [],

     


    };
  },
  created() {
   
    this.getExpenseCategories();
    var _this = this;
    bus.$on("closing-expensecategory-modal", function () {
      $("#editExpenseCategory").modal("hide");
      _this.getExpenseCategories();
    });
  },

  methods: {
    forEditExpenseCategory(expensecategory) {
      $("#editExpenseCategory").modal("show");
      bus.$emit("edit-expensecategory", expensecategory);
    },

    getExpenseCategories() {
      axios
        .get("get-expensecategories")
          
        .then((response) => {
          this.expensecategories = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

   

    deleteExpenseCategory() {
      if (this.deleteExpenseCategories.length == 0) {
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
          axios.post("delete-expensecategory/" + this.deleteExpenseCategories).then((response) => {
            if (response.data == "success") {
              Toast.fire({
                icon: "success",
                title: "Expense Category Deleted successfully",
              });
              this.getExpenseCategories();
              this.deleteExpenseCategories = [];
            }
          });
        }
      });
    },


  },

  watch: {
    expensecategories(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.expensecategoryTable).DataTable({
          pageLength: 5,

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },

     function () {
      this.getExpenseCategories();

    },
  },

  mounted() {
    this.dt = $(this.$refs.expensecategoryTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
