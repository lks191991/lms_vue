<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Student Course Complete Percent</h3>

                <div class="card-tools">
                  
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Course</th>
                      <th>Percent</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="payment in payments.data" :key="payment.id">
                      <td>{{payment.uname}}</td>
                      <td>{{payment.uemail}}</td>
                      <td>{{payment.cname}}</td>
                      <td>{{payment.p}}%</td>
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
                  
                  axios.get('/api/course-complete-student?page=' + page).then(({ data }) => (this.payments = data.data));

                  this.$Progress.finish();
            },
           
          loadUsers(){
            this.$Progress.start();

            if(this.$gate.isAdmin()){
              axios.get("/api/course-complete-student").then(({ data }) => (this.payments = data.data));
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
