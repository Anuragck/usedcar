<template>
<div>
 <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ title }} - {{ reg_no }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeRcTransferModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="row font-weight-bold justify-content-center mt-2 mb-1">
        <div class="col-auto"><span class="text-muted">{{ 'Customer Name : ' }}</span>    {{ customer_name }} </div>
        <div class="col-auto"><span class="text-muted">{{ 'Vehicle : ' }}</span>    {{ vehicle_brand }} {{ vehicle_model }}</div>
      </div>

 <div class="row mt-4">
      <div class="col">
 <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Select Transferred Date</label>
          <input type="date" class="form-control" v-model="transferData.transfer_date" />
        </div>
      </div>

    </div>

      </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeRcTransferModal">Close</button>
        <button type="button" class="btn btn-primary" @click="addRcTransfer()">Mark As Transferred</button>
      </div>
</div>
</template>
<script>
export default {

data(){
return{
title:"RC Transfer",

reg_no:"",
customer_name:"",
vehicle_brand:"",
vehicle_model:"",


transferData:{
transfer_date:"",
vehicle_id:"",
},

errors:{},


}
},


methods: {
closeRcTransferModal(){
 bus.$emit("closing-rc-transfer-modal");
this.clearFormData();
},


    addRcTransfer() {
      axios
        .post("add-rc-transfer", this.transferData)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "RC Transfered Successfully",
            });
           this.closeRcTransferModal();

          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },
clearFormData(){
this.transferData.transfer_date="";
this.customer_name="";
this.vehicle_model="";
this.vehicle_brand="";

}

},

 created() {
 var _this = this;
 bus.$on("delivery-status-data", function (delivery) {
_this.reg_no=delivery.reg_no;

_this.customer_name=delivery.customer.name;
_this.vehicle_brand=delivery.brands.name;
_this.vehicle_model=delivery.models.name;

_this.transferData.vehicle_id=delivery.id;
    });


  },
}
</script>
