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
                <h3 class="card-title">Courses List</h3>

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
                      <th>Name</th>
                      <th>Description</th>
                      <th>Category</th>
					  <th>Sub Category</th>
                      <th>Price</th>
					  <th>Total Length</th>
					  <th>Status</th>
					   <th>Image</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <th><input v-model="c_name" type="text" name="name" class="form-control" ></th>
                      <th></th>
                      <th></th>
					  <th><select class="form-control" v-model="c_cat" >
                             <option value="" >Select</option>
								  <option  
                                  v-for="(cat,index) in subcategories_seacrh" :key="index"
                                  :value="index"
                                  :selected="index == form.sub_category_id">{{ cat }}</option>
                            </select></th>
                      <th></th>
					  <th></th>
					  <th></th>
					   <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="product in products.data" :key="product.id">

                      <td>{{product.name}}</td>
                      <td>{{product.description | truncate(30, '...')}}</td>
                      <td>{{product.category.name}}</td>
					  <td>{{product.subcategory.name}}</td>
                      <td>{{product.price}}</td>
					   <td>{{product.total_length_minutes}}</td>
					   <td :inner-html.prop="product.status | yesno"></td>
                      <td><img v-bind:src="'/' + product.banner_image" v-if="product.banner_image" width="100" alt="product"></td>
                      <td>
                        
                        <a href="javascript:;" @click="editModal(product)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="javascript:;" @click="deleteProduct(product.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" v-show="!editmode">Create New Course</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateCourse() : createCourse()" >
                    <div class="modal-body">
					 
					<div class="row">
					<div class="form-group col-md-4">

                            <label>Course Type</label>
                            <select class="form-control" v-model="form.course_type" :class="[allerros.course_type ? 'is-invalid' : '']">
                              <option value="Certified" :selected="'Certified' == form.course_type">Certified</option>
							  <option value="Non-certified" :selected="'Non-certified' == form.course_type">Non-certified</option>
                            </select>
                            <div v-if="allerros.course_type" class="help-block invalid-feedback">{{ allerros.course_type[0] }}</div>
                        </div>
					<div class="form-group col-md-4">

                            <label>Category</label>
                            <select class="form-control" @change="loadSubCategories(form.category_id)" :class="[allerros.category_id ? 'is-invalid' : '']"  v-model="form.category_id" enctype="multipart/form-data">
							 <option value=""  :selected="categories.length == 0">Select</option>
                              <option 
                                  v-for="(cat,index) in categories" :key="index"
                                  :value="index"
                                  :selected="index == form.category_id">{{ cat }}</option>
                            </select>
							<div v-if="allerros.category_id" class="help-block invalid-feedback">{{ allerros.category_id[0] }}</div>
                        </div>
                        <div class="form-group col-md-4">

                            <label>Sub Category</label>
                            <select class="form-control" v-model="form.sub_category_id" :class="[allerros.sub_category_id ? 'is-invalid' : '']">
                             <option value="" >Select</option>
								  <option  
                                  v-for="(cat,index) in subcategories" :key="index"
                                  :value="index"
                                  :selected="index == form.sub_category_id">{{ cat }}</option>
                            </select>
                            <div v-if="allerros.sub_category_id" class="help-block invalid-feedback">{{ allerros.sub_category_id[0] }}</div>
                        </div>
					
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="[allerros.name ? 'is-invalid' : '']">
                            <div v-if="allerros.name" class="help-block invalid-feedback">{{ allerros.name[0] }}</div>
                        </div>
                       
                        <div class="form-group col-md-3">
                            <label>Price</label>
                            <input v-model="form.price" type="text" name="price"
                                class="form-control" :class="[allerros.price ? 'is-invalid' : '']">
                           <div v-if="allerros.price" class="help-block invalid-feedback">{{ allerros.price[0] }}</div>
                        </div>
						<div class="form-group col-md-3">
                            <label>Total Length In Hours</label>
                            <input v-model="form.total_length_minutes" type="text" name="total_length_minutes"
                                class="form-control" :class="[allerros.total_length_minutes ? 'is-invalid' : '']">
                           <div v-if="allerros.total_length_minutes" class="help-block invalid-feedback">{{ allerros.total_length_minutes[0] }}</div>
                        </div>
						
						<div class="form-group col-md-12">
                            <label>Demo URL</label>
                            <input v-model="form.demo_url" type="text" name="demo_url"
                                class="form-control" :class="[allerros.demo_url ? 'is-invalid' : '']">
                            <div v-if="allerros.demo_url" class="help-block invalid-feedback">{{ allerros.demo_url[0] }}</div>
                        </div>
						<div class="form-group col-md-8">
                            <label>Image</label>
                            <input type="file"  v-on:change="onImageChange" :class="[allerros.banner_image ? 'is-invalid' : '']" name="banner_image">
                        <div v-if="allerros.banner_image" class="help-block invalid-feedback">{{ allerros.banner_image[0] }}</div>
						
						
                        
                        </div>
						 <div class="form-group col-md-4">
                            <img v-bind:src="'/'+imagePreview" width="50" height="50" v-show="showPreview"/>
                        </div>
						</div>
						
						
                        
						 <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="[allerros.description ? 'is-invalid' : '']">
                            <div v-if="allerros.description" class="help-block invalid-feedback">{{ allerros.description[0] }}</div>
                        </div>
						<div class="form-group">
                            <label>Status</label>
                            <toggle-button  :value="form.status" :sync="true" v-model="form.status" :labels="{checked: 'Yes', unchecked: 'No'}"  />
							
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
    import VueTagsInput from '@johmun/vue-tags-input';

    export default {
      components: {
          VueTagsInput,
        },
        data () {
            return {
                editmode: false,
                products : {},
				loading: false,
                c_name: '',
                c_cat: '',
                editProduct : [],
                form: new Form({
                    id : '',
                    category_id : '',
					sub_category_id : '',
                    name: '',
					price: '',
					course_type: '',
					total_length_minutes:'',
					demo_url: '',
                    description: '',
                    banner_image: null,
                   	status: false,

                }),
				allerros: [],
                categories: [],
				subcategories: [],
                subcategories_seacrh: [],
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
    this.form.banner_image = event.target.files[0];

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
    if( this.form.banner_image ){
        /*
            Ensure the file is an image file.
        */
        if ( /\.(jpe?g|png|gif)$/i.test( this.form.banner_image.name ) ) {

            //console.log("here");
            /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
            reader.readAsDataURL( this.form.banner_image );
        }
    }
},
          getResults(page = 1) {
			this.loading = true
              this.$Progress.start();
              
              axios.get('/api/course?page=' + page,{ params: {c_name: this.c_name,c_cat: this.c_cat} }).then(({ data }) => (this.products = data.data));
				this.loading = false
              this.$Progress.finish();
          },
         
          loadCategories(){

              axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
          },
          loadsubcatForSeacrh(){
				return axios.get("/api/sub-category/bycategory", {
				}).then(({ data }) => {
				this.subcategories_seacrh = data.data
				});
          },
		  loadSubCategories(id){
			  this.form.sub_category_id = '';
				return axios.get("/api/sub-category/bycategory?category="+id, {
				}).then(({ data }) => {
				this.subcategories = data.data
				return data.data
				});
          },
		  
			async chieldCategorySelect(){
				
				 let product = this.editProduct;
				
				 let vl = await this.loadSubCategories(product.category_id);
				 let catCheck = false;
			   _.each(this.subcategories, (value, key) => {
				  if(key==product.sub_category_id){
						catCheck = true;
				  } 
				});
			  
			  this.form.sub_category_id = '';
			  if(catCheck){
				  this.form.sub_category_id = product.sub_category_id;
			  } 
			},
			
           
          async editModal(product){
			  
              this.editmode = true;
              this.form.reset();
			if(product.status==1)
			{
			product.status = true;
			}
			else
			{
			product.status = false;
			}
              this.form.fill(product);
			  this.editProduct = product;
			  this.chieldCategorySelect();
				
			   
			  $('#addNew').modal('show');
			  //console.log(product);
			  this.showPreview = true;
			  this.allerros = [];
			  this.imagePreview = product.banner_image;
			  
          },
          newModal(){
              this.editmode = false;
			  this.allerros = [];
              this.form.reset();
              $('#addNew').modal('show');
          },
          createCourse(){
              this.$Progress.start();
				let formData = new FormData()
				formData.append('banner_image', this.form.banner_image)

				_.each(this.form, (value, key) => {
				formData.append(key, value)
				});
				
              axios.post('/api/course',formData)
              .then((data)=>{
                if(data.data.success){
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.getResults();

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
          updateCourse(){
              this.$Progress.start();
			  let formData = new FormData()
				formData.append('banner_image', this.form.banner_image)

				_.each(this.form, (value, key) => {
				formData.append(key, value)
				})
				
              axios.post('/api/course/update/',formData)
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
					
                  this.getResults();
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
          deleteProduct(id){
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
                              this.form.delete('/api/course/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.getResults();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

        },
        mounted() {
             this.getResults();
        },
        created() {
            this.$Progress.start();

            this.getResults();
            this.loadCategories();
            this.loadsubcatForSeacrh();
            this.$Progress.finish();
			
        },
    watch: {
        c_name(after, before) {
            this.getResults();
        },
        c_cat(after, before) {
            this.getResults();
        }
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
