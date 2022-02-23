<template>
  <div class="col-md-12">
    <div class="page-header mt-4">
      <h4 class="page-title">Dashboard</h4>
    </div>

    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round hover-div">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-primary bubble-shadow-small"
                >
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category">Total No.Of Purchases</p>
                  <h4 class="card-title font-weight-bold">
                    {{ total_purchase_count }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round hover-div">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="far fa-newspaper"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category">Total No.Of Sales</p>
                  <h4 class="card-title font-weight-bold">
                    {{ total_sales_count }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats hover-div card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-success bubble-shadow-small"
                >
                  <i class="far fa-chart-bar"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category">Pending Bookings</p>
                  <h4 class="card-title font-weight-bold">
                    {{ total_booking_count }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats hover-div card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="
                    icon-big
                    text-center
                    icon-secondary
                    bubble-shadow-small
                  "
                >
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ml-3 ml-sm-0">
                <div class="numbers">
                  <p class="card-category">RC Transfer Pending</p>
                  <h4 class="card-title font-weight-bold">{{ rc_pending }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--price-->
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="card card-stats hover-div card-primary card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="flaticon-users"></i>
                </div>
              </div>
              <div class="col col-stats">
                <div class="numbers">
                  <p class="card-category">Total Purchases</p>
                  <h4 class="card-title font-weight-bold">
                    {{ total_purchase_amount }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="card card-stats hover-div card-success card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="flaticon-analytics"></i>
                </div>
              </div>
              <div class="col col-stats">
                <div class="numbers">
                  <p class="card-category">Total Sales</p>
                  <h4 class="card-title font-weight-bold">
                    {{ total_sales_amount }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="card card-stats hover-div card-secondary card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big text-center">
                  <i class="flaticon-success"></i>
                </div>
              </div>
              <div class="col col-stats">
                <div class="numbers">
                  <p class="card-category">Total Expenses</p>
                  <h4 class="card-title font-weight-bold">{{ total_expenses_amount }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="row">

</div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      total_sales_count: "",
      total_purchase_count: "",
      total_booking_count: "",
      rc_pending: "",

      total_purchase_amount: "",
      total_sales_amount: "",
      total_expenses_amount: "",
    };
  },

  methods: {
    getDashboardData() {
      axios
        .get("dashboard-data")
        .then((res) => {
          this.total_sales_count = res.data[0].total_no_sales;
          this.total_purchase_count = res.data[0].total_no_purchases;
          this.total_booking_count = res.data[0].total_no_bookings;
          this.rc_pending = res.data[0].rc_transfer_pending;

          this.total_purchase_amount = res.data[0].total_purchase_amount;
          this.total_sales_amount = res.data[0].total_sales_amount;
          this.total_expenses_amount = res.data[0].total_expenses_amount;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
    this.getDashboardData();
  },
};
</script>

<style scoped>
 .hover-div {
    /*
      All of the base styles have
      moved to the “CSS” tab above.
    */
    transition: transform 250ms;
  }

  .hover-div:hover {
    transform: translateY(-10px);
  }
</style>
