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
                     <tr>
                      <th><input v-model="v_name" type="text" name="v_name" class="form-control" ></th>
                      <th><input v-model="v_email" type="text" name="v_email" class="form-control" ></th>
                      <th></th>
                      <th></th>
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
                v_name:'',
                v_email:'',
            }
        },
        methods: {
           getResults(page = 1) {

                  this.$Progress.start();
                  this.loading = true;
                  axios.get('/api/user-last-login?page=' + page,{ params: {v_name: this.v_name,v_email: this.v_email}}).then(({ data }) => (this.users = data.data));
                    this.loading = false;
                  this.$Progress.finish();
            }

        },
        mounted() {
           this.getResults();
        },
        watch: {
            v_name(after, before) {
                this.getResults();
            },
            v_email(after, before) {
                this.getResults();
            }
        },
        created() {

            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        }
    }
</script>
