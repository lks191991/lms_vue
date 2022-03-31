<template>
  <section class="content">
  <div  class="loader-out" v-if="loading">
   <div  class="loader"  ></div>
   </div>
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Videos List</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Course</th>
					  <th>Topic</th>
					  <th>User</th>
					  <th>Description</th>
					   <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="video in videos.data" :key="video.id">

                      <td>{{video.name}}</td>
					  <td>{{video.course.name}}</td>
					  <td>{{video.topic.name}}</td>
					  <td>{{video.user.name}}</td>
					  <td>{{video.description | truncate(30, '...')}}</td>
					  <td :inner-html.prop="video.status | yesno"></td>
                      <td>
                        
                        <a href="javascript:;" @click="editModal(video)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="javascript:;" @click="deleteVideo(video.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="videos" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width:835px">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New Video</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateVideo() : createVideo()" >
                    <div class="modal-body">
					
					<div class="row">
					<div class="form-group col-md-6">

                            <label>Course</label>
                            <select class="form-control" @change="loadTopics(form.course_id)" :class="[allerros.course_id ? 'is-invalid' : '']"  v-model="form.course_id" enctype="multipart/form-data">
							 <option value=""  :selected="courses.length == 0">Select</option>
                              <option 
                                  v-for="(cat,index) in courses" :key="index"
                                  :value="index"
                                  :selected="index == form.course_id">{{ cat }}</option>
                            </select>
							<div v-if="allerros.course_id" class="help-block invalid-feedback">{{ allerros.course_id[0] }}</div>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Topic</label>
                            <select class="form-control" v-model="form.topic_id" :class="[allerros.topic_id ? 'is-invalid' : '']">
                             <option value="" >Select</option>
								  <option  
                                  v-for="(cat,index) in topics" :key="index"
                                  :value="index"
                                  :selected="index == form.topic_id">{{ cat }}</option>
                            </select>
                            <div v-if="allerros.topic_id" class="help-block invalid-feedback">{{ allerros.topic_id[0] }}</div>
                        </div>
					
                        <div class="form-group col-md-6">
                            <label>Name/Title</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="[allerros.name ? 'is-invalid' : '']">
                            <div v-if="allerros.name" class="help-block invalid-feedback">{{ allerros.name[0] }}</div>
                        </div>
                       
                        <div class="form-group col-md-6">
                            <label>Video_url</label>
                            <input v-model="form.video_url" type="text" name="video_url"
                                class="form-control" :class="[allerros.price ? 'is-invalid' : '']">
                           <div v-if="allerros.video_url" class="help-block invalid-feedback">{{ allerros.video_url[0] }}</div>
                        </div>
						
                        
						 <div class="form-group col-md-12">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="[allerros.description ? 'is-invalid' : '']">
                            <div v-if="allerros.description" class="help-block invalid-feedback">{{ allerros.description[0] }}</div>
                        </div>
						<div class="form-group col-md-8">
                            <label>Video Note</label>
                            <input type="file"  v-on:change="onImageChange" :class="[allerros.video_note ? 'is-invalid' : '']" name="video_note">
                        <div v-if="allerros.video_note" class="help-block invalid-feedback">{{ allerros.video_note[0] }}</div>
						
						
                        
                        </div>
						 <div class="form-group col-md-4">
                            <img v-bind:src="imagePreview" width="50" height="50" v-show="showPreview"/>
                        </div>
						<div class="form-group col-md-12">
                            <label>Status</label>
                            <toggle-button  :value="form.status" :sync="true" v-model="form.status" :labels="{checked: 'Yes', unchecked: 'No'}"  />
							
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
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
      components: {
         
        },
        data () {
            return {
                editmode: false,
                videos : {},
				loading: false,
                editVideo : [],
                form: new Form({
                    id : '',
                    course_id : '',
					video_url : '',
                    name: '',
					topic_id: '',
					video_note: null,
                    description: '',
                   status: false,

                }),
				allerros: [],
                courses: [],
				topics: [],
                imagePreview: null,
				showPreview: false,
				 imageEditPreview: null,
				showEditPreview: false,
				
            }
        },
        methods: {
		onImageChange(event){
    /*
    Set the local file variable to what the user has selected.
    */
    this.form.video_note = event.target.files[0];

    /*
    Initialize a File Reader object
    */
    let reader  = new FileReader();

    /*
    Add an event listener to the reader that when the file
    has been loaded, we flag the show preview as true and set the
    image to be what was read from the reader.
    */
    reader.addEventListener("load", function () {
        this.showPreview = true;
        this.imagePreview = reader.result;
    }.bind(this), false);

    /*
    Check to see if the file is not empty.
    */
    if( this.form.video_note ){
        /*
            Ensure the file is an image file.
        */
        if ( /\.(jpe?g|png|gif)$/i.test( this.form.video_note.name ) ) {

            console.log("here");
            /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
            reader.readAsDataURL( this.form.video_note );
        }
    }
},
          getResults(page = 1) {
			this.loading = true
              this.$Progress.start();
              
              axios.get('api/videos?page=' + page).then(({ data }) => (this.videos = data.data));
				this.loading = false
              this.$Progress.finish();
          },
         
		   loadVideos(){
				this.loading = true
                if(this.$gate.isAdmin()){
                    axios.get("/api/videos").then(({ data }) => {this.videos = data.data;
					this.loading = false
					});
                }
            },
          loadCourses(){
			
              axios.get("/api/course/list").then(({ data }) => (this.courses = data.data));
          },
		  loadTopics(id){
			  this.form.topic_id = '';
				return axios.get("/api/topics/bycourse?course="+id, {
				}).then(({ data }) => {
				this.topics = data.data
				return data.data
				});
          },
		  
			async chieldCategorySelect(){
				
				 let video = this.editVideo;
				
				 let vl = await this.loadTopics(video.course_id);
				 let catCheck = false;
			   _.each(this.topics, (value, key) => {
				  if(key==video.topic_id){
						catCheck = true;
				  } 
				});
			  
			  this.form.topic_id = '';
			  if(catCheck){
				  this.form.topic_id = video.topic_id;
			  } 
			},
			
           
          async editModal(video){
			  
              this.editmode = true;
              this.form.reset();
              if(video.status==1)
				{
				video.status = true;
				}
				else
				{
				video.status = false;
				}
              this.form.fill(video);
			  this.editVideo = video;
			  this.chieldCategorySelect();
				
			   
			  $('#addNew').modal('show');
			  //console.log(product);
			  this.showPreview = true;
			  this.allerros = [];
			   this.imagePreview = video.video_note;
          },
          newModal(){
              this.editmode = false;
			  this.allerros = [];
              this.form.reset();
              $('#addNew').modal('show');
          },
          createVideo(){
              this.$Progress.start();
				let formData = new FormData()
				formData.append('video_note', this.form.video_note)

				_.each(this.form, (value, key) => {
				formData.append(key, value)
				});
				
              axios.post('api/videos',formData)
              .then((data)=>{
                if(data.data.success){
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadVideos();

                } else {
					this.allerros = error.response.data.errors;
					 Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                  });
                 

                  this.$Progress.failed();
                }
              })
              .catch((error)=>{
					this.allerros = error.response.data.errors;
                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          },
          updateVideo(){
              this.$Progress.start();
			  let formData = new FormData()
				formData.append('video_note', this.form.video_note)

				_.each(this.form, (value, key) => {
				formData.append(key, value)
				})
				
              axios.post('api/videos/update/',formData)
              .then((response) => {
                  // success
				  this.form.reset();
                  $('#addNew').modal('hide');
				  
                  Toast.fire({
                    icon: 'success',
                    title: response.data.message
                  });
                  this.$Progress.finish();
                      //  Fire.$emit('AfterCreate');
					
                  this.loadVideos();
              })
              .catch((error) => {
				  this.allerros = error.response.data.errors;
				  Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                  });
                  this.$Progress.fail();
              });

          },
          deleteVideo(id){
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
                              this.form.delete('api/videos/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadVideos();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

        },
        mounted() {
        },
        created() {
            this.$Progress.start();

            this.loadVideos();
            this.loadCourses();
            this.$Progress.finish();
			
        },
        filters: {
            truncate: function (text, length, suffix) {
                return ''//text.substring(0, length) + suffix;
            },
        },
        computed: {
          
        },
    }
</script>
