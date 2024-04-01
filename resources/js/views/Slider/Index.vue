<script setup>
import {computed, onMounted, ref} from "vue";
import useAxios from "@/composables/useApi.js";



const {sendRequest, error, loading} = useAxios();


const url = ref(null)
const imageFile = ref(null);

const prevImage = ref(null)
const sliders = ref([])
const inputImage = (event) =>{
    prevImage.value = URL.createObjectURL(event.target.files[0])
    imageFile.value = event.target.files[0];
}


const handelSubmit = async () =>{
    const formData = new FormData();
    formData.append('url', url.value)
    formData.append('image', imageFile.value)

    await sendRequest({
        url:"/api/sliders",
        data:  formData,
        method:"POST",
        headers:{
            contentType:'multipart/formdata'
        }
    })

    await Toast.fire({
        icon: 'success',
        title: "Slider Item Created..."
    })
    await getSliders()
}


const deleteSlider = (id) => {
    Swal.fire({
        title: 'Are You Sure!',
        text: 'you watnt to delete this?',
        icon: 'warning',
        confirmButtonColor: '#ddd',
        cancelButtonColor: 'red',
        confirmButtonText: 'Delete',
        showCancelButton: true,
    }).then((result) => {
        if (result.value) {
            sendRequest({
                url: "/api/sliders/" + id,
                method: "DELETE"
            })
            getSliders()
            Toast.fire({
                icon: 'success',
                title: "Slider Item Deleted...."
            })
        }
    }).catch(() => {
        Swal.fire({
            icon: 'success',
            title: 'dont worry. your data is safe...'
        })
        this.$router.push({name: 'ManageEmployee'});
    })
}


const getSliders = async () => sliders.value = await sendRequest('/api/sliders');
onMounted(async () => await getSliders());

</script>

<template>
    <layout>
        <div class="content-body">
            <div class="row match-height">
                <div class="col-md-8" >
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">Slider</h4>
                                <button class="btn btn-sm btn-primary">Add Slider</button>
                            </div>

                            <div class="row d-flex align-items-center">
                                <div class="col-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Image</th>
                                                <th scope="col" width="10%">Path</th>
                                                <th scope="col">X</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="item in sliders" :key="item.id">
                                            <th>
                                                <div class="slider-table-image">
                                                    <img class="w-100 h-100" :src="'/storage/'+item.image" alt="">

                                                </div>
                                            </th>
                                            <td width="10%">{{ item.link }}</td>
                                            <td>
                                                <button class="btn btn-light-danger" @click="deleteSlider(item?.id)">
                                                    <span class="svg-icon svg-icon-danger m-0 p-0"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                                            <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="handelSubmit">
                                <div class="d-flex align-items-center flex-column">
                                    <label for="inputSlider" class="btn btn-clean card-body position-relative imgContainer text-center w-100 rounded-lg" style="border:2px dashed">
                                        <input type="file" @input="inputImage" class="d-none" id="inputSlider">
                                        <div class="w-100 d-flex align-items-center justify-center flex-column">
                                            <span v-if="!prevImage && typeof prevImage !== 'string'" class="w-100 svg-icon svg-icon-primary text-center svg-icon-10x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Files/Pictures1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                                        <polygon fill="#000000" opacity="0.3" points="4 19 10 11 16 19"/>
                                                        <polygon fill="#000000" points="11 19 15 14 19 19"/>
                                                        <path d="M18,12 C18.8284271,12 19.5,11.3284271 19.5,10.5 C19.5,9.67157288 18.8284271,9 18,9 C17.1715729,9 16.5,9.67157288 16.5,10.5 C16.5,11.3284271 17.1715729,12 18,12 Z" fill="#000000" opacity="0.3"/>
                                                    </g>
                                                </svg><!--end::Svg Icon-->

                                            </span>
                                           <small v-if="!prevImage && typeof prevImage !== 'string'" class="text-danger">
                                               Please upload images in JPG, PNG, or GIF format with dimensions of 1400 x 500 pixels. The maximum file size allowed is 1024 KB.
                                           </small>
                                       </div>
                                        <img v-if="prevImage" :src="prevImage" class="w-100" alt="">
                                    </label>

                                    <input v-model="url" type="text" class="form-control" placeholder="e.g page going url">
                                    <button class="btn btn-primary mt-2 text-start">Save Slider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </layout>
</template>

<style>
.slider-table-image{
    width:120px;
    height:100px;
}
.slider-table-image img{
    object-fit:contain;
}
.showColor{
    width:20px;
    height: 20px;
    display: block;
    border-radius: 5px;
    border: 1px solid var(--bs-black);
}
.vs__dropdown-toggle{
    padding: 6px !important;
}


.submit-button-gless{
    position: relative;
    padding: 20px 50px;
    text-decoration: none;
    color: #fff;
    font-size: 2em;
    text-transform: uppercase;
    font-family: sans-serif;
    letter-spacing: 4px;
    overflow: hidden;
    background: rgba(255,255,255,.1);
    box-shadow: 0 5px 5px rgba(0,0,0.2);
}
.submit-button-gless:before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    height: 100%;
    background: rgba(255,255,255,.1);
}
.submit-button-gless:after{
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,transparent,rgba(255,255,255,.4),transparent);
    transition: 0.5s;
    transition-delay: 0.5s;
}
.submit-button-gless:hover:after{
    left: 100%;
}
.submit-button-gless span{
    position: absolute;
    display: block;
    transition: 0.5s ease;
}
.submit-button-gless span:nth-child(1)
{
    top: 0;
    left: 0;
    width: 0;
    height: 1px;
    background: #fff;
}
.submit-button-gless:hover span:nth-child(1)
{
    width: 100%;
    transform: translateX(100%);
}
.submit-button-gless span:nth-child(3)
{
    bottom: 0;
    right: 0;
    width: 0;
    height: 1px;
    background: #fff;
}
.submit-button-gless:hover span:nth-child(3)
{
    width: 100%;
    transform: translateX(-100%);
}
.submit-button-gless span:nth-child(2)
{
    top: 0;
    left: 0;
    width: 1px;
    height: 0;
    background: #fff;
}
.submit-button-gless:hover span:nth-child(2)
{
    height: 100%;
    transform: translateY(100%);
}
.submit-button-gless span:nth-child(4)
{
    bottom: 0;
    right: 0;
    width: 1px;
    height: 0;
    background: #fff;
}
.submit-button-gless:hover span:nth-child(4)
{
    height: 100%;
    transform: translateY(-100%);
}


</style>
