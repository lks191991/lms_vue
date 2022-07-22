<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Studets Transactions</h3>

                <div class="card-tools">
                  
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Transaction Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Course</th>
                      
                      <th>Status</th>
                      <th>Payment Date</th>
                      <th>Expired On</th>
                      <th>Amount</th>
                      <th>Discount</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="payment in payments.data" :key="payment.id">
                      <td>{{payment.transaction_id}}</td>
                      <td>{{payment.user.name}}</td>
                      <td>{{payment.user.email}}</td>
                      <td>{{payment.course.name}}</td>
                      
                      <td><span class="badge badge-success" v-if="payment.status=='Success'">{{payment.status}}</span>
                      <span class="badge badge-danger" v-if="payment.status=='Faild'">{{payment.status}}</span>
                      </td>
                      <td>{{payment.created_at| myDate}}</td>
                      <td>{{payment.expired_on| myDate}}</td>
<td>{{payment.price}}</td>
                      <td>{{payment.discount}}</td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="payments" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>


        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

       
    </div>
  </section>
</template>

<script>
    export default {
        data () {
            return {
                editmode: false,
                payments : {},
            }
        },
        methods: {

            getResults(page = 1) {

                  this.$Progress.start();
                  
                  axios.get('/api/transactions?page=' + page).then(({ data }) => (this.payments = data.data));

                  this.$Progress.finish();
            },
           
          loadUsers(){
            this.$Progress.start();

            if(this.$gate.isAdmin()){
              axios.get("/api/transactions").then(({ data }) => (this.payments = data.data));
            }

            this.$Progress.finish();
          },
          

        },
        mounted() {
            console.log('User Component mounted.')
        },
        created() {

            this.$Progress.start();
            this.loadUsers();
            this.$Progress.finish();
        }
    }
</script>
