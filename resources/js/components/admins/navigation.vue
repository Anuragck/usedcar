<template>
  <div class="div">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-background"></div>
      <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">

          <ul class="nav">
            <li class="nav-item ">
              <router-link to="/">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </router-link>
            </li>
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <!--- <h4 class="text-section">Components</h4> -->
            </li>
  <li class="nav-item  ">

              <router-link to="/enquiry-list">
               <i class="fas fa-headset"></i>
                <p>Enquiry List</p>


              </router-link>


            </li>

            <li class="nav-item">
              <a data-toggle="collapse" href="#base">
                <i class="fas fa-layer-group"></i>
                <p>Masters</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="base">
                <ul class="nav nav-collapse">
                  <li>
                    <router-link to="brand">
                      <span class="sub-item">Brand</span>
                    </router-link>
                  </li>
                  <li>
                    <router-link to="/model">
                      <span class="sub-item">Model</span>
                    </router-link>
                  </li>

<li>
                    <router-link to="/expensecategory">
                      <span class="sub-item">Expense Category</span>
                    </router-link>
                  </li>

<li>
                    <router-link to="/images">
                      <span class="sub-item">Images/Documents</span>
                    </router-link>
                  </li>

                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-toggle="collapse" href="#forms">
                <i class="fas fa-pen-square"></i>
                <p>Operations</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li>
                    <router-link to="/purchase">
                      <span class="sub-item">Purchase</span>
                    </router-link>
                  </li>
                  <li>
                    <router-link to="/vehicle-list">
                      <span class="sub-item">Vehicle List- Add Expense</span>
                    </router-link>
                  </li>
                  <li>
                    <router-link to="/ready-vehicles">
                      <span class="sub-item">Ready For Sale</span>
                    </router-link>
                  </li>


 <li>
                    <router-link to="/booking-list">
                      <span class="sub-item">Booking List</span>
                    </router-link>
                  </li>


 <li>
                    <router-link to="/delivery-list">
                      <span class="sub-item">Delivery List</span>
                    </router-link>
                  </li>

                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-toggle="collapse" href="#tables">
                <i class="fas fa-table"></i>
                <p>Reports</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="tables">
               <ul class="nav nav-collapse">
                 <li>
                   <router-link to="/purchase-report">
                      <span class="sub-item">Purchase Report</span>
                    </router-link>
                  </li>
                  <li>
                    <router-link to="/sales-report">
                      <span class="sub-item">Sales Report</span>
                    </router-link>
                  </li>
<li>
                    <router-link to="/expense-report">
                      <span class="sub-item">Expense Report</span>
                    </router-link>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->
  </div>
</template>

<script>
</script>

