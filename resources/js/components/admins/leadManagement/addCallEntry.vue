<template>
  <div class="">
    <div class="card mt-3">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <button
            class="btn btn-default btn-xs btn-round py-1"
            @click="goBack()"
          >
            <i class="fas fa-backward fa-fw"></i> Go Back
          </button>

          <h4 class="card-title ml-auto">{{ enquirer_name }} - Add Call Entry</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="" class="font-weight-bold text-muted required"
                >Select Date</label
              >
              <input type="date" class="form-control" required="" v-model="callEntry.callDate"/>
<small
                                    class="text-danger"
                                    v-if="errors.callDate"
                                >
                                    {{ errors.callDate[0] }}</small
                                >
            </div>
          </div>
        </div>
        <!--1st row end-->
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="" class="font-weight-bold text-muted required"
                >Select Time
              </label>
              <select class="form-control" required="" v-model="callEntry.timeHour">
                <option value="">Hour</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
              </select>
<small
                                    class="text-danger"
                                    v-if="errors.timeHour || errors.timeMin || errors.timeAmPm"
                                >
                                    {{ 'Please select time' }}</small
                                >
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label></label>
              <select class="form-control mt-2" id="" required=""  v-model="callEntry.timeMin">
                <option value="">Minute</option>
                <option>00</option>
                <option>05</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>30</option>
                <option>35</option>
                <option>40</option>
                <option>45</option>
                <option>50</option>
                <option>55</option>
              </select>

            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group">
              <label></label>
              <select class="form-control mt-2" required="" v-model="callEntry.timeAmPm">
                <option value="">AM/PM</option>
                <option>AM</option>
                <option>PM</option>
              </select>
            </div>
          </div>
        </div>
        <!--2nd row end-->

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="" class="font-weight-bold text-muted required"
                >Call Status
              </label>
              <select class="form-control" required="" v-model="callEntry.callStatus">
                <option value="">Call Status</option>
                <option value="Connected">Connected</option>
                <option value="Not Answered">Not Answered</option>
                <option value="Call Waiting">Call Waiting</option>
                <option value="Out of Coverage">Out of Coverage</option>
                <option value="Rejected">Rejected</option>
              </select>
<small
                                    class="text-danger"
                                    v-if="errors.callStatus"
                                >
                                    {{ errors.callStatus[0] }}</small
                                >
            </div>
          </div>
          <div class="col" v-if="callEntry.callStatus == 'Connected'">
            <div class="form-group">
              <label for="" class="font-weight-bold text-muted required"
                >Select Priority
              </label>
              <select class="form-control" required="" v-model="callEntry.leadPriority">
                <option value="">Select Priority</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
<small
                                    class="text-danger"
                                    v-if="errors.leadPriority"
                                >
                                    {{ errors.leadPriority[0] }}</small
                                >

            </div>
          </div>
        </div>
        <!--3nd row end-->

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="comment" class="font-weight-bold text-muted"
                >Remarks</label
              >
              <textarea class="form-control" rows="2" v-model="callEntry.remarks"> </textarea>
            </div>
          </div>
        </div>
        <!--4th row end-->

        <div class="div py-4">
          <button class="btn btn-primary btn-round float-right mr-2"  @click.prevent="addCallEntry()">
            {{ button_title
        }}<i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
loading:false,
      enqId: "",
      enquirer_name: "",

callEntry: {
        callDate: moment().format("YYYY-MM-DD"),
        timeHour: "",
        timeMin: "",
        timeAmPm: "",
        callStatus: "",
        leadPriority: "",
        remarks: "",
      },

errors:{},
    };
  },
  created() {
    var _this = this;
    bus.$on("add-call-entry", (enquiry) => {
     this.enqId=enquiry.id;
this.enquirer_name=enquiry.name;
    });
  },

  methods: {
    goBack() {
      bus.$emit("back-to-table");
this.clearFormField();
    },

   addCallEntry() {
this.loading=true;
      axios
        .post("add-call-entry/" + this.enqId, this.callEntry)
        .then((res) => {
          if (res.data == "success") {

            Toast.fire({
              icon: "success",
              title: "Added successfully",
            });
this.clearFormField();
  bus.$emit("after-success");

          }
this.loading=false;
        }) .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
this.loading=false;
        });
    },

clearFormField(){
        this.enqId= "";
        this.enquirer_name="";

        this.callEntry.callDate=moment().format("YYYY-MM-DD");
        this.callEntry.timeHour='';
        this.callEntry.timeMin='';
        this.callEntry.timeAmPm='';
        this.callEntry.callStatus='';
        this.callEntry.leadPriority='';
        this.callEntry.remarks='';

        this.errors={};

}
  },

  watch: {},

  mounted() {},

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
