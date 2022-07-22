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
                <h3 class="card-title">Slider List</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Course</th>
					  <th>Image</th>
					   <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="slider in sliders.data" :key="slider.id">

                      <td>{{slider.name}}</td>
					  <td>{{slider.course.name}}</td>
                      <td><img v-bind:src="'/' + slider.slider_image" v-if="slider.slider_image" width="100" alt="product"></td>
					  <td :inner-html.prop="slider.status | yesno"></td>
                      <td>
                        
                        <a href="javascript:;" @click="editModal(slider)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="javascript:;" @click="deleteSlider(slider.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="sliders" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" v-show="!editmode">Create New Slider</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateSlider() : createSlider()" >
                    <div class="modal-body">
					
					<div class="row">
					<div class="form-group col-md-6">

                            <label>Course</label>
                            <select class="form-control" :class="[allerros.course_id ? 'is-invalid' : '']"  v-model="form.course_id" enctype="multipart/form-data">
							 <option value=""  :selected="courses.length == 0">Select</option>
                              <option 
                                  v-for="(cat,index) in courses" :key="index"
                                  :value="index"
                                  :selected="index == form.course_id">{{ cat }}</option>
                            </select>
							<div v-if="allerros.course_id" class="help-block invalid-feedback">{{ allerros.course_id[0] }}</div>
                        </div>
                      
					
                        <div class="form-group col-md-6">
                            <label>Name/Title</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="[allerros.name ? 'is-invalid' : '']">
                            <div v-if="allerros.name" class="help-block invalid-feedback">{{ allerros.name[0] }}</div>
                        </div>
                      
						
                        
						 <div class="form-group col-md-12">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="[allerros.description ? 'is-invalid' : '']">
                            <div v-if="allerros.description" class="help-block invalid-feedback">{{ allerros.description[0] }}</div>
                        </div>
						<div class="form-group col-md-8">
                            <label>Slider Image</label>
                            <input type="file"  v-on:change="onImageChange" :class="[allerros.slider_image ? 'is-invalid' : '']" name="slider_image">
                        <div v-if="allerros.slider_image" class="help-block invalid-feedback">{{ allerros.slider_image[0] }}</div>
						
						
                        
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
                sliders : {},
				loading: false,
                editSlider : [],
                form: new Form({
                    id : '',
                    course_id : '',
					description : '',
                    name: '',
					slider_image: null,
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
    this.form.slider_image = event.target.files[0];

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
    if( this.form.slider_image ){
        /*
            Ensure the file is an image file.
        */
        if ( /\.(jpe?g|png|gif)$/i.test( this.form.slider_image.name ) ) {

            console.log("here");
            /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
            reader.readAsDataURL( this.form.slider_image );
        }
    }
},
          getResults(page = 1) {
			this.loading = true
              this.$Progress.start();
              
              axios.get('api/sliders?page=' + page).then(({ data }) => (this.sliders = data.data));
				this.loading = false
              this.$Progress.finish();
          },
         
		   loadsliders(){
				this.loading = true
                if(this.$gate.isAdmin()){
                    axios.get("/api/sliders").then(({ data }) => {this.sliders = data.data;
					this.loading = false
					});
                }
            },
          loadCourses(){
			
              axios.get("/api/course/list").then(({ data }) => (this.courses = data.data));
          },
			
           
          async editModal(slider){
			  
              this.editmode = true;
              this.form.reset();
              if(slider.status==1)
				{
				slider.status = true;
				}
				else
				{
				slider.status = false;
				}
              this.form.fill(slider);
			  this.editSlider = slider;
				
			   
			  $('#addNew').modal('show');
			  //console.log(product);
			  this.showPreview = true;
			  this.allerros = [];
			   this.imagePreview = slider.slider_image;
          },
          newModal(){
              this.editmode = false;
			  this.allerros = [];
              this.form.reset();
              $('#addNew').modal('show');
          },
          createSlider(){
              this.$Progress.start();
				let formData = new FormData()
				formData.append('slider_image', this.form.slider_image)

				_.each(this.form, (value, key) => {
				formData.append(key, value)
				});
				
              axios.post('/api/sliders',formData)
              .then((data)=>{
                if(data.data.success){
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadsliders();

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
          updateSlider(){
              this.$Progress.start();
			  let formData = new FormData()
				formData.append('slider_image', this.form.slider_image)

				_.each(this.form, (value, key) => {
				formData.append(key, value)
				})
				
              axios.post('/api/sliders/update/',formData)
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
					
                  this.loadsliders();
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
          deleteSlider(id){
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
                              this.form.delete('/api/sliders/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadsliders();
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

            this.loadsliders();
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
