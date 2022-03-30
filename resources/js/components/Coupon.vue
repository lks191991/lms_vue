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
                <h3 class="card-title">Coupons List</h3>

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
                      <th>Offer Name</th>
                      <th>Code</th>
                       <th>Coupon Type</th>
                      <th>Coupon Value</th>
                      <th>Expired_at</th>
                       <th>Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="coupon in coupons.data" :key="coupon.id">

                    <td class="text-capitalize">{{coupon.name}}</td>
                    <td class="text-capitalize">{{coupon.code}}</td>
                    <td>{{coupon.type}}</td>
                    <td  v-if="coupon.type== 'fixed'">${{coupon.coupon_value}}</td>
                    <td  v-if="coupon.type== 'percent'">%{{coupon.coupon_value}}</td>
                    <td>{{coupon.expired_at }}</td>
                    <td>{{coupon.created_at | myDate }}</td>
                      <td>

                        <a href="javascript:;" @click="deleteData(coupon.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="coupons" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" v-show="!editmode">Create New</h5>
                    <h5 class="modal-title" v-show="editmode">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateData() : createData()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Offer Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" autocomplete="off">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                      <div class="form-group">

                            <label>Type</label>
                            <select class="form-control" v-model="form.coupon_type" name="coupon_type" :class="{ 'is-invalid': form.errors.has('coupon_type') }">
                              <option value="fixed" :selected="'fixed' == form.coupon_type">Fixed</option>
							  <option value="percent" :selected="'percent' == form.coupon_type">Percent</option>
                            </select>
                            <has-error :form="form" field="coupon_type"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Amount/Percent</label>
                            <input v-model="form.coupon_value" type="text" name="coupon_value"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('coupon_value') }" autocomplete="off">
                            <has-error :form="form" field="coupon_value"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Expired Date</label>
                             <Datepicker  v-model="form.expired_at"    value="form.expired_at"  :format="'yyyy-MM-dd'" input-class="form-control"  calendar-class="w-auto rounded" 
      wrapper-class="w-auto"  type="date" valueType="format" />
                            <has-error :form="form" field="expired_at"></has-error>
                        </div>
                         <div class="form-group">
                            <label>Quantity</label>
                            <input v-model="form.quantity" type="text" name="quantity"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('quantity') }" autocomplete="off">
                            <has-error :form="form" field="quantity"></has-error>
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
import Datepicker from 'vuejs-datepicker'
    export default {
         components: {
    Datepicker
  },
        data () {
            return {
                editmode: false,
                coupons : {},
                loading: false,
                form: new Form({
                    id : '',
                    coupon_type :'fixed' ,
                    name: '',
                    coupon_value:'',
                    expired_at:'',
                    quantity:'',
                    email: '',
                })
            }
        },
        methods: {
           getResults(page = 1) {
                    this.loading = true
                  this.$Progress.start();
                  
                  axios.get('api/coupons?page=' + page).then(({ data }) => (this.coupons = data.data));
                    this.loading = false
                  this.$Progress.finish();
            },
            updateData(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/coupons/'+this.form.id)
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
            editModal(coupon){
                this.editmode = true;
                this.form.reset();
                  this.form.fill(coupon);
                  $('#addNew').modal('show');
               
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteData(id){
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
                                this.form.delete('api/coupons/'+id).then(()=>{
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
          loadData(){
            this.$Progress.start();
            this.loading = true
            if(this.$gate.isAdmin()){
              axios.get("api/coupons").then(({ data }) => {this.coupons = data.data
              this.loading = false;
              });
            }

            this.$Progress.finish();
          },
          
          createData(){

              this.form.post('api/coupons')
              .then((response)=>{
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: response.data.message
                  });

                  this.$Progress.finish();
                  this.loadData();

              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          }

        },
        mounted() {
            console.log('User Component mounted.')
        },
        created() {

            this.$Progress.start();
            this.loadData();
            this.$Progress.finish();
        }
    }
</script>
