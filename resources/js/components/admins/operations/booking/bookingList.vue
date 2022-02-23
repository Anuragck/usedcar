<template>
  <div class="col-md-12">

<div class="card mt-3" v-show="payment_history_section">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showBookingList()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Booking List
          </button>
        </div>
      </div>
      <div class="card-body">
        <payment-history></payment-history>
      </div>
    </div>

<div class="card mt-3" v-show="mark_sale_section">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showBookingList()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Booking List
          </button>
        </div>
      </div>
      <div class="card-body">
        <mark-as-sale></mark-as-sale>
      </div>
    </div>


    <div class="card mt-3" v-show="booking_list_table">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">Booking List</h4>
        </div>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          <table
            id="bookingListTable"
            ref="bookingListTable"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>
                <th>Balance To Pay</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sl.No</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>
                <th>Balance To Pay</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(booking, index) in bookingListData"
                :key="booking.id">
                <td>{{ index+1}}</td>
                <td>{{ booking.customer_name }}</td>
                <td>{{ booking.customer.mobile }}</td>
                <td>{{ booking.vehicle.brands.name }}</td>
                <td>{{ booking.vehicle.models.name }}</td>
                <td>{{ booking.vehicle.reg_no }}</td>
                <td
                  class="font-weight-bold btn text-warning"
                  @click="forPayModal(booking)"
                >
                  {{ booking.sale_price - booking.total_payment_recieved }}
                </td>


                <td v-if="booking.sale_status == 0">{{ 'Booked' }}</td>
                <td v-if="booking.sale_status == 1">{{ 'Sale Processed' }}</td>


                <td>
                  <button class="btn btn-secondary btn-xs" @click="showPaymentHistory(booking)">
                    <i class="fas fa-eye fa-lg" title="payment history"></i>
                  </button>
                  <button class="btn btn-success btn-xs" @click="markSale(booking)">
                    <i class="fas fa-check-double fa-lg" title="mark sale"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!--view expense history modal start-->
    <!-- Modal -->
    <div
      class="modal fade"
      id="addBookingPayment"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <add-payment></add-payment>
        </div>
      </div>
    </div>
    <!--view expense history modal end-->



  </div>
</template>

<script>
export default {
  data() {
    return {
      bookingListData: {},
title:"",
payment_history_section:false,
booking_list_table:true,
mark_sale_section:false,
    };
  },
  created() {
var _this=this;
    _this.getBooking();

bus.$on("closing-payment-modal", function () {
      $("#addBookingPayment").modal("hide");
    });

bus.$on("payment-added", function () {
  _this.getBooking();
    });

bus.$on("sale-added", function () {
_this.showBookingList();
  _this.getBooking();

    });
  },

  methods: {
    getBooking() {
      axios
        .get("get-booking-list")
        .then((response) => {
          this.bookingListData = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },


    showBookingList(){
this.title="";
this.payment_history_section=false;
this.mark_sale_section=false;
this.booking_list_table=true;

    },


showPaymentHistory(booking){
this.title="Payment History";
this.payment_history_section=true;
this.booking_list_table=false;
this.mark_sale_section=false;

bus.$emit("payment-history", booking);
},

markSale(booking){
this.title="Mark As Sale";
this.payment_history_section=false;
this.mark_sale_section=true;
this.booking_list_table=false;

bus.$emit("mark-sale", booking);
},

    forPayModal(booking) {
      $("#addBookingPayment").modal("show");
bus.$emit("booking-payment", booking);
    },
  },

  watch: {
    bookingListData(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.bookingListTable).DataTable({
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
    this.dt = $(this.$refs.bookingListTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
