<template>
<div class="">
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <button class="btn btn-default btn-xs btn-round py-1" @click="goBack()">
                    <i class="fas fa-backward fa-fw"></i> Go Back
                </button>
                <h4 class="card-title ml-auto">Follow Up History</h4>
            </div>
        </div>
        <div class="card-body">

            <div class="col-md-12 col-lg-12">
         <div id="tracking-pre"></div>
         <div id="tracking">
 <div class="tracking-list py-3 text-center font-weight-bold">
<div v-for="history in follow_up_history" :key="history.id">
<div class="row">
<div class="col-lg-6 col-md-6">
<span>Name : {{ history.name }}</span>
</div>
<div class="col-lg-6 col-md-6">
<span>Phone : {{ history.mobile }}</span>
</div>
</div>

<div class="row mt-1">
<div class="col-lg-6 col-md-6">
<span>Enquired Brand : {{ history.brands.name }}</span>
</div>
<div class="col-lg-6 col-md-6">
<span>Enquired Model : {{ history.models.name }}</span>
</div>
</div>


            <div class="tracking-list mt-3"  v-for="(followUp,index ) in history.get_follow_up"
        :key="followUp.id">
               <div class="tracking-item">
                  <div v-if="index == 0" class="tracking-icon status-intransit bg-success"><span style="color:#fff; font-size:8px;">Recent</span></div>
 <div v-if="index > 0" class="tracking-icon status-intransit bg-old-history">
<!--new-here-->

                     <i class="fas fa-circle fa-lg"></i>
                  </div>
                  <div class="tracking-date font-weight-bold">{{ followUp.call_date |myDateMonth }}<span>{{ followUp.time }}</span></div>
     <div class="tracking-content font-weight-bold">Call Status : {{ followUp.call_status }}</div>
                  <div class="tracking-content font-weight-bold">Priority Status : {{ followUp.priority_status }}</div><p>Remarks : {{ followUp.remarks }} </p>
               </div>




            </div>
         </div>
      </div>
   </div>

        </div>
    </div>

<div v-if="follow_up_details == false" class="pt-5 mt-5 pb-5 mb-5">
<div class=" text-center">
<span> No History Found</span>
</div>
</div>



</div>
</div>
</template>

<script>
export default {
    data() {
        return {
follow_up_history:{},
follow_up_count:'',
follow_up_details:true,

enq_id:'',

        };
    },
    created() {

var _this=this;
 bus.$on("call-history", (enquiry) => {
        _this.enq_id = enquiry.id;

_this.getFollowUpHistory();
console.log(_this.follow_up_count)
    });
    },

    methods: {
        goBack() {
            bus.$emit("back-to-table");
this.clear_history_section();
        },


 getFollowUpHistory() {
      axios
        .get("get-follow-up-history", {
          params: {
            enq_id: this.enq_id,
          },
        })
        .then((response) => {

          this.follow_up_history = response.data;
this.follow_up_count=this.follow_up_history[0].get_follow_up.length;

 if( this.follow_up_history[0].get_follow_up.length == 0){

            this.follow_up_details=false;

          }else{
this.follow_up_details=true;
          }

        });
    },

clear_history_section(){
 this.follow_up_history={};
 this.follow_up_details=true;
},
    },

    watch: {},

    mounted() {},
};
</script>

<style scoped>



.tracking-list {
 border:1px solid #e5e5e5
}
.tracking-item {
 border-left:1px solid #e5e5e5;
 position:relative;
 padding:2rem 1.5rem .5rem 2.5rem;
 font-size:.9rem;
 margin-left:3rem;
 min-height:5rem
}



.tracking-item .tracking-icon {
 line-height:2.6rem;
 position:absolute;
 left:-1.3rem;
 width:2.6rem;
 height:2.6rem;
 text-align:center;
 border-radius:50%;

 background-color:#fff;
 color:#fff
}

.tracking-item .tracking-icon.status-intransit {
 color:#e5e5e5;
 border:1px solid #e5e5e5;
 font-size:.6rem
}
@media(min-width:992px) {
 .tracking-item {
  margin-left:10rem
 }
 .tracking-item .tracking-date {
  position:absolute;
  left:-10rem;
  width:7.5rem;
  text-align:right
 }
 .tracking-item .tracking-date span {
  display:block
 }
 .tracking-item .tracking-content {
  padding:0;
  background-color:transparent
 }
}

.bg-old-history{
background-color:rgba(120, 219, 54, 0.418) ;
}
</style>
