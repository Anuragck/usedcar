<template>
  <div class="mb-3">
    <div class="p-4"></div>

    <div class="table-responsive mt-3">
      <table
        id="payment_history_table"
        ref="payment_history_table"
        class="display table table-striped table-hover"
      >
        <thead>
          <tr>
            <th>Sl.No</th>
            <th>Date</th>
            <th>Amount</th>
 <th>Pay Type</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(history, index) in paymentHistory"
                :key="history.id">
            <td>{{ index+1 }}</td>
            <td>{{ history.pay_date | myDate }}</td>
            <td>{{ history.amount }}</td>
 <td>{{ history.pay_type }}</td>
            <td>{{ history.remarks }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      paymentHistory: {},

      enq_id: "",
    };
  },

  methods: {
    getHistory() {
      axios
        .get("get-payment-history", {
          params: { enq_id: this.enq_id },
        })
        .then((response) => {
          this.paymentHistory = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
    var _this = this;
    bus.$on("payment-history", function (booking) {
      _this.enq_id = booking.enq_id;
_this.getHistory();
    });
  },

  watch: {
    paymentHistory(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.payment_history_table).DataTable({
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
    this.dt = $(this.$refs.payment_history_table).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
