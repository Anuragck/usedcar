<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">
        {{ title }} - {{ customer_name }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_payment_modal"
        @click="closePaymentModal()"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row font-weight-bold justify-content-center mt-2 mb-1">
        <div class="col-auto">{{ reg_no }}</div>
        <div class="col-auto">{{ vehicle_brand }} {{ vehicle_model }}</div>
      </div>
      <div class="row font-weight-bold justify-content-center">
        <div class="col-auto pb-3 pt-2">
          {{ "Balance To Pay : "
          }}<span style="font-size: 25px"> {{ balance_to_pay }}</span>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="date" class="required">Select Date</label>
            <input
              type="date"
              class="form-control"
              name="date"
              v-model="payment.pay_date"
            />
            <small class="text-danger" v> </small>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Enter Amount</label
            >
            <input
              type="number"
              class="form-control"
              placeholder="Enter Amount"
              v-model="payment.amount"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Payment Type</label
            >
            <select class="form-control" required="" v-model="payment.pay_type">
              <option value="">Payment Type</option>
              <option value="Bank">Bank</option>
              <option value="Cash">Cash</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted">Remarks</label>
            <textarea class="form-control" rows="2" v-model="payment.remarks">
            </textarea>
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
      <button type="button" class="btn btn-primary" @click="addPayment()">
        Save changes
      </button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      title: "Add Payment",

      customer_name: "",
      vehicle_brand: "",
      vehicle_model: "",
      reg_no: "",
      balance_to_pay: "",

      payment: {
        vehicle_id: "",
        enq_id: "",
        pay_date: "",
        amount: "",
        pay_type: "",
        remarks: "",
      },

      errors: {},
    };
  },

  methods: {
    closePaymentModal() {
      bus.$emit("closing-payment-modal");
this.clearFormData();
    },

    addPayment() {
      axios
        .post("add-payment", this.payment)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Payment Added Successfully",
            });
            this.clearFormData();
            this.$refs.close_payment_modal.click();
            bus.$emit("payment-added");

          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      this.customer_name = "";
      this.vehicle_brand = "";
      this.vehicle_model = "";
      this.reg_no = "";
      this.balance_to_pay = "";

      this.payment.vehicle_id = "";
      this.payment.enq_id = "";
      this.payment.pay_date = "";
      this.payment.amount = "";
      this.payment.pay_type = "";
      this.payment.remarks = "";
    },
  },

  created() {
    var _this = this;
    bus.$on("booking-payment", function (booking) {
      _this.reg_no = booking.vehicle.reg_no;
      _this.customer_name = booking.customer.name;

      _this.vehicle_brand = booking.vehicle.brands.name;
      _this.vehicle_model = booking.vehicle.models.name;
      _this.balance_to_pay =
        booking.sale_price - booking.total_payment_recieved;

      _this.payment.vehicle_id = booking.vehicle_id;
      _this.payment.enq_id = booking.enq_id;
    });
  },
};
</script>
