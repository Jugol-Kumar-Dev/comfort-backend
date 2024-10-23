<template>
    <div>
        <div class="card card-custom">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-title d-flex gap-5">
                    <h3>Lead Management</h3>
                </div>
            </div>
        </div>

        <div class="mt-5"  v-if="leads.length" >
            <div class="row">
                <div class="col-md-4" v-for="(lead, i) in leads">
                    <div class="card my-2 w-100 overflow-hidden">


                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <p class="fs-5 p-0 m-0 fw-bold"> Name : <span class="text-primary text-capitalize">{{ lead?.name }}</span></p>
                                    <p class="fs-5 p-0 m-0 fw-bold"> Email : <span class="text-primary ">{{ lead?.email }}</span></p>
                                    <p class="fs-5 p-0 m-0 fw-bold"> Phone : <span class="text-primary ">{{ lead?.phone }}</span></p>

                                    <div class="d-flex justify-content-between info-item my-3">
                                        <p class="info-title p-0 m-0">Created At:</p>
                                        <span class="badge bg-light-info text-info fw-bold">{{ moment(batch?.createdAt).format('lll') }}</span>
                                    </div>
                                    <div  class="d-flex flex-column gap-3">
                                        <p class="fs-5 p-0 m-0 fw-bold">Message:</p>
                                        <p class="m-0 p-0">{{ lead?.message }}</p>
                                    </div>

                                </div>

                                <div>
                                    <button class="btn btn-warning" @click="deleteCampaing(lead?.id)">Delete Lead</button>
                                </div>
                            </div>
                        </div>
                    <div class="border-5 border-warning border-bottom" :style="`width:${batch?.progress}%`">

                    </div>
                </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script setup>

import RequestLoading from "@/components/RequestLoading.vue";
import {onMounted, ref} from "vue";
import useAxios from "@/composables/useApi.js";
import moment from "moment";

const {sendRequest, error, loading} = useAxios();
const leads = ref([])

const getAllCampaigns = async () => {
    leads.value = await sendRequest("api/get-all-leads");
}


onMounted(async () => {
    await getAllCampaigns()
})


const deleteCampaing = (id)=> {
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
                url:`/api/delete-lead/${id}`,
                method:"DELETE"
            })

            getAllCampaigns()
            Toast.fire({
                icon: 'success',
                title: "Campaign Delete Successfully Done..."
            })
        }
    }).catch(() => {
        Swal.fire({
            icon: 'success',
            title: 'dont worry. your data is safe...'
        })
    })
}


</script>

<style>
.card-body {
    padding: 1.5rem;
}

.info-title {
    font-weight: bold;
    font-size: 1.25rem; /* Adjust size as needed */
}

.info-detail {
    color: #6c757d; /* Muted color */
}
</style>
