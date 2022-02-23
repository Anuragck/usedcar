<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        @click="closePaymentModal()"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="p-4"></div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Select Date <span style="color:red;">*</span></label
            >
            <input type="date" class="form-control" />
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Enter Amount <span style="color:red;">*</span></label
            >
            <input
              type="number"
              class="form-control"
              placeholder="Enter Color"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Payment Type <span style="color:red;">*</span></label
            >
            <select class="form-control" required="">
              <option value="">Payment Type </option>
              <option>Bank</option>
              <option>Cash</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer mt-4">
      <button
        type="button"
        class="btn btn-secondary"
        data-dismiss="modal"
        @click="closePaymentModal"
      >
        Close
      </button>
      <button type="button" class="btn btn-primary"
       :disabled="loading">
          
         {{ button_title }} <i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i></button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
       loading : false,
      title: "Add Payment",
    };
  },

  methods: {
    closePaymentModal() {
      bus.$emit("closing-payment-modal");
      // this.loading = true;
      //  this.loading = false;
    },
   
  },

  created() {},
   computed: {
    button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Save Changes";
      }
    },
  },
};
</script>
