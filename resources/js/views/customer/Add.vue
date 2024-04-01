<template>
    <div>
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">Add New Customer</h3>
            </div>
            <!--begin::Form-->
            <form class="form" @submit.prevent="saveCustomer()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-solid" v-model="from.name" placeholder="Enter customer name..."/>
                        <small class="text-danger" v-if="errors.name">{{ errors?.name[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label>Email  <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-solid" v-model="from.email" placeholder="Enter customer name..."/>
                        <small class="text-danger" v-if="errors?.email">{{ errors?.email[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control form-control-solid" v-model="from.phone" placeholder="Enter customer name..."/>
                        <small class="text-danger" v-if="errors?.phone">{{ errors?.phone[0]}}</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea">Address</label>
                        <textarea id="exampleTextarea" class="form-control form-control-solid" v-model="from.address" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="form-control"  @change="uploadFile">
                    </div>
                    <img v-show="from.photo" class="preview-image" :src="from.photo" alt="">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <!--end::Form-->
        </div>


    </div>
</template>

<script>
export default {
    name: "Add",
    data(){
        return{
            from: {
                name: '',
                email: '',
                phone:'',
                address:'',
                photo:null,
            },
            errors:{},
        }
    },
    methods: {
        uploadFile(event){
            let File = event.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
                this.from.photo = event.target.result
            }
            reader.readAsDataURL(File);
        },
        saveCustomer(){
            this.$axios.post('api/customer?fromAdmin', this.from)
            .then( res => {
                this.from= '';
                this.errors = '';
                Toast.fire({
                    icon: 'success',
                    title: res.data.message
                })
            })
            .catch(err => {
                console.log(err?.response?.data?.errors)
                this.errors = err.response.data?.errors;
                Toast.fire({
                    icon: 'warning',
                    title: err.response.statusText
                })
            })
        }
    },

    created() {
        if (!User.loggedIn()){
            this.$router.push({name:"Login"})
        }
    }
}
</script>

<style scoped>
.preview-image{
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #83c1ff;
}
</style>
