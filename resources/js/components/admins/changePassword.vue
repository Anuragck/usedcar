<template>
  <div class="container">
    <!-- Modal -->
    <div
      class="modal fade"
      id="passwordChangeModal"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
              Change Password
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              ref="close_modal"
              @click="clearModalData()"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="col-md-12">
              <div class="">
                <div class="card-body">
                  <form
                    method="POST"
                    enctype="multipart/form-data"
                    @submit.prevent="changePassword"
                  >
                    <div class="form-group">
                      <label for="current_password"
                        ><strong>Current Password:</strong></label
                      >
                      <div class="input-group">
                        <input
                          v-if="showPassword"
                          type="text"
                          class="form-control"
                          v-model="form.currentPassword"
                          name="currentPassword"
                        />
                        <input
                          v-else
                          type="password"
                          class="form-control"
                          v-model="form.currentPassword"
                          name="currentPassword"
                        />
                        <div class="input-group-append">
                          <button
                            class="btn btn-primary"
                            type="button"
                            @click.prevent="toggleShow"
                          >
                            <i
                              class="fas"
                              :class="{
                                'fa-eye-slash': showPassword,
                                'fa-eye': !showPassword,
                              }"
                            ></i>
                          </button>
                        </div>
                      </div>

                      <small
                        class="text-danger"
                        v-if="errors.currentPassword"
                        >{{ errors.currentPassword[0] }}</small
                      >
                    </div>
                    <!-- End Current Password Input -->
                    <div class="form-group">
                      <label for="new_password"
                        ><strong>New Password:</strong></label
                      >
                      <div class="input-group">
                        <input
                          v-if="showNewPassword"
                          type="text"
                          class="form-control"
                          v-model="form.password"
                          name="password"
                        />
                        <input
                          v-else
                          type="password"
                          class="form-control"
                          v-model="form.password"
                          name="password"
                        />
                        <div class="input-group-append">
                          <button
                            class="btn btn-primary"
                            type="button"
                            @click.prevent="toggleShowNewPassword"
                          >
                            <i
                              class="fas"
                              :class="{
                                'fa-eye-slash': showNewPassword,
                                'fa-eye': !showNewPassword,
                              }"
                            ></i>
                          </button>
                        </div>
                      </div>
                      <small class="text-danger" v-if="errors.password">{{
                        errors.password[0]
                      }}</small>
                    </div>
                    <!-- End New Password Input -->
                    <div class="form-group">
                      <label for="new_password_confirmation"
                        ><strong>Confirm New Password:</strong></label
                      >
                      <div class="input-group">
                        <input
                          v-if="showConfirmPassword"
                          type="text"
                          class="form-control"
                          v-model="form.password_confirmation"
                          name="password_confirmation"
                        />
                        <input
                          v-else
                          type="password"
                          class="form-control"
                          v-model="form.password_confirmation"
                          name="password_confirmation"
                        />

                        <div class="input-group-append">
                          <button
                            class="btn btn-primary"
                            type="button"
                            @click.prevent="toggleShowConfirmPassword"
                          >
                            <i
                              class="fas"
                              :class="{
                                'fa-eye-slash': showConfirmPassword,
                                'fa-eye': !showConfirmPassword,
                              }"
                            ></i>
                          </button>
                        </div>
                      </div>
                      <small
                        class="text-danger"
                        v-if="errors.password_confirmation"
                        >{{ errors.password_confirmation[0] }}</small
                      >
                    </div>

                    <!-- End New Confirm Password Input -->
                    <hr />
                    <div class="text-center pt-2">
                      <button
                        class="btn btn-primary rounded-pill"
                        type="submit"
                      >
                        Change Password<i class="fas fa-unlock-alt fa-fw"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
      showPassword: false,
      showNewPassword: false,
      showConfirmPassword: false,
      errors: [],
      form: {
        currentPassword: "",
        password: "",
        password_confirmation: "",
      },
    };
  },

  methods: {
    toggleShow() {
      this.showPassword = !this.showPassword;
    },
    toggleShowNewPassword() {
      this.showNewPassword = !this.showNewPassword;
    },
    toggleShowConfirmPassword() {
      this.showConfirmPassword = !this.showConfirmPassword;
    },

    //for clear error data after return to the page
    clear_error_data() {
      for (let er in this.errors) {
        this.errors[er] = null;
      }
    },
    clearModalData() {
      this.form = {};
      this.clear_error_data();
      this.$refs.close_modal.click();
      //   $("#changePasswordModal").hide();
      $(".modal-backdrop").hide();
    },

    changePassword() {
      var _this = this;

      axios
        .post("updatePassword", this.form)
        .then(function (res) {
          if (res.data == "changed") {
            _this.clearModalData();
            Swal.fire(
              "Password Changed!",
              "Your Password Has Been Changed Successfully",
              "success"
            );
            _this.errors = [];
            // $("#passwordChangeModal").modal("hide");
            _this.$refs.close_modal.click();
          }

          if (res.data == "notChanged") {
            _this.clearModalData();
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Password not changed!",
            });
          }

          if (res.data == "mismatch") {
            // _this.clearModalData();
            Swal.fire({
              icon: "warning",
              title: "Oops...",
              text: "Your Current Password is Wrong!",
            });
          }

          if (res.data == "doNotSamePw") {
            // _this.clearModalData();
            Swal.fire({
              icon: "warning",
              title: "Oops...",
              text: "Your current password cannot be same with the new password!",
            });
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },

    closeModal() {
      this.errors = [];
      this.form = {};
      //   $("#changePasswordModal").hide();
      this.$refs.close_modal.click();
    },
  },

  created() {},
};
</script>
<style scoped>
</style>
