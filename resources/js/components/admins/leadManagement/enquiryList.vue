<template>
  <div class="col-md-12">
    <div class="card mt-3" v-show="add_new_lead_section">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showEnquiryList()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Enquiry List
          </button>
        </div>
      </div>
      <div class="card-body">
        <add-new-lead></add-new-lead>
      </div>
    </div>

    <div class="card mt-3" v-show="enquiry_list_table">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">Enquiry List</h4>
          <button class="btn btn-primary btn-round ml-auto" @click="addLead()">
            Add Lead <i class="fa fa-plus"></i>
          </button>
        </div>
      </div>

      <div class="ml-auto pr-3 mb-0">
        <span style="background-color: #00800046" class="px-2"
          ><small>High Priority</small></span
        >
        <span style="background-color: #fcf75e65" class="px-2"
          ><small> Medium Priority</small></span
        >
        <span style="background-color: #ed1c233a" class="px-2"
          ><small>Low Priority</small></span
        >
      </div>

      <div class="row mr-auto pl-2">
        <div class="col mr-auto">
          <div class="form-group">
            <label for="Coursename" class="text-muted font-weight-bold"
              >Priority Wise</label
            >
            <select
              class="form-control item shadow-sm rounded-pill"
              name="filter-priority"
              v-model="filter.priority"
            >
              <option value="" class="">All</option>
              <option value="1">High Priority</option>
              <option value="2">Medium Priority</option>
              <option value="3">Low Priority</option>
            </select>
          </div>
        </div>

        <div class="col mr-auto">
          <div class="form-group">
            <label for="Coursename" class="text-muted font-weight-bold"
              >Source Wise</label
            >
            <select
              class="form-control"
              name="filter-source"
              v-model="filter.source"
            >
              <option value="">All</option>
              <option value="Website">Website</option>
              <option value="Direct Call">Direct Call</option>
              <option value="Social Media">Social Media</option>
              <option value="Reference">Reference</option>
            </select>
          </div>
        </div>

        <div class="col mr-auto">
          <div class="form-group">
            <label for="leadstatus" class="text-muted font-weight-bold"
              >Lead Status</label
            >
            <select
              class="form-control"
              name="filter-source"
              v-model="filter.lead_status"
            >
              <option value="">Pending</option>
              <option value="Booked">Booked</option>
              <option value="Dropped">Dropped</option>
            </select>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table
            id="enquiryListTable"
            ref="enquiryListTable"
            class="display table"
          >
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Source</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Vehicle Reg No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sl.No</th>
                <th>Source</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Vehicle Reg No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr
                v-for="(enquiry, index) in enquiryList"
                :key="enquiry.id"
                :class="'priority_color' + enquiry.priority_status"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ enquiry.source_of_lead }}</td>
                <td>{{ enquiry.name }}</td>
                <td>{{ enquiry.email }}</td>
                <td>{{ enquiry.mobile }}</td>
                <td>{{ enquiry.enq_vehicle_reg_no }}</td>
                <td>{{ enquiry.brands.name }}</td>
                <td>{{ enquiry.models.name }}</td>

                <td class="" style="white-space: nowrap">
                  <button
                    class="btn btn-secondary btn-xs"
                    @click="historySection(enquiry)"
                  >
                    <i class="fas fa-eye fa-lg" title="Call history"></i>
                  </button>
                  <button
                    class="btn btn-success btn-xs"
                    @click="addCallEntrySection(enquiry)"
                  >
                    <i class="fas fa-phone-volume fa-lg" title="Call Entry"></i>
                  </button>
                  <button
                    class="btn btn-primary btn-xs"
                    @click="convertionSection(enquiry)"
                  >
                    <i class="fas fa-exchange-alt fa-lg" title="Convert"></i>
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <add-payment></add-payment>
        </div>
      </div>
    </div>
    <!--view expense history modal end-->

    <div class="" v-show="add_call_entry_section">
      <add-call-entry :edit="this.edit"></add-call-entry>
    </div>
    <div class="" v-show="follow_up_history_section">
      <follow-up-history></follow-up-history>
    </div>
    <div class="" v-show="convertion_section">
      <add-convertion></add-convertion>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      enquiryList: {},
      edit: true,
      convertion_section: false,
      add_call_entry_section: false,
      follow_up_history_section: false,
      enquiry_list_table: true,
      title: "",
      add_new_lead_section: false,

      filter: {
        source: "",
        priority: "",
        lead_status: "",
      },
    };
  },
  created() {
    this.getEnquiries();

    bus.$on("after-success", () => {
      _this.follow_up_history_section = false;
      _this.add_call_entry_section = false;
      _this.convertion_section = false;
      _this.enquiry_list_table = true;
      _this.add_new_lead_section = false;
      _this.getEnquiries();
    });

    var _this = this;
    bus.$on("back-to-table", function () {
      _this.follow_up_history_section = false;
      _this.add_call_entry_section = false;
      _this.convertion_section = false;
      _this.enquiry_list_table = true;
      _this.add_new_lead_section = false;
      _this.getEnquiries();
    });
  },

  methods: {
    getEnquiries() {
      axios
        .get("get-enquiries", {
          params: {
            source: this.filter.source,
            priority: this.filter.priority,
            lead_status: this.filter.lead_status,
          },
        })
        .then((response) => {
          this.enquiryList = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    addCallEntrySection(enquiry) {
      this.edit = false;
      this.add_call_entry_section = true;
      this.enquiry_list_table = false;
      this.add_new_lead_section = false;

      bus.$emit("add-call-entry", enquiry);
    },

    historySection(enquiry) {
      this.enquiry_list_table = false;
      this.follow_up_history_section = true;
      this.add_call_entry_section = false;
      this.add_new_lead_section = false;

      bus.$emit("call-history", enquiry);
    },
    convertionSection(enquiry) {
      this.enquiry_list_table = false;
      this.follow_up_history_section = false;
      this.add_call_entry_section = false;
      this.convertion_section = true;
      this.add_new_lead_section = false;

      bus.$emit("add-convertion", enquiry);
    },

    addLead() {
      this.title = "Add New Lead";
      this.enquiry_list_table = false;
      this.follow_up_history_section = false;
      this.add_call_entry_section = false;
      this.convertion_section = false;
      this.add_new_lead_section = true;
    },

    showEnquiryList() {
      this.title = "";
      this.enquiry_list_table = true;
      this.follow_up_history_section = false;
      this.add_call_entry_section = false;
      this.convertion_section = false;
      this.add_new_lead_section = false;

      bus.$emit("show-enquiry-list");
    },
  },

  watch: {
    enquiryList(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.enquiryListTable).DataTable({
          pageLength: 5,

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },

    "filter.source": function () {
      this.getEnquiries();
    },
    "filter.priority": function () {
      this.getEnquiries();
    },

    "filter.lead_status": function () {
      this.getEnquiries();
    },
  },

  mounted() {
    this.dt = $(this.$refs.enquiryListTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
<style scoped>
.priority_color3 {
  background-color: #ed1c233a;
}
.priority_color2 {
  background-color: #fcf75e65;
}
.priority_color1 {
  background-color: #00800046;
}
</style>
