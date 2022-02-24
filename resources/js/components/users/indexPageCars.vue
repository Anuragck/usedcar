<template>
   <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2 class="text-center">Featured Cars here</h2>
                            <a href="\allCarsPage">view more <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
<div class="row">


 <div
                  class="col-md-4 mt-4"
                  v-for="car in index_page_vehicles"
                  :key="car.id"
                >
                  <div
                    class="card profile-card-5 shadow-lg rounded hover01 my-car"
                  >
                    <div class="card-img-block">
                      <figure>
                        <img
                          class="card-img-top img-box"
                          :src="
                            '/uploads/vehicleImages/' +
                            car.index_page_images[0].image
                          "
                          alt="Card image cap"
                        />
                      </figure>
                    </div>
                    <div class="card-body pt-0">
                      <a :href="'/singleCarView/' + car.id" class="no-decoration">
                        <h6 class="card-title font-weight-bold">
                          {{ car.brands.name }} {{ car.models.name }}
                        </h6>
                      </a>

 <h6 class="pt-1"><small><del> ₹ {{ parseFloat(car.selling_price) + parseFloat(for_discount)}}    </del></small> ₹ {{ car.selling_price }}</h6>

                                    <p>{{ car.fuel }} &nbsp;/&nbsp; {{ car.year_of_reg }} &nbsp;/&nbsp; Used vehicle</p>

                                    <small>
                                        <strong title="Author"><i class="fa fa-dashboard"></i> {{ car.kms_driven }} Kms</strong>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong title="Author"><i class="fa fa-cube"></i> {{ car.cc }}
                                            cc</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong title="Views"><i class="fa fa-cog"></i> {{ car.transmission_type }}</strong>
                                    </small>
                      <a
                        :href="'/singleCarView/' + car.id"
                        class="btn btn-primary pull-right mt-4"
                        >View More</a
                      >
                    </div>
                  </div>
                </div>





                </div>
   </div>
</template>
<script>
export default {
  data() {
    return {

index_page_vehicles:{},

for_discount:'25000',



    };
  },

  methods: {
    getIndexPageVehicles() {
      axios
        .get("index-page-vehicles")
        .then((res) => {
this.index_page_vehicles=res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
this.getIndexPageVehicles();
  },
};
</script>

<style scoped>

/*Profile Card 5*/
.profile-card-5 {
  margin-top: 20px;
}
.profile-card-5 .btn {
  border-radius: 2px;
  text-transform: uppercase;
  font-size: 12px;
  padding: 7px 20px;
}
.profile-card-5 .card-img-block {
  width: 91%;
  margin: 0 auto;
  position: relative;
  top: -20px;
}
.profile-card-5 .card-img-block img {
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.63);
}
.profile-card-5 h5 {
  color: #4e5e30;
  font-weight: 600;
}
.profile-card-5 p {
  font-size: 14px;
  font-weight: 300;
}
.profile-card-5 .btn-primary {
  background-color: #4e5e30;
  border-color: #4e5e30;
}

.hover01 figure img {
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
}
.hover01 figure:hover img {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.my-car {
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  min-width: 85%;
  max-width: 85%;
}

.img-box {
  min-height: 150px;
  max-height: 150px;
}
.no-decoration{
    text-decoration: none;}




</style>
