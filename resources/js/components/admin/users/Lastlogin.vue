<template>
  <section class="content">
       <div  class="loader-out" v-if="loading"> <div  class="loader"  ></div>   </div>
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Student Last Login Report</h3>

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
                      <th>Contact</th>
                      <th>Last Login</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="user in users.data" :key="user.id">

                      <td class="text-capitalize">{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.contact}}</td>
                      <td>{{user.last_login | myDate}}</td>

                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
import Datepicker from 'vuejs-datepicker'
    export default {
         components: {
    Datepicker
  },
        data () {
            return {
                editmode: false,
                loading: false,
                users : {},
            }
        },
        methods: {
           getResults(page = 1) {

                  this.$Progress.start();
                  this.loading = true;
                  axios.get('/api/user-last-login?page=' + page).then(({ data }) => (this.users = data.data));
                    this.loading = false;
                  this.$Progress.finish();
            },
            
          loadUsers(){
            this.$Progress.start();
            this.loading = true;
            if(this.$gate.isAdmin()){
              axios.get("/api/user-last-login").then(({ data }) => {this.users = data.data
              console.log( data);
              });
            }
            this.loading = false;
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
