<template>
<pre-loader v-if="preLoader"></pre-loader>
<div class="mb-3" v-else>

<div class="p-4">

</div>


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
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ "sl.no" }}</td>
                <td>{{ "date" }}</td>
                <td>{{ "amount" }}</td>
                <td>{{ "description" }}</td>
              </tr>
            </tbody>
          </table>
        </div>

  </div>
</template>
<script>
export default {
data(){
return{
  preLoader: false,
paymentHistory:{},
}
},


methods: {
//  this.preLoader = true; //the loading begin
//  this.preLoader = false; //the loading end


},

 created() {

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
}
</script>
