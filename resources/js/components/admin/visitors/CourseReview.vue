<template>


  <section class="content">
  <div  class="loader-out" v-if="loading">
   <div  class="loader"  ></div>
   </div>
 
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Course Reviews</h3>

                <div class="card-tools">
                  
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
			 
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>User</th>
					  <th>Course</th>
                      <th>Rating</th>
                      <th>Comment</th>
                      <th>Created</th>
					  <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="data in listData.data" :key="data.id">

                      <td class="text-capitalize">{{data.user.name}}</td>
					   <td>{{data.course.name}}</td>
                      <td>{{data.rating}}</td>
                      <td>{{data.comment}}</td>
                      <td>{{data.created_at | myDate}}</td>
					  <td :inner-html.prop="data.status | yesno"></td>
                      <td>

                        <a href="javascript:;" @click="editModal(data)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                         |
                        <a href="javascript:;" @click="deleteResult(data.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="listData" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>


        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New Review</h5>
                    <h5 class="modal-title" v-show="editmode">Update Review Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="updateResult()">
                    <div class="modal-body">
                       
						<div class="form-group">
                            <label>Status</label>
                            <toggle-button  :value="form.status" :sync="true" v-model="form.status" :labels="{checked: 'Yes', unchecked: 'No'}"  />
							
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update Status</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
	
  </section>
</template>

<script>
    export default {
		
        data () {
            return {
                editmode: false,
				loading: false,
                listData : {},
                form: new Form({
                    id : '',
					status: false,
                }),
				courses: [],
            }
        },
        methods: {
		
            getResults(page = 1) {
				this.loading = true
                  this.$Progress.start();
                  
                  axios.get('/api/course-review?page=' + page).then(({ data }) => {this.listData = data.data;
				  this.loading = false
				  });

                  this.$Progress.finish();
            },
			 loadData(){
				this.loading = true
                if(this.$gate.isAdmin()){
                    axios.get("/api/course-review").then(({ data }) => {this.listData = data.data;
					this.loading = false
					});
                }
            },
			
            updateResult(){
                this.$Progress.start();
                this.form.post('/api/update-review-status')
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.loadData();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(topic){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
				if(topic.status==1)
				{
				topic.status = true;
				}
				else
				{
					topic.status = false;
				}
                this.form.fill(topic);
				
            },

             deleteResult(id){
                 this.form.id = id;
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {

                      // Send request to the server
                        if (result.value) {
                              this.form.post('/api/review-delete').then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadData();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
			this.loadData();
            this.$Progress.start();
            this.$Progress.finish();
        }
    }
</script>


