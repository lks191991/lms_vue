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
                    <tr>
                      <th><input v-model="v_name" type="text" name="v_name" class="form-control" ></th>
                      <th><input v-model="v_email" type="text" name="v_email" class="form-control" ></th>
                      <th><select class="form-control"   v-model="c_id" >
							 <option value=""  :selected="courses.length == 0">Select</option>
                              <option 
                                  v-for="(cat,index) in courses" :key="index"
                                  :value="index"
                                  >{{ cat }}</option>
                            </select></th>
                      <th></th>
                     
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="payment in payments.data" :key="payment.id">
                      <td>{{payment.uname}}</td>
                      <td>{{payment.uemail}}</td>
                      <td>{{payment.cname}}</td>
                      <td>{{Math.floor((payment.p*100)/payment.total_video_sum)}}%</td>
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
               v_name:'',
                v_email:'',
                c_id:'',
                courses: [],
            }
        },
        methods: {

            getResults(page = 1) {

                  this.$Progress.start();
                  
                  axios.get('/api/course-complete-student?page=' + page,{ params: {v_name: this.v_name,v_email: this.v_email,c_id: this.c_id}}).then(({ data }) => (this.payments = data.data));

                  this.$Progress.finish();
            },
			loadCourses(){
			
              axios.get("/api/course/list").then(({ data }) => (this.courses = data.data));
            },

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
            },
            c_id(after, before) {
                this.getResults();
            }
        },
        created() {

            this.$Progress.start();
             this.loadCourses();
            this.getResults();
            this.$Progress.finish();
        }
    }
</script>
